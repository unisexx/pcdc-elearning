<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        /** PrivacyPolicy */
        $rs = PrivacyPolicy::first();

        return view('frontend.privacy-policy.index', compact('rs'));
    }
}
