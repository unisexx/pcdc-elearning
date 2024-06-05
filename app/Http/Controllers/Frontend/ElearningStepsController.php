<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class ElearningStepsController extends Controller
{
    public function index()
    {
        /** PrivacyPolicy */
        $rs = PrivacyPolicy::first();

        return view('frontend.elearning-steps.index', compact('rs'));
    }
}
