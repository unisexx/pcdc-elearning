<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Curriculum;
use App\Models\UserType;
use App\Models\Province;
use App\Models\District;
use App\Models\Subdistrict;

class StatController extends Controller
{
    public function index(Request $req)
    {

        $curriculum_id = empty($req->curriculum_id) ? '' : $req->curriculum_id;
        $user_type_id = empty($req->user_type_id) ? '' : $req->user_type_id;
        $exam_year = empty($req->exam_year) ? '' : $req->exam_year;
        $area_id = empty($req->area_id) ? '' : $req->area_id;
        $province_id = empty($req->province_id) ? '' : $req->province_id;
        $district_id = empty($req->district_id) ? '' : $req->district_id;
        $subdistrict_id = empty($req->subdistrict_id) ? '' : $req->subdistrict_id;

        $data['curriculum_id'] = $curriculum_id;
        $data['user_type_id'] = $user_type_id;
        $data['exam_year'] = $exam_year;
        $data['area_id'] = $area_id;
        $data['province_id'] = $province_id;
        $data['district_id'] = $district_id;
        $data['subdistrict_id'] = $subdistrict_id;

        $data['curriculum'] = $curriculum_id ? Curriculum::find($curriculum_id) : "";

        /** หลักสูตร */
        $data['curriculum_list'] = Curriculum::where('status', 'active')->orderBy('pos', 'asc')->pluck('name','id');
        $data['user_type_list'] = UserType::where('status', '1')->orderBy('pos', 'asc')->pluck('name','id');
        
        $min_year = getenv('MIN_YEAR');
        $data['min_year'] = empty($min_year) ? date("Y") + 543 : $min_year;

        $data['provinces'] = Province::orderBy('name', 'asc')->pluck('name','id');
        $data['districts'] = $province_id ? District::whereRaw('left(id,2) = '.$province_id)->orderBy('name', 'asc')->pluck('name','id') : [];
        $data['subdistricts'] = $district_id  ? Subdistrict::whereRaw('left(id,4) = '.$district_id)->orderBy('name', 'asc')->pluck('name','id') : [];

        $data['province_exam'] = $this->provinceReportTable($data);
        
        return view('frontend.stat.index', compact('data'));
    }

    function provinceReportTable($data){
        extract($data);
        $sub_condition = $exam_year ? " and year(post_date_finished) = ".($exam_year-543) : "";
        $main_condition = $province_id ? " and p.id = ".$province_id : "";

        $sql = "SELECT
                    name,
                    (select count(*) from user_curriculum_exam_histories uceh join users u on uceh.user_id = u.id where u.province_id = p.id and post_pass_status is not null ".$sub_condition.")all_exam,
                    (select count(*) from user_curriculum_exam_histories uceh join users u on uceh.user_id = u.id where u.province_id = p.id and post_pass_status = 'y')all_pass_exam,
                    (select count(*) from user_curriculum_exam_histories uceh join users u on uceh.user_id = u.id where u.province_id = p.id and post_pass_status = 'n')all_not_pass_exam
                from	
                provinces p
                where 1=1 ".$main_condition;

        return $province_exam = \DB::select($sql);        
    }
}
