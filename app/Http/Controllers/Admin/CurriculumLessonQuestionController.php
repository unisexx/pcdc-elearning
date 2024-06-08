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

        if(!empty($request->page_detail)){
            foreach($request->page_detail as $key=>$detail){
                $data['curriculum_lesson_question_id'] = $curriculum_lesson_question->id;
                $data['name'] = $detail;
                $data['score'] = $request->score[$key];
                $data['status'] = 'active';
                $data['pos'] = (CurriculumLessonQuestionAnswer::where('curriculum_lesson_question_id',$curriculum_lesson_question->id)->max('pos') + 1);
                $curriculum_lession_detail = CurriculumLessonQuestionAnswer::create($data);
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

        CurriculumLessonQuestionAnswer::where('curriculum_lesson_question_id',$id)->delete();

        if(!empty($request->page_detail)){
            foreach($request->page_detail as $key=>$detail){
                $data['curriculum_lesson_question_id'] = $id;
                $data['name'] = $detail;
                $data['score'] = $request->score[$key];
                $data['status'] = 'active';
                $data['pos'] = (CurriculumLessonQuestionAnswer::where('curriculum_lesson_question_id',$id)->max('pos') + 1);
                $curriculum_lession_detail = CurriculumLessonQuestionAnswer::create($data);
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
