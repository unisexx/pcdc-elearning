<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hilight;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        /** Hilight */
        $hilights = Hilight::where('status', 'active')->orderBy('id', 'desc')->get();

        return view('frontend.home', compact('hilights'));
    }
}
