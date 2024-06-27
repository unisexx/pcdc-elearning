<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Faq;
use App\Models\Hilight;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        /** Hilight */
        $hilights = Hilight::where('status', 'active')->orderBy('id', 'desc')->get();

        /** หลักสูตร */
        $curriculums = Curriculum::with('curriculum_lesson')->where('status', 'active')->orderBy('pos', 'asc')->get();

        /** Faq */
        $faqs = Faq::where('status', 'active')->orderBy('order', 'asc')->take(5)->get();

        return view('frontend.home', compact('hilights', 'faqs', 'curriculums'));
    }
}
