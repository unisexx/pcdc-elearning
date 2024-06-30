<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\CurriculumLesson;
use App\Models\CurriculumLessonQuestion;
use App\Models\CurriculumLessonQuestionAnswer;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class CurriculumLessonQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCurriculumLesson($req){
        if(empty($req->curriculum_lesson_id)){
            return redirect(url('admin/curriculum'));
        }
        $curriculum_lesson = CurriculumLesson::find($req->curriculum_lesson_id);
        if(empty($curriculum_lesson)){
            return redirect(url('admin/curriculum'));
        }
        return $curriculum_lesson;
    }
    public function index(Request $req){

        $curriculum_lesson = $this->getCurriculumLesson($req);
        $rs = CurriculumLessonQuestion::where('curriculum_lesson_id',$req->curriculum_lesson_id)->paginate(10);

        return view('admin.curriculum-lesson-question.index', compact('rs','curriculum_lesson'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req)
    {
        $curriculum_lesson = $this->getCurriculumLesson($req);
        return view('admin.curriculum-lesson-question.create', compact('curriculum_lesson'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'pos' => (CurriculumLessonQuestion::where('curriculum_lesson_id',$request->curriculum_lesson_id)->max('pos') + 1)
        ]);
        $input = $request->all();        
        $curriculum_lesson_question = CurriculumLessonQuestion::create($input);

        if(@$request->total_answer > 0){
            for($i=1;$i<=$request->total_answer;$i++){
                if(@$request->{'page_detail_'.$i}){
                    $data['curriculum_lesson_question_id'] = $curriculum_lesson_question->id;
                    $data['name'] = $request->{'page_detail_'.$i};
                    $data['score'] = @$request->correct_answer == $i ? 1 : 0;
                    $data['status'] = 'active';
                    $data['pos'] = $request->{'answer_pos_'.$i};
                    $curriculum_lession_detail = CurriculumLessonQuestionAnswer::create($data);
                }
            }            
        }

        set_notify('success', 'บันทึกข้อมูลเรียบร้อย');

        return redirect(url('admin/curriculum-lesson-question?curriculum_lesson_id='.$curriculum_lesson_question->curriculum_lesson_id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rs = CurriculumLessonQuestion::find($id);
        $curriculum_lesson = CurriculumLesson::find($rs->curriculum_lesson_id);        
        return view('admin.curriculum-lesson-question.edit', @compact('rs', 'curriculum_lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();

        $rs = CurriculumLessonQuestion::find($id);
        $rs->update($input);

        if(@$request->total_answer > 0){
            for($i=1;$i<=$request->total_answer;$i++){
                if(@$request->{'page_detail_'.$i}){
                    $data['curriculum_lesson_question_id'] = $rs->id;
                    $data['name'] = $request->{'page_detail_'.$i};
                    $data['score'] = @$request->correct_answer == $i ? 1 : 0;
                    $data['status'] = 'active';
                    $data['pos'] = $request->{'answer_pos_'.$i};
                    if($request->{'answer_id_'.$i} == 'new'){
                        CurriculumLessonQuestionAnswer::create($data);
                    }else{
                        CurriculumLessonQuestionAnswer::find($request->{'answer_id_'.$i})->update($data);
                    }
                    
                }
            }            
        }

        if(!empty($request->delete_answer)){
            foreach($request->delete_answer as $item){
                if($item)
                    CurriculumLessonQuestionAnswer::find($item)->delete();
            }
        }

        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        return redirect(url('admin/curriculum-lesson-question?curriculum_lesson_id='.$rs->curriculum_lesson_id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CurriculumLessonQuestion::find($id)->delete();
        set_notify('success', 'ลบข้อมูลเรียบร้อย');

        return back();
    }
}
