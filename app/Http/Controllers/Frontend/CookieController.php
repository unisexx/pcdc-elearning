<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function acceptCookie(Request $request)
    {
        return response('Cookie set successfully')->cookie(
            'cookie_consent', '1', 60 * 24 * 30, '/'
        );
    }
}
