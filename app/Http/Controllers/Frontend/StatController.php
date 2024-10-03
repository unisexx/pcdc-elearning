<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\District;
use App\Models\PreventionOffice;
use App\Models\Province;
use App\Models\Subdistrict;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index(Request $req)
    {
        $curriculum_id  = empty($req->curriculum_id) ? '' : $req->curriculum_id;
        $user_type_id   = empty($req->user_type_id) ? '' : $req->user_type_id;
        $exam_year      = empty($req->exam_year) ? '' : $req->exam_year;
        $area_id        = empty($req->area_id) ? '' : $req->area_id;
        $province_id    = empty($req->province_id) ? '' : $req->province_id;
        $district_id    = empty($req->district_id) ? '' : $req->district_id;
        $subdistrict_id = empty($req->subdistrict_id) ? '' : $req->subdistrict_id;

        $export_param = 'curriculum_id=' . $curriculum_id . '&user_type_id=' . $user_type_id . '&exam_year=' . $exam_year . '&area_id=' . $area_id . '&province_id=' . $province_id . '&district_id=' . $district_id . '&subdistrict_id=' . $subdistrict_id;

        $data['curriculum_id']  = $curriculum_id;
        $data['user_type_id']   = $user_type_id;
        $data['exam_year']      = $exam_year;
        $data['area_id']        = $area_id;
        $data['province_id']    = $province_id;
        $data['district_id']    = $district_id;
        $data['subdistrict_id'] = $subdistrict_id;
        $data['export_param']   = $export_param;

        $data['curriculum'] = $curriculum_id ? Curriculum::find($curriculum_id) : "";

        /** หลักสูตร */
        $data['user_type_list']  = UserType::where('status', '1')->orderBy('pos', 'asc')->pluck('name', 'id');
        $data['curriculum_list'] = !empty($user_type_id) ? Curriculum::where('status', 'active')
            ->whereHas('curriculum_user_type', function ($q) use ($user_type_id) {
                $q->where('user_type_id', $user_type_id);
            })->orderBy('pos', 'asc')->pluck('name', 'id') : [];
        $data['prevention_office_list'] = \App\Models\PreventionOffice::where('status', 'active')->orderBy('pos', 'asc')->pluck('name', 'id');

        $min_year         = getenv('MIN_YEAR');
        $data['min_year'] = empty($min_year) ? date("Y") + 543 : $min_year;

        $data['provinces']    = !empty($area_id) ? Province::where('prevention_office_id', $area_id)->orderBy('name', 'asc')->pluck('name', 'id') : Province::orderBy('name', 'asc')->pluck('name', 'id');
        $data['districts']    = !empty($province_id) ? District::whereRaw('left(id,2) = ' . $province_id)->orderBy('name', 'asc')->pluck('name', 'id') : [];
        $data['subdistricts'] = !empty($district_id) ? Subdistrict::whereRaw('left(id,4) = ' . $district_id)->orderBy('name', 'asc')->pluck('name', 'id') : [];

        $data['curriculum_list_rep'] = !empty($curriculum_id) ? Curriculum::where('status', 'active')->where('id', $curriculum_id)->with('curriculum_user_type.user_type')->get() : Curriculum::where('status', 'active')->with('curriculum_user_type.user_type')->get();

        $data['curriculum_condition']  = !empty($curriculum_id) ? " AND uceh.curriculum_id =" . $curriculum_id : "";
        $data['user_type_condition']   = !empty($user_type_id) ? " AND u.user_type_id =" . $user_type_id : "";
        $data['year_condition']        = !empty($exam_year) ? " and year(post_date_finished) =" . ($exam_year - 543) : '';
        $data['area_condition']        = !empty($area_id) ? " and (u.area_id = " . $area_id . ' or p.prevention_office_id =' . $area_id . ") " : '';
        $data['province_condition']    = !empty($province_id) ? " and u.province_id = " . $province_id : '';
        $data['district_condition']    = !empty($district_id) ? " and u.district_id = " . $district_id : '';
        $data['subdistrict_condition'] = !empty($subdistrict_id) ? " and u.subdistrict_id = " . $subdistrict_id : '';

        //report1
        $data['curriculum_month_pass_report'] = $this->curriculumMonthReport($data);

        //report2
        $data['curriculum_stack_exam_report'] = $this->curriculumMonthReport($data, 'sum_curriculum');

        //report3
        $data['curriculum_office_report'] = $this->curriculumOfficeReport($data);

        //report4
        $data['province_exam'] = $this->provinceReportTable($data);

        if ($req->export_type == 'xls') {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=e-learning_stat.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            return view('frontend.stat.excel', compact('data'));
        }

        return view('frontend.stat.index', compact('data'));
    }

    function curriculumMonthReport($data, $option_type = '')
    {
        extract($data);
        $curriculum_month_pass_report = [];
        $default_condition            = $year_condition . $user_type_condition . $area_condition . $province_condition . $district_condition . $subdistrict_condition;
        $default_from                 = " FROM user_curriculum_exam_histories uceh JOIN users u ON uceh.user_id = u.id left join provinces p on u.province_id = p.id ";

        // Define the start date condition
        $startDate      = Carbon::create(2024, 10, 1)->toDateString();
        $date_condition = " AND uceh.created_at >= '$startDate'";

        if ($option_type == '') {

            foreach ($curriculum_list_rep as $item) {

                $userTypeNames = []; // อาเรย์สำหรับเก็บชื่อ user_type

                // ตรวจสอบว่ามี user_types เชื่อมต่ออยู่หรือไม่
                if ($item->curriculum_user_type) {
                    // วนลูปผ่าน curriculum_user_type ที่เชื่อมโยง
                    foreach ($item->curriculum_user_type as $curriculumUserType) {
                        if ($curriculumUserType->user_type) {
                            // เก็บชื่อของ user_type ในอาเรย์
                            $userTypeNames[] = $curriculumUserType->user_type->name;
                        }
                    }
                }

                // รวมชื่อ user_type เป็นสตริง โดยใช้เครื่องหมาย ',' คั่น
                $userTypeNameString = implode(', ', $userTypeNames);

                $curriculum_month_pass_report[$item->id]['name'] = $item->name . '(' . $userTypeNameString . ')';

                for ($m = 1; $m <= 12; $m++) {
                    // Query for pass
                    $rep_sql                                                   = "SELECT count(*) n_pass_m_" . $m . $default_from . " WHERE 1=1 AND curriculum_id = " . $item->id . " AND post_pass_status = 'y'";
                    $month_condition                                           = " and month(post_date_finished) =" . $m;
                    $curriculum_month_pass_report[$item->id]['n_pass_m_' . $m] = \DB::select($rep_sql . $default_condition . $month_condition . $date_condition)[0]->{'n_pass_m_' . $m};

                    // Query for no pass
                    $rep_sql                                                      = "SELECT count(*) n_no_pass_m_" . $m . $default_from . " WHERE 1=1 AND curriculum_id = " . $item->id . " AND post_pass_status = 'n'";
                    $curriculum_month_pass_report[$item->id]['n_no_pass_m_' . $m] = \DB::select($rep_sql . $default_condition . $month_condition . $date_condition)[0]->{'n_no_pass_m_' . $m};
                }
            }

        } elseif ($option_type == 'sum_curriculum') {
            $curriculum_condition = !empty($curriculum_id) ? ' and curriculum_id =' . $curriculum_id : '';
            for ($m = 1; $m <= 12; $m++) {
                // Sum pass query
                $rep_sql                                        = "SELECT count(*) n_pass_m_" . $m . $default_from . " WHERE 1=1 AND post_pass_status = 'y'";
                $month_condition                                = " and month(post_date_finished) =" . $m;
                $curriculum_month_pass_report['n_pass_m_' . $m] = \DB::select($rep_sql . $default_condition . $month_condition . $curriculum_condition . $date_condition)[0]->{'n_pass_m_' . $m};

                // Sum no pass query
                $rep_sql                                           = "SELECT count(*) n_no_pass_m_" . $m . $default_from . " WHERE 1=1 AND post_pass_status = 'n'";
                $curriculum_month_pass_report['n_no_pass_m_' . $m] = \DB::select($rep_sql . $year_condition . $month_condition . $user_type_condition . $date_condition)[0]->{'n_no_pass_m_' . $m};
            }
        }

        return $curriculum_month_pass_report;
    }

    function curriculumOfficeReport($data)
    {
        extract($data);

        // กำหนด startDate สำหรับใช้ในเงื่อนไขวันที่
        $startDate = Carbon::create(2024, 10, 1)->toDateString();

        // เพิ่มเงื่อนไขสำหรับวันที่สร้างขึ้นตาม startDate
        $date_condition = " AND uceh.created_at >= '$startDate'";

        // เงื่อนไขพื้นฐานสำหรับกรองข้อมูล
        $default_condition = $year_condition . $user_type_condition . $area_condition . $province_condition . $district_condition . $subdistrict_condition . $curriculum_condition . $date_condition;

        // SQL พื้นฐานสำหรับการดึงข้อมูล
        $main_from = "SELECT count(*) n_pass FROM user_curriculum_exam_histories uceh
                        INNER JOIN users u ON uceh.user_id = u.id
                        LEFT JOIN provinces p on u.province_id = p.id ";

        // ดึงข้อมูลรายงานของ office แต่ละแห่ง
        foreach (PreventionOffice::where('status', 'active')->orderBy('pos')->get() as $item) {
            $curriculum_office_report[$item->id]['name'] = $item->abbr_name;

            // Query ดึงจำนวนสอบผ่านตาม office แต่ละแห่ง
            $rep_sql = $main_from . " WHERE 1=1 " . $curriculum_condition . "
                                    AND post_pass_status = 'y'
                                    AND (p.prevention_office_id = " . $item->id . " OR u.area_id = " . $item->id . ")";

            // เพิ่มเงื่อนไขวันที่ใน SQL
            $curriculum_office_report[$item->id]['n_pass'] = \DB::select($rep_sql . $default_condition)[0]->{'n_pass'};
        }

        // คืนค่าผลลัพธ์ของรายงาน office
        return $curriculum_office_report;
    }

    function provinceReportTable($data)
    {
        extract($data);

        // กำหนด startDate สำหรับใช้ในเงื่อนไขวันที่
        $startDate = Carbon::create(2024, 10, 1)->toDateString();

        // เงื่อนไขที่ใช้ในการกรองข้อมูลตามวันที่ที่สร้าง
        $date_condition = " AND uceh.created_at >= '$startDate'";

        $sub_condition = $year_condition . $user_type_condition . $district_condition . $subdistrict_condition . $curriculum_condition . $date_condition;

        // สร้างเงื่อนไขหลักสำหรับการกรองข้อมูลตาม area_id และ province_id
        $main_condition = "";
        $main_condition .= !empty($area_id) ? " and prevention_office_id=" . $area_id : "";
        $main_condition .= !empty($province_id) ? " and id =" . $province_id : "";

        // SQL พื้นฐานในการนับจำนวนสอบและจำนวนสอบผ่าน/ไม่ผ่าน
        $default_select = "
            select count(*) from
            user_curriculum_exam_histories uceh
            join users u on uceh.user_id = u.id
        ";

        // SQL สำหรับดึงข้อมูลจำนวนสอบ, ผ่าน, และไม่ผ่านตามเงื่อนไขที่กำหนด
        $sql = "SELECT
                name,
                (" . $default_select . " where u.province_id = p.id and post_pass_status is not null " . $sub_condition . ")all_exam,
                (" . $default_select . " where u.province_id = p.id and post_pass_status = 'y'" . $sub_condition . ")all_pass_exam,
                (" . $default_select . " where u.province_id = p.id and post_pass_status = 'n'" . $sub_condition . ")all_not_pass_exam
            from
            provinces p
            where 1=1 " . $main_condition;

        // คืนค่าผลลัพธ์ของการ Query ข้อมูล
        return $province_exam = \DB::select($sql);
    }

}
