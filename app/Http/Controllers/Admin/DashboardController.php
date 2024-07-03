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

        return view('admin.dashboard.index', compact('userCount', 'userCountToday', 'curriculums'));
    }

    public function ajaxDashboard(Request $request)
    {
        $curriculum_id = $request->curriculum_id;

        // ผู้เข้าร่วมทำแบบทดสอบ
        $allPostExamQuery = UserCurriculumExamHistory::query()
            ->whereNotNull('post_date_finished');

        if ($curriculum_id !== null) {
            $allPostExamQuery->where('curriculum_id', $curriculum_id);
        }

        $allPostExamCount = $allPostExamQuery->count();

        // ผู้ทำแบบทดสอบผ่าน
        $allPostExamPassQuery = UserCurriculumExamHistory::query()
            ->whereNotNull('post_date_finished')
            ->where('post_pass_status', 'y');

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
            ->groupByRaw('MONTH(post_date_finished)');

        // ดึงข้อมูลผู้ทำแบบทดสอบผ่านในปีปัจจุบัน
        $postExamPassQuery = UserCurriculumExamHistory::selectRaw('MONTH(post_date_finished) as month, COUNT(*) as count')
            ->whereYear('post_date_finished', $currentYear)
            ->whereNotNull('post_date_finished')
            ->where('post_pass_status', 'y')
            ->groupByRaw('MONTH(post_date_finished)');

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
