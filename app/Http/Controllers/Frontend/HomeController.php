<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Faq;
use App\Models\Hilight;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        \Log::info('Cookie consent: ' . $request->cookie('cookie_consent'));

        /** Hilight */
        $hilights = Hilight::where('status', 'active')->orderBy('id', 'desc')->get();

        /** หลักสูตร */
        $curriculums = Curriculum::filterByUserType()->with('curriculum_lesson')->where('status', 'active')->orderBy('pos', 'asc')->get();

        /** Faq */
        $faqs = Faq::where('status', 'active')->orderBy('order', 'asc')->take(5)->get();

        /** ข้อมูลสถิติ */
        $post_test_curriculum = Curriculum::where('status', 'active')
        // ->whereHas('curriculum_exam_setting', function ($q) {
        //     $q->where('post_test_status', 'active');
        // })
            ->orderBy('pos', 'asc')->get();

        return view('frontend.home', compact('hilights', 'faqs', 'curriculums', 'post_test_curriculum'));
    }
}
