<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function form()
    {
        $provinces = Province::orderBy('id', 'asc')->pluck('name', 'id');

        return view('frontend.register.form', compact('provinces'));
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'user_type_id' => 'required',
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'gender'       => 'required',
            'age'          => 'nullable|integer|min:0',
            'center_name'  => 'required_if:user_type,1',
            'school_name'  => 'required_if:user_type,2',
            'address_no'   => 'required_if:user_type,1,2,4',
            'village_no'   => 'required_if:user_type,1,2,4',
            'center_phone' => 'required_if:user_type,1',
            'school_phone' => 'required_if:user_type,2',
            'province'     => 'required_if:user_type,1,2,4',
            'district'     => 'required_if:user_type,1,2,4',
            'subdistrict'  => 'required_if:user_type,1,2,4',
            'zipcode'      => 'required_if:user_type,1,2,4',
            'affiliation'  => 'required_if:user_type,1,2,4',
            'officer_type' => 'required_if:user_type,1',
            'area'         => 'required_if:user_type,1',
            'position'     => 'required_if:user_type,1,2,4',
            'phone'        => 'required|string|max:15',
            'email'        => 'required|email|max:255',
            'username'     => 'required|string|max:255|unique:users',
            'password'     => 'required|string|min:8|confirmed',
            'terms'        => 'accepted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

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
