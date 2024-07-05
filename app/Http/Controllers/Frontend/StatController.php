<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Curriculum;
use App\Models\UserType;
use App\Models\Province;
use App\Models\District;
use App\Models\Subdistrict;
use App\Models\PreventionOffice;

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
        $data['prevention_office_list'] = \App\Models\PreventionOffice::where('status','active')->orderBy('pos','asc')->pluck('name','id');
        
        $min_year = getenv('MIN_YEAR');
        $data['min_year'] = empty($min_year) ? date("Y") + 543 : $min_year;

        $data['provinces'] = !empty($area_id) ? Province::where('prevention_office_id',$area_id)->orderBy('name', 'asc')->pluck('name','id') :Province::orderBy('name', 'asc')->pluck('name','id');
        $data['districts'] = !empty($province_id) ? District::whereRaw('left(id,2) = '.$province_id)->orderBy('name', 'asc')->pluck('name','id') : [];
        $data['subdistricts'] = !empty($district_id)  ? Subdistrict::whereRaw('left(id,4) = '.$district_id)->orderBy('name', 'asc')->pluck('name','id') : [];

        $data['curriculum_list_rep'] = !empty($curriculum_id) ? Curriculum::where('id',$curriculum_id)->get() : Curriculum::get();

        $data['curriculum_condition'] = !empty($curriculum_id) ? " AND uceh.curriculum_id =".$curriculum_id : "";
        $data['user_type_condition'] = !empty($user_type_id) ? " AND u.user_type_id =".$user_type_id : "";
        $data['year_condition'] = !empty($exam_year) ? " and year(post_date_finished) =".($exam_year-543) : '';    
        $data['area_condition'] = !empty($area_id) ? " and (u.area_id = ".$area_id.' or p.prevention_office_id ='.$area_id.") " : '';        
        $data['province_condition'] = !empty($province_id) ? " and u.province_id = ".$province_id : '';        
        $data['district_condition'] = !empty($district_id) ? " and u.district_id = ".$district_id : '';        
        $data['subdistrict_condition'] = !empty($subdistrict_id) ? " and u.subdistrict_id = ".$subdistrict_id : '';        
        
        //report1
        $data['curriculum_month_pass_report'] = $this->curriculumMonthReport($data);
        
        //report2
        $data['curriculum_stack_exam_report'] = $this->curriculumMonthReport($data, 'sum_curriculum');

        //report3
        $data['curriculum_office_report'] = $this->curriculumOfficeReport($data);

        //report4
        $data['province_exam'] = $this->provinceReportTable($data);
                

        return view('frontend.stat.index', compact('data'));
    }



    function curriculumMonthReport($data, $option_type = ''){
        extract($data);
        $curriculum_month_pass_report = [];        
        $default_condition = $year_condition.$user_type_condition.$area_condition.$province_condition.$district_condition.$subdistrict_condition;
        $default_from = " FROM user_curriculum_exam_histories uceh JOIN users u ON uceh.user_id = u.id left join provinces p on u.province_id = p.id ";
        if($option_type==''){
            
            foreach($curriculum_list_rep as $item){
                $curriculum_month_pass_report[$item->id]['name'] = $item->name;
                for($m=1;$m<=12;$m++){
                    $rep_sql = "SELECT count(*) n_pass_m_".$m.$default_from."  WHERE 1=1 AND curriculum_id = ".$item->id." AND post_pass_status = 'y'";
                    $month_condition = " and month(post_date_finished) =".$m;
                    $curriculum_month_pass_report[$item->id]['n_pass_m_'.$m] = \DB::select($rep_sql.$default_condition.$month_condition)[0]->{'n_pass_m_'.$m};

                    $rep_sql = "SELECT count(*) n_no_pass_m_".$m.$default_from." WHERE 1=1 AND curriculum_id = ".$item->id." AND post_pass_status = 'n'";
                    $month_condition = " and month(post_date_finished) =".$m;
                    $curriculum_month_pass_report[$item->id]['n_no_pass_m_'.$m] = \DB::select($rep_sql.$default_condition.$month_condition)[0]->{'n_no_pass_m_'.$m};
                }
            }        
        }elseif($option_type=='sum_curriculum'){
            $curriculum_condition = !empty($curriculum_id) ? ' and curriculum_id ='.$curriculum_id : '';
            for($m=1;$m<=12;$m++){
                $rep_sql = "SELECT count(*) n_pass_m_".$m.$default_from."  WHERE 1=1 AND post_pass_status = 'y'";
                $month_condition = " and month(post_date_finished) =".$m;
                $curriculum_month_pass_report['n_pass_m_'.$m] = \DB::select($rep_sql.$default_condition.$month_condition.$curriculum_condition)[0]->{'n_pass_m_'.$m};

                $rep_sql = "SELECT count(*) n_no_pass_m_".$m.$default_from." WHERE 1=1 AND post_pass_status = 'n'";
                $month_condition = " and month(post_date_finished) =".$m;
                $curriculum_month_pass_report['n_no_pass_m_'.$m] = \DB::select($rep_sql.$year_condition.$month_condition.$user_type_condition)[0]->{'n_no_pass_m_'.$m};
            }
        }
        return $curriculum_month_pass_report;
    }

    function curriculumOfficeReport($data){
        extract($data);
        $curriculum_office_report = [];        
        $default_condition = $year_condition.$user_type_condition.$area_condition.$province_condition.$district_condition.$subdistrict_condition.$curriculum_condition;
        
        $main_from = "SELECT count(*) n_pass FROM user_curriculum_exam_histories uceh 
                            INNER JOIN users u ON uceh.user_id = u.id 
                            LEFT JOIN provinces p on u.province_id = p.id ";
        
        foreach(PreventionOffice::where('status','active')->orderBy('pos')->get() as $item){
            $curriculum_office_report[$item->id]['name'] = $item->abbr_name;                
            
            $rep_sql = $main_from."  WHERE 1=1 ".$curriculum_condition."                           
                                    AND post_pass_status = 'y' 
                                    AND (p.prevention_office_id =".$item->id." or u.area_id =".$item->id.") ";    

            $curriculum_office_report[$item->id]['n_pass'] = \DB::select($rep_sql.$year_condition)[0]->{'n_pass'};                
        }
        return $curriculum_office_report;
    }

    function provinceReportTable($data){
        extract($data);
        $sub_condition = $year_condition.$user_type_condition.$district_condition.$subdistrict_condition.$curriculum_condition;        
        
        $main_condition = "";
        $main_condition.= !empty($area_id) ? " and prevention_office_id=".$area_id : "";
        $main_condition.= !empty($province_id) ? " and id =".$province_id : "";
        
        $default_select = "
            select count(*) from 
            user_curriculum_exam_histories uceh 
            join users u on uceh.user_id = u.id 

        ";
        $sql = "SELECT
                    name,
                    (".$default_select." where u.province_id = p.id and post_pass_status is not null ".$sub_condition.")all_exam,
                    (".$default_select." where u.province_id = p.id and post_pass_status = 'y'".$sub_condition.")all_pass_exam,
                    (".$default_select." where u.province_id = p.id and post_pass_status = 'n'".$sub_condition.")all_not_pass_exam
                from	
                provinces p
                where 1=1 ".$main_condition;

        return $province_exam = \DB::select($sql);        
    }
}
