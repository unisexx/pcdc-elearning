<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        /** Faq */
        $faqs = Faq::where('status', 'active')->orderBy('order', 'asc')->get();

        return view('frontend.faq.index', compact('faqs'));
    }
}
