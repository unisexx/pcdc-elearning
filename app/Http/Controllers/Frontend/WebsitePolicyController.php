<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WebsitePolicy;
use Illuminate\Http\Request;

class WebsitePolicyController extends Controller
{
    public function index()
    {
        /** WebsitePolicy */
        $rs = WebsitePolicy::first();

        return view('frontend.website-policy.index', compact('rs'));
    }
}
