<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /**
     * แสดงฟอร์มสำหรับการขอรีเซ็ตรหัสผ่าน
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('frontend.forgot-password.form');
    }

    /**
     * ส่งลิงก์รีเซ็ตรหัสผ่านไปยังอีเมลที่ระบุ
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendResetLinkEmail(Request $request)
    {
        // ตรวจสอบข้อมูลที่กรอกเข้ามา
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // ส่งลิงก์รีเซ็ตรหัสผ่านไปยังอีเมล
        $response = Password::sendResetLink(
            $request->only('email')
        );

        // ตรวจสอบสถานะการส่งลิงก์
        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('success', 'เราได้ส่งลิงก์รีเซ็ตรหัสผ่านของคุณไปทางอีเมลแล้ว!');
        }

        return back()->with('error', 'ไม่พบอีเมล์นี้ในระบบ');
    }
}
