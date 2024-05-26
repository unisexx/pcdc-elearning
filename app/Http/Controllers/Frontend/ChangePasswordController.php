<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function edit($id)
    {
        // ตรวจสอบว่า id ที่ส่งเข้ามาตรงกับ id ของผู้ใช้ที่ล็อกอินหรือไม่
        if (Auth::user()->id !== (int) $id) {
            return redirect('/home')->with('error', 'คุณไม่มีสิทธิ์ในการแก้ไขโปรไฟล์นี้');
        }

        $rs = User::findOrFail($id);

        return view('frontend.change-password.form', compact('rs'));
    }

    public function update(Request $request, $id)
    {
        // ตรวจสอบว่า id ที่ส่งเข้ามาตรงกับ id ของผู้ใช้ที่ล็อกอินหรือไม่
        if (Auth::user()->id !== (int) $id) {
            return redirect('/home')->with('error', 'คุณไม่มีสิทธิ์ในการแก้ไขโปรไฟล์นี้');
        }

        $user = User::findOrFail($id);

        // กำหนดกฎการตรวจสอบ
        $rules = [
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ];

        // กำหนดข้อความแสดงข้อผิดพลาด
        $messages = [
            'email.required'     => 'กรุณากรอกอีเมล',
            'email.email'        => 'รูปแบบอีเมลไม่ถูกต้อง',
            'email.unique'       => 'อีเมลนี้มีการใช้งานแล้ว',
            'password.min'       => 'รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร',
            'password.confirmed' => 'การยืนยันรหัสผ่านไม่ตรงกัน',
        ];

        // ตรวจสอบข้อมูล
        $validatedData = $request->validate($rules, $messages);

        // อัปเดตข้อมูลผู้ใช้
        $user->email = $validatedData['email'];
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();

        return redirect()->route('change_password.edit', $id)->with('success', 'แก้ไขข้อมูลสำเร็จ');
    }
}
