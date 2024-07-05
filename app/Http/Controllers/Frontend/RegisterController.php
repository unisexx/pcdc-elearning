<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Province;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use JsValidator;

class RegisterController extends Controller
{
    public function form()
    {
        $userTypes = UserType::where('status', '1')->orderBy('id', 'asc')->pluck('name', 'id');

        return view('frontend.register.form', compact('userTypes'));
    }

    public function register(RegisterUserRequest $request)
    {
        $input             = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        // ล็อกอินผู้ใช้ทันทีหลังจากที่ลงทะเบียนสำเร็จ
        Auth::login($user);

        return redirect()->route('home')->with('success', 'ลงทะเบียนสำเร็จ');
    }

    public function getFieldset($userTypeId)
    {
        $user      = Auth::user(); // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่
        $provinces = Province::orderBy('id', 'asc')->pluck('name', 'id');

        $html = '';

        switch ($userTypeId) {
            case 1:
                $html = view('frontend.register.fieldsets.preschool', compact('provinces', 'user'))->render();
                break;
            case 2:
                $html = view('frontend.register.fieldsets.primary', compact('provinces', 'user'))->render();
                break;
            case 3:
                $html = view('frontend.register.fieldsets.secondary', compact('provinces', 'user'))->render();
                break;
            case 4:
                $html = view('frontend.register.fieldsets.others', compact('provinces', 'user'))->render();
                break;
            default:
                $html = '<p>ไม่พบข้อมูลที่ต้องการ</p>';
                break;
        }

        return response()->json($html);
    }

}
