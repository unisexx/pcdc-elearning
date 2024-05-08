<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('frontend.login.login');
    }

    public function register()
    {
        return view('frontend.login.register');
    }
}
