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

class ElearningHistoryController extends Controller
{
    public function index(Request $req)
    {        
        $exam_history = UserCurriculumExamHistory::where('user_id',\Auth::user()->id)
                      ->where(function($q) use($req) {                            
                                
                      })
                      ->orderBy('created_at','desc')->get();
        return view('frontend.elearning-history.index', compact('exam_history'));
    }        
}
