<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\SurveyResult;
use App\Models\User;
use App\Models\UserCurriculumExamHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // ชื่อหลักสูตร
        $curriculums = Curriculum::where('status', 'active')->pluck('name', 'id');

        // ผู้ใช้ที่ลงทะเบียนในระบบ
        $userCount = User::count();

        // ดึงข้อมูลผู้ใช้ที่ลงทะเบียนวันนี้
        $userCountToday = User::whereDate('created_at', $today)->count();

        /************** Pie Chart ประเภทผู้ใช้งาน **************/
        // ดึงข้อมูลและจัดกลุ่มผู้ใช้ตาม user_type_id พร้อมกับโหลดข้อมูลของ UserType
        $userTypes = User::with('userType')
            ->selectRaw('user_type_id, COUNT(*) as count')
            ->groupBy('user_type_id')
            ->get();

        // เตรียมข้อมูลสำหรับแสดงผลในกราฟ
        $userTypeLabels = [];
        $userTypeData   = [];

        foreach ($userTypes as $userType) {
            // ตรวจสอบว่ามีชื่อ UserType หรือไม่ ถ้าไม่มีจะไม่เพิ่มในกราฟ
            if (!empty($userType->userType->name)) {
                $userTypeLabels[] = $userType->userType->name;
                $userTypeData[]   = $userType->count;
            }
        }
        /************** Pie Chart ประเภทผู้ใช้งาน **************/

        /************** Pie Chart ช่องทางการสมัคร **************/
        // ดึงข้อมูลและจัดกลุ่มผู้ใช้ตาม provider
        $providers = User::selectRaw("provider, COUNT(*) as count")
            ->groupBy('provider')
            ->get();

        // เตรียมข้อมูลสำหรับแสดงผลในกราฟช่องทางการลงทะเบียน
        $providerLabels = [];
        $providerData   = [];

        foreach ($providers as $provider) {
            $providerLabels[] = $provider->provider ?? 'เว็บไซต์';
            $providerData[]   = $provider->count;
        }
        /************** Pie Chart ช่องทางการสมัคร **************/

        /************** StackedBar Chart ข้อมูลจำนวนผู้ลงทะเบียนรายเดือน **************/
        $currentYear          = Carbon::now()->year; // ปีปัจจุบัน
        $registeredUsersQuery = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $currentYear) // เฉพาะปีปัจจุบัน
            ->groupByRaw('MONTH(created_at)')
            ->get();

        $registeredUsersData = array_fill(0, 12, 0); // ค่าเริ่มต้นเป็น 0 สำหรับทุกเดือน

        foreach ($registeredUsersQuery as $data) {
            $registeredUsersData[$data->month - 1] = $data->count; // เดือน - 1 เพราะ array เริ่มที่ 0
        }
        /***************************************************************/

        return view('admin.dashboard.index', compact('userCount', 'userCountToday', 'curriculums', 'userTypeLabels', 'userTypeData', 'providerLabels', 'providerData', 'registeredUsersData'));
    }

    public function ajaxDashboard(Request $request)
    {
        $curriculum_id = $request->curriculum_id;

        // วันที่เริ่มต้นคือ 1 ตุลาคม 2024
        $startDate = Carbon::create(2024, 10, 1);

        // ผู้เข้าร่วมทำแบบทดสอบ
        $allPostExamQuery = UserCurriculumExamHistory::query()
            ->whereNotNull('post_date_finished')
            ->where('created_at', '>=', $startDate);

        if ($curriculum_id !== null) {
            $allPostExamQuery->where('curriculum_id', $curriculum_id);
        }

        $allPostExamCount = $allPostExamQuery->count();

        // ผู้ทำแบบทดสอบผ่าน
        $allPostExamPassQuery = UserCurriculumExamHistory::query()
            ->whereNotNull('post_date_finished')
            ->where('post_pass_status', 'y')
            ->where('created_at', '>=', $startDate);

        if ($curriculum_id !== null) {
            $allPostExamPassQuery->where('curriculum_id', $curriculum_id);
        }

        $allPostExamPassCount = $allPostExamPassQuery->count();

        // ผลการประเมิน
        $surveyResultsQuery = SurveyResult::with('survey')
            ->select('survey_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('survey_id');

        if ($curriculum_id !== null) {
            $surveyResultsQuery->where('curriculum_id', $curriculum_id);
        }

        $surveyResults = $surveyResultsQuery->get();

        /************** StackedBar Chart **************/
        // ค่าตั้งต้นของข้อมูลในแต่ละเดือน
        $postExamNotPassDataChart = array_fill(0, 12, 0);
        $postExamPassDataChart    = array_fill(0, 12, 0);

        // ดึงข้อมูลของปีปัจจุบัน
        $currentYear = Carbon::now()->year;

        // ดึงข้อมูลผู้ทำแบบทดสอบไม่ผ่านในปีปัจจุบัน
        $postExamNotPassQuery = UserCurriculumExamHistory::selectRaw('MONTH(post_date_finished) as month, COUNT(*) as count')
            ->whereYear('post_date_finished', $currentYear)
            ->whereNotNull('post_date_finished')
            ->where('post_pass_status', 'n')
            ->groupByRaw('MONTH(post_date_finished)')
            ->where('created_at', '>=', $startDate);

        // ดึงข้อมูลผู้ทำแบบทดสอบผ่านในปีปัจจุบัน
        $postExamPassQuery = UserCurriculumExamHistory::selectRaw('MONTH(post_date_finished) as month, COUNT(*) as count')
            ->whereYear('post_date_finished', $currentYear)
            ->whereNotNull('post_date_finished')
            ->where('post_pass_status', 'y')
            ->groupByRaw('MONTH(post_date_finished)')
            ->where('created_at', '>=', $startDate);

        if ($curriculum_id !== null) {
            $postExamNotPassQuery->where('curriculum_id', $curriculum_id);
            $postExamPassQuery->where('curriculum_id', $curriculum_id);
        }

        $postExamNotPass = $postExamNotPassQuery->get();
        $postExamPass    = $postExamPassQuery->get();

        // จัดข้อมูลลงใน array
        foreach ($postExamNotPass as $data) {
            $postExamNotPassDataChart[$data->month - 1] = $data->count;
        }

        foreach ($postExamPass as $data) {
            $postExamPassDataChart[$data->month - 1] = $data->count;
        }
        /************** StackedBar Chart **************/

        // รวมข้อมูลทั้งหมดใน array
        $response = [
            'allPostExamCount'         => $allPostExamCount,
            'allPostExamPassCount'     => $allPostExamPassCount,
            'surveyResults'            => $surveyResults,
            'postExamNotPassDataChart' => $postExamNotPassDataChart,
            'postExamPassDataChart'    => $postExamPassDataChart,
        ];

        return response()->json($response);
    }

}
