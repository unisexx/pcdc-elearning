<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Inbox;
use App\Models\Curriculum;
use App\Models\CurriculumLesson;
use App\Models\CurriculumLessonDetail;
use App\Models\UserCurriculumPpExam;
use App\Models\CurriculumLessonQuestion;
use App\Models\UserCurriculumPpExamQas;
use Illuminate\Http\Request;

class ElearningController extends Controller
{
    public function index(Request $req)
    {        
        $curriculum = Curriculum::where('status','active')
                      ->where(function($q) use($req) {
                            if(Auth::user()->is_admin!='1'){
                                $q->whereHas('CurriculumUserTYpe', function ($q) {
                                    $q->where('user_type_id', Auth::user()->user_type_id);
                                });
                            }
                      })
                      ->orderBy('pos','asc')->get();
        return view('frontend.elearning.index', compact('curriculum'));
    }
    
    public function curriculum($curriculum_id){
        $curriculum = Curriculum::find($curriculum_id);        
        return view('frontend.elearning.curriculum.index', compact('curriculum'));
    }

    public function curriculumLesson($curriculum_lesson_id){        
        $curriculum_lesson = CurriculumLesson::find($curriculum_lesson_id);        
        $curriculum = Curriculum::find($curriculum_lesson->curriculum_id);
        $page = empty(Request('page')) ? 1 : Request("page");
        $total_page = $curriculum_lesson->curriculum_lesson_detail->count();

        $detail = CurriculumLessonDetail::where('curriculum_lesson_id',$curriculum_lesson_id)->orderBy('pos','asc')->paginate(1);
        return view('frontend.elearning.curriculum.lesson', compact('curriculum','curriculum_lesson', 'detail','page', 'total_page'));
    }

    public function curriculumLessonExam($curriculum_lesson_id){                  
        $curriculum_lesson = CurriculumLesson::find($curriculum_lesson_id);        

        $page = empty(Request('page')) ? 1 : Request("page");
        $total_page = $curriculum_lesson->curriculum_lesson_detail->count();

        $detail = CurriculumLessonDetail::where('curriculum_lesson_id',$curriculum_lesson_id)->orderBy('pos','asc')->paginate(1);
        return view('frontend.elearning.curriculum.lesson', compact('curriculum_lesson', 'detail','page', 'total_page'));
    }

    public function curriculumLessonExamPrePost($curriculum_id, $exam_type){
        $curriculum = Curriculum::find($curriculum_id);//ค้นหาหลักสูตร
        $curriculum_exam_setting = $curriculum->curriculum_exam_setting()->first(); //ค้นหาข้อมูลกำหนดค่าการทดสอบ

        $user_curriculum_pp_exam = UserCurriculumPpExam::where("user_id", Auth::user()->id)->where("curriculum_id",$curriculum_id)->where("exam_type",$exam_type)->get();
        // dd($user_curriculum_pp_exam);

        $bread_crumb_name = $exam_type == 'pretest' ? 'แบบทดสอบก่อนเรียน' : 'วัดผลหลังเรียนรู้';
        
        //Wait For Check Condition
        return view('frontend.elearning.exam.intro', compact('curriculum','bread_crumb_name'));
        
        return view('frontend.elearning.exam.question', compact('curriculum'));
    }

    public function curriculumLessonExamPrePostStart($curriculum_id, $exam_type){
        // dd($curriculum_id, $exam_type);
        $curriculum = Curriculum::find($curriculum_id);//ค้นหาหลักสูตร
        $curriculum_exam_setting = $curriculum->curriculum_exam_setting()->first(); //ค้นหาข้อมูลกำหนดค่าการทดสอบ

        $pp_exam['user_id'] = \Auth::user()->id;
        $pp_exam['exam_type'] = $exam_type;
        $pp_exam['curriculum_id'] = $curriculum_id;
        $user_curriculum_pp_exam = UserCurriculumPpExam::create($pp_exam);
        foreach($curriculum_exam_setting->curriculum_exam_setting_detail()->where('exam_status','active')->get() as $item){
            $question_random_status = $item->question_random_status;
            $n_prepost_lesson_question = $item->n_prepost_lesson_question;
            $curriculum_lesson_id = $item->curriculum_lesson_id;
            if($n_prepost_lesson_question > 0){
                $lesson_question = CurriculumLessonQuestion::where('curriculum_lesson_id',$curriculum_lesson_id)
                ->inRandomOrder()
                ->limit($n_prepost_lesson_question)
                ->get();
                foreach($lesson_question as $qa){
                    $data['user_curriculum_pp_exam_id'] = $user_curriculum_pp_exam->id;
                    $data['curriculum_lesson_question_id'] = $qa->id;
                    UserCurriculumPpExamQas::create($data);                    
                }
            }
        }
        return redirect(url('elearning/'.$user_curriculum_pp_exam->id.'/exam'));
    }

    public function curriculumLessonExamPrePostExam($user_curriculum_pp_exam_id){
        $user_curriculum_pp_exam = UserCurriculumPpExam::find($user_curriculum_pp_exam_id);
        $curriculum = Curriculum::find($user_curriculum_pp_exam->curriculum_id);//ค้นหาหลักสูตร
        $bread_crumb_name = $user_curriculum_pp_exam->exam_type == 'pretest' ? 'แบบทดสอบก่อนเรียน' : 'วัดผลหลังเรียนรู้';        
        $total_question = $user_curriculum_pp_exam->user_curriculum_pp_exam_qas->count();
        $total_answer = $user_curriculum_pp_exam->user_curriculum_pp_exam_qas->whereNotNull('curriculum_lesson_answer_id')->count();
        $current_question = $user_curriculum_pp_exam->user_curriculum_pp_exam_qas()
                            ->whereNull('curriculum_lesson_answer_id')
                            ->inRandomOrder()
                            ->limit(1)
                            ->first();
        return view('frontend.elearning.exam.exam', compact('user_curriculum_pp_exam', 'curriculum','bread_crumb_name', 'total_question', 'total_answer','current_question'));
    }
}
