<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\CurriculumLesson;
use App\Models\CurriculumQuestion;
use App\Models\CurriculumExamSetting;
use App\Models\CurriculumExamSettingDetail;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class CurriculumExamSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCurriculum($req){
        if(empty($req->curriculum_id)){
            return redirect(url('admin/curriculum'));
        }
        $curriculum = Curriculum::find($req->curriculum_id);
        if(empty($curriculum)){
            return redirect(url('admin/curriculum'));
        }
        return $curriculum;
    }
    public function index(Request $req){

        $curriculum = $this->getCurriculum($req);        
        $rs = CurriculumExamSetting::where('curriculum_id',$req->curriculum_id)->first();

        return view('admin.curriculum.exam-setting', compact('rs','curriculum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $ces = CurriculumExamSetting::where('curriculum_id',$input['curriculum_id'])->first();
        
        if(empty($ces))
            $ces = CurriculumExamSetting::create($input);
        else
            $ces->update($input);
        
        CurriculumExamSettingDetail::where('curriculum_exam_setting_id',$ces->id)->delete();
        
        $clesson = CurriculumLesson::where('curriculum_id',$input['curriculum_id'])->get();
        
        if(!empty($clesson)){
            foreach($clesson as $key=>$lesson){

                $data['curriculum_exam_setting_id'] = $ces->id;
                $data['curriculum_lesson_id'] = $lesson->id;
                $data['exam_status'] = @$input['exam_status_'.$lesson->id];
                $data['question_random_status'] = @$input['question_random_status_'.$lesson->id];
                $data['n_question'] = @$input['n_question_'.$lesson->id];
                $data['pass_score'] = @$input['pass_score_'.$lesson->id];
                $data['n_prepost_lesson_question'] = @$input['n_prepost_lesson_question_'.$lesson->id];
                $cesd = CurriculumExamSettingDetail::create($data);
            }

        }

        $ces->update(['prepost_n_question' => $ces->curriculum_exam_setting_detail()->whereNotNull('n_prepost_lesson_question')->sum('n_prepost_lesson_question')]);

        set_notify('success', 'บันทึกข้อมูลเรียบร้อย');

        return redirect(url('admin/curriculum-exam-setting?curriculum_id='.$input['curriculum_id']));
    }
}
