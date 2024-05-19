<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('frontend.login.login');
    }

    public function register()
    {
        $provinces = Province::orderBy('id', 'asc')->pluck('name', 'id');

        return view('frontend.login.register', compact('provinces'));
    }
}
