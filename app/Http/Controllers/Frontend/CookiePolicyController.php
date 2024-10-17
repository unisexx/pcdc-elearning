<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CookiePolicy;
use Illuminate\Http\Request;

class CookiePolicyController extends Controller
{
    public function index()
    {
        /** CookiePolicy */
        $rs = CookiePolicy::first();

        return view('frontend.cookie-policy.index', compact('rs'));
    }
}
