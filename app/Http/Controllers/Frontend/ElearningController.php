<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use App\Models\Curriculum;
use App\Models\CurriculumLesson;
use App\Models\CurriculumLessonDetail;
use Illuminate\Http\Request;

class ElearningController extends Controller
{
    public function index()
    {
        $curriculum = Curriculum::where('status','active')->orderBy('pos','asc')->get();
        return view('frontend.elearning.index', compact('curriculum'));
    }
    
    public function curriculum($curriculum_id){
        $curriculum = Curriculum::find($curriculum_id);        
        return view('frontend.elearning.curriculum.index', compact('curriculum'));
    }

    public function curriculumLesson($curriculum_lesson_id){        
        $curriculum_lesson = CurriculumLesson::find($curriculum_lesson_id);        

        $page = empty(Request('page')) ? 1 : Request("page");
        $total_page = $curriculum_lesson->curriculum_lesson_detail->count();

        $detail = CurriculumLessonDetail::where('curriculum_lesson_id',$curriculum_lesson_id)->orderBy('pos','asc')->paginate(1);
        return view('frontend.elearning.curriculum.lesson', compact('curriculum_lesson', 'detail','page', 'total_page'));
    }
}
