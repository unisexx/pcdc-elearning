<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Inbox;
use App\Models\Curriculum;
use App\Models\CurriculumLesson;
use App\Models\CurriculumLessonDetail;
use App\Models\CurriculumLessonQuestion;
use App\Models\CurriculumLessonQuestionAnswer;
use App\Models\UserCurriculumExamHistory;
use App\Models\UserCurriculumPpExam;
use App\Models\UserCurriculumPpExamQas;
use Illuminate\Http\Request;

class ElearningController extends Controller
{
    public function index(Request $req)
    {        
        $curriculum = Curriculum::where('status','active')
                      ->where(function($q) use($req) {
                            if(Auth::user()->is_admin!='1'){
                                $q->whereHas('curriculum_user_type', function ($q) {
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

    public function curriculumLessonExamIntro($curriculum_lesson_id){         
        $exam_type = 'lesson';         
        $curriculum_lesson = CurriculumLesson::find($curriculum_lesson_id);        
        $curriculum = Curriculum::find($curriculum_lesson->curriculum->id);//ค้นหาหลักสูตร
        $curriculum_exam_setting = $curriculum->curriculum_exam_setting->curriculum_exam_setting_detail()->where('curriculum_lesson_id',$curriculum_lesson_id)->first(); //ค้นหาข้อมูลกำหนดค่าการทดสอบ
        $exam_result = UserCurriculumPpExam::where("user_id", Auth::user()->id)->where("curriculum_id",$curriculum->id)->where("exam_type",'lesson')->where('curriculum_lesson_id',$curriculum_lesson_id)->first();        
        if($exam_result){
            $n_question = $exam_result->n_question;
            $pass_score = $exam_result->pass_score;
        }else{
            $n_question = $curriculum_exam_setting->n_question;
            $pass_score = $curriculum_exam_setting->pass_score;
        }
        $bread_crumb_name = 'แบบทดสอบท้ายบทเรียน';        
        //Wait For Check Condition        
        return view('frontend.elearning.exam.intro', compact('curriculum','curriculum_lesson','bread_crumb_name', 'exam_type', 'exam_result', 'n_question', 'pass_score'));  
    }

    public function curriculumLessonExamPrePost($curriculum_id, $exam_type){
        $curriculum = Curriculum::find($curriculum_id);//ค้นหาหลักสูตร
        $curriculum_exam_setting = $curriculum->curriculum_exam_setting()->first(); //ค้นหาข้อมูลกำหนดค่าการทดสอบ
        $exam_result = UserCurriculumPpExam::where("user_id", Auth::user()->id)->where("curriculum_id",$curriculum_id)->where("exam_type",$exam_type)->first();        
        if($exam_result){
            $n_question = $exam_result->n_question;
            $pass_score = $exam_result->pass_score;
        }else{
            $n_question = $curriculum_exam_setting->prepost_n_question;
            $pass_score = $curriculum_exam_setting->prepost_pass_score;
        }
        $bread_crumb_name = $exam_type == 'pretest' ? 'แบบทดสอบก่อนเรียน' : 'วัดผลหลังเรียนรู้';        
        //Wait For Check Condition
        return view('frontend.elearning.exam.intro', compact('curriculum','bread_crumb_name', 'exam_type', 'exam_result', 'n_question', 'pass_score'));                
    }

    public function curriculumLessonExamExecute($curriculum_id, $exam_type){                                    
        $user = \Auth::user();
        $curriculum = Curriculum::find($curriculum_id);//ค้นหาหลักสูตร        
        $curriculum_exam_setting = $curriculum->curriculum_exam_setting()->first(); //ค้นหาข้อมูลกำหนดค่าการทดสอบ
        
        if($exam_type == 'pretest' && request('submit_start')){
            $exam_history = UserCurriculumExamHistory::where('user_id', $user->id)->where('curriculum_id', $curriculum_id)->whereNull('post_date_finished')->first();
            if(!$exam_history){
                $exam_history = UserCurriculumExamHistory::create(['user_id' => $user->id, 'curriculum_id' => $curriculum_id]);
            }
        }else{
            $exam_history = UserCurriculumExamHistory::where('user_id', $user->id)->where('curriculum_id', $curriculum_id)->whereNull('post_date_finished')->first();
            if(!$exam_history)
                $exam_history = UserCurriculumExamHistory::where('user_id', $user->id)->where('curriculum_id', $curriculum_id)->orderBy('id','desc')->first();
        }
        
        if( !empty(request('submit_start')) || !empty(request('submit_restart'))){            
            if($exam_type=='lesson'){
                UserCurriculumPpExam::where('user_curriculum_exam_history_id',$exam_history->id)->where('exam_type',$exam_type)->where('curriculum_lesson_id',request('curriculum_lesson_id'))->delete();
                $exam_lesson_detail = $curriculum_exam_setting->curriculum_exam_setting_detail()->where('exam_status','active')->where('curriculum_lesson_id',request('curriculum_lesson_id'))->first();
                $random_status = $exam_lesson_detail->question_random_status;
            }else{
                UserCurriculumPpExam::where('user_curriculum_exam_history_id',$exam_history->id)->where('exam_type',$exam_type)->where('curriculum_id',$curriculum_id)->delete();
            }
            
            if($exam_type == 'posttest'){                                                    
                $exam_history->update(['post_date_started' => date("Y-m-d H:i:s"), 'post_pass_status' => null]);
            }

            
            $pp_exam['user_id'] = $user->id;
            $pp_exam['user_curriculum_exam_history_id'] = $exam_history->id;
            $pp_exam['exam_type'] = $exam_type;
            $pp_exam['curriculum_id'] = $curriculum_id;
            $pp_exam['curriculum_lesson_id'] = $exam_type == 'lesson' ? request('curriculum_lesson_id') : null;
            $pp_exam['question_random_status'] = $exam_type == 'lesson' ? $random_status : 'active';
            $user_curriculum_pp_exam = UserCurriculumPpExam::create($pp_exam);
        }

        if($exam_type == 'pretest' || $exam_type =='posttest'){
            $n_question = 0;
            foreach($curriculum_exam_setting->curriculum_exam_setting_detail()->where('exam_status','active')->get() as $item){                
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
                        $n_question++;
                    }                
                }            
            }
            if($n_question>0){
                    $user_curriculum_pp_exam->update(['n_question' => $n_question, 'pass_score'=> $curriculum_exam_setting->prepost_pass_score]);
            }
        }else if($exam_type == 'lesson'){
            $n_question = 0;
            foreach($curriculum_exam_setting->curriculum_exam_setting_detail()->where('exam_status','active')->where('curriculum_lesson_id',request('curriculum_lesson_id'))->get() as $item){
                $question_random_status = $item->question_random_status;
                $n_lesson_question = $item->n_question;
                $pass_score = $item->pass_score;
                $curriculum_lesson_id = $item->curriculum_lesson_id;
                if($n_lesson_question > 0){                    
                    if($question_random_status == 'active'){
                        $lesson_question = CurriculumLessonQuestion::where('curriculum_lesson_id',$curriculum_lesson_id)
                        ->inRandomOrder()
                        ->limit($n_lesson_question)
                        ->get();
                    }else{
                        $lesson_question = CurriculumLessonQuestion::where('curriculum_lesson_id',$curriculum_lesson_id)
                        ->orderBy('pos','asc')
                        ->limit($n_lesson_question)
                        ->get();
                    }
                    foreach($lesson_question as $qa){
                        $data['user_curriculum_pp_exam_id'] = $user_curriculum_pp_exam->id;
                        $data['curriculum_lesson_question_id'] = $qa->id;
                        UserCurriculumPpExamQas::create($data);                    
                        $n_question++;
                    }                
                }            
            }
            if($n_lesson_question>0){
                    $user_curriculum_pp_exam->update(['n_question' => $n_lesson_question, 'pass_score'=> $pass_score]);
            }
        }
        return redirect(url('elearning/'.$user_curriculum_pp_exam->id.'/exam'));
    }

    public function curriculumLessonExam($user_curriculum_pp_exam_id){
        $user_curriculum_pp_exam = UserCurriculumPpExam::find($user_curriculum_pp_exam_id);
        $curriculum = Curriculum::find($user_curriculum_pp_exam->curriculum_id);//ค้นหาหลักสูตร
        
        if($user_curriculum_pp_exam->exam_type == 'pretest')
            $bread_crumb_name = 'แบบทดสอบก่อนเรียน';
        elseif($user_curriculum_pp_exam->exam_type == 'posttest')
            $bread_crumb_name = 'วัดผลหลังเรียนรู้';
        else
            $bread_crumb_name = 'แบบทดสอบท้ายบท';
        
        $total_question = $user_curriculum_pp_exam->user_curriculum_pp_exam_qas->count();
        $total_answer = $user_curriculum_pp_exam->user_curriculum_pp_exam_qas->whereNotNull('curriculum_lesson_question_answer_id')->count();
        if($total_question == $total_answer){
            return redirect(url('elearning/curriculum/'.$user_curriculum_pp_exam->curriculum_id.'/'.$user_curriculum_pp_exam->exam_type));
        }

        $question_no = @request('q');        
        if($question_no > 0){
            $current_question = $user_curriculum_pp_exam->user_curriculum_pp_exam_qas()
                                ->where('question_no', $question_no)
                                ->limit(1)
                                ->first();
        }else{
            if($user_curriculum_pp_exam->question_random_status=='active'){
                $current_question = $user_curriculum_pp_exam->user_curriculum_pp_exam_qas()
                ->whereNull('curriculum_lesson_question_answer_id')
                ->inRandomOrder()                                         
                ->limit(1)
                ->first();
            }else{
                $current_question = $user_curriculum_pp_exam->user_curriculum_pp_exam_qas()
                ->whereNull('curriculum_lesson_question_answer_id')
                ->orderBy('id','asc')                                         
                ->limit(1)
                ->first();
            }
        }        
        return view('frontend.elearning.exam.exam', compact('user_curriculum_pp_exam', 'curriculum','bread_crumb_name', 'total_question', 'total_answer','current_question'));
    }

    public function curriculumLessonExamSave(Request $req){        
        $current_question = UserCurriculumPpExamQas::find($req->current_question_id);       
        $user_curriculum_pp_exam = UserCurriculumPpExam::find($current_question->user_curriculum_pp_exam_id);
        $answer_score = CurriculumLessonQuestionAnswer::find($req->answer_id);
        $current_question->update(['curriculum_lesson_question_answer_id' => $req->answer_id, 'score' => $answer_score->score, 'question_no' => $req->question_no]);
        $user_curriculum_pp_exam->update(['total_question' => $user_curriculum_pp_exam->user_curriculum_pp_exam_qas()->whereNotNull('question_no')->count() , 'total_score'=> $user_curriculum_pp_exam->user_curriculum_pp_exam_qas()->sum('score')]);                                
        $total_question = $user_curriculum_pp_exam->user_curriculum_pp_exam_qas->count();
        $total_answer = $user_curriculum_pp_exam->user_curriculum_pp_exam_qas->whereNotNull('curriculum_lesson_question_answer_id')->count();
        
        if($user_curriculum_pp_exam->exam_type == 'lesson' && $total_question == $total_answer){
            return redirect(url('elearning/curriculum/lesson-exam/'.$user_curriculum_pp_exam->curriculum_lesson_id));
        }        
        elseif($user_curriculum_pp_exam->exam_type == 'posttest'){
            $exam_history = UserCurriculumExamHistory::find($user_curriculum_pp_exam->user_curriculum_exam_history_id);
            if($exam_history){
                if(empty($exam_history->post_date_started))
                    $exam_history->update(['post_date_started' => date("Y-m-d H:i:s")]);

                if($total_question == $total_answer){
                    if($user_curriculum_pp_exam->pass_score <= $user_curriculum_pp_exam->total_score)
                        $exam_history->update(['post_date_finished' => date("Y-m-d H:i:s"), 'post_pass_status' => 'y']);
                    else
                        $exam_history->update(['post_date_finished' => date("Y-m-d H:i:s"), 'post_pass_status' => 'n']);

                    return redirect(url('elearning/curriculum/'.$user_curriculum_pp_exam->curriculum_id.'/'.$user_curriculum_pp_exam->exam_type));
                }
            }
        }elseif($user_curriculum_pp_exam->exam_type == 'pretest'  && $total_question == $total_answer){
            return redirect(url('elearning/curriculum/'.$user_curriculum_pp_exam->curriculum_id.'/'.$user_curriculum_pp_exam->exam_type));
        }

        $exists_next_question = $user_curriculum_pp_exam->user_curriculum_pp_exam_qas()->where('question_no',($req->question_no + 1))->count();
        if($exists_next_question>0)
            return redirect(url('elearning/'.$user_curriculum_pp_exam->id.'/exam?q='.($req->question_no + 1)));
        else
            return redirect(url('elearning/'.$user_curriculum_pp_exam->id.'/exam'));
    }
}
