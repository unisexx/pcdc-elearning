<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JsValidator;

class RegisterController extends Controller
{
    public function form()
    {
        $provinces = Province::orderBy('id', 'asc')->pluck('name', 'id');

        return view('frontend.register.form', compact('provinces'));
    }

    public function register(RegisterUserRequest $request)
    {
        $user                  = new User();
        $user->user_type_id    = $request->user_type_id;
        $user->prefix          = $request->prefix;
        $user->first_name      = $request->first_name;
        $user->last_name       = $request->last_name;
        $user->gender          = $request->gender;
        $user->age             = $request->age;
        $user->center_name     = $request->center_name;
        $user->school_name     = $request->school_name;
        $user->address_no      = $request->address_no;
        $user->village_no      = $request->village_no;
        $user->center_phone    = $request->center_phone;
        $user->school_phone    = $request->school_phone;
        $user->province        = $request->province;
        $user->district        = $request->district;
        $user->subdistrict     = $request->subdistrict;
        $user->zipcode         = $request->zipcode;
        $user->affiliation     = $request->affiliation;
        $user->officer_type    = $request->officer_type;
        $user->area            = $request->area;
        $user->position        = $request->position;
        $user->education_level = $request->education_level;
        $user->phone           = $request->phone;
        $user->email           = $request->email;
        $user->username        = $request->username;
        $user->password        = bcrypt($request->password);
        $user->save();

        return redirect()->route('home')->with('success', 'ลงทะเบียนสำเร็จ');
    }
}
