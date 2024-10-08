<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function form()
    {
        return view('frontend.login.form');
    }

    public function login(Request $request)
    {
        // ตรวจสอบความถูกต้องของข้อมูล
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // พยายามล็อกอินผู้ใช้
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            // ล็อกอินสำเร็จ
            $user = Auth::user();
            return response()->json([
                'success' => true,
                'message' => 'เข้าสู่ระบบสำเร็จ',
                'user'    => $user,
            ]);
        }

        // ล็อกอินไม่สำเร็จ
        return response()->json([
            'success' => false,
            'message' => 'ข้อมูลเข้าสู่ระบบไม่ถูกต้อง',
        ], 401);
    }

    public function login2(Request $request)
    {
        // ตรวจสอบความถูกต้องของข้อมูล
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // พยายามล็อกอินผู้ใช้
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            // ล็อกอินสำเร็จ
            $request->session()->regenerate();
            return redirect()->intended('home')->with('success', 'เข้าสู่ระบบสำเร็จ');
        }

        // ล็อกอินไม่สำเร็จ
        return redirect()->back()->with('error', 'ข้อมูลเข้าสู่ระบบไม่ถูกต้อง');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
