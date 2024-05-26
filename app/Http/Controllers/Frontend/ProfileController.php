<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit($id)
    {
        // ตรวจสอบว่า id ที่ส่งเข้ามาตรงกับ id ของผู้ใช้ที่ล็อกอินหรือไม่
        if (Auth::user()->id !== (int) $id) {
            return redirect('/home')->with('error', 'คุณไม่มีสิทธิ์ในการแก้ไขโปรไฟล์นี้');
        }

        $provinces = Province::orderBy('id', 'asc')->pluck('name', 'id');
        $rs        = User::findOrFail($id);

        return view('frontend.profile.form', compact('rs', 'provinces'));
    }

    public function update(RegisterUserRequest $request, $id)
    {
        // ตรวจสอบว่า id ที่ส่งเข้ามาตรงกับ id ของผู้ใช้ที่ล็อกอินหรือไม่
        if (Auth::user()->id !== (int) $id) {
            return redirect('/home')->with('error', 'คุณไม่มีสิทธิ์ในการแก้ไขโปรไฟล์นี้');
        }

        $user = User::findOrFail($id);
        $data = $request->all();

        // ถ้าไม่ได้กรอกรหัสผ่านใหม่ ไม่ต้องอัพเดตรหัสผ่าน
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('profile.edit', $id)->with('success', 'แก้ไขข้อมูลสำเร็จ');
    }
}
