<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hilight;

class HilightController extends Controller
{
    public function view($id)
    {
        $rs = Hilight::find($id);

        return view('frontend.hilight.view', compact('rs'));
    }
}
