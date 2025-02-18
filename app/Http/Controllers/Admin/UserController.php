<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UserRequest;
use App\Models\Curriculum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // รับค่าการค้นหา
        $search = $request->input('search');

        // Query ข้อมูลผู้ใช้งาน
        $users = User::query();

        // ตรวจสอบว่ามีการค้นหาหรือไม่
        if (!empty($search)) {
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // เรียงลำดับและแบ่งหน้า
        $users = $users->orderBy('is_admin', 'desc')->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $input             = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user              = User::create($input);
        // $user->assignRole($request->input('roles'));

        set_notify('success', 'บันทึกข้อมูลเรียบร้อย');

        return redirect()->route('admin.user.index');
    }

    public function show($id)
    {
        $rs = User::findOrFail($id);
        // $userRole = $rs->roles->pluck('id')->all();

        return view('admin.user.show', @compact('rs', 'userRole'));
    }

    public function edit($id)
    {
        $rs = User::find($id);
        // $userRole = $rs->roles->pluck('id')->all();

        return view('admin.user.edit', @compact('rs', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        // รหัสผ่าน ถ้ามีให้สร้าง ถ้าไม่มีแก้รหัสให้ข้าม
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user = User::find($id);
        $user->update($input);
        // $user->assignRole($request->input('role'));

        // if (!empty($input['deleteRole'])) {
        //     foreach ($input['deleteRole'] as $item) {
        //         DB::table('model_has_roles')->where('model_id', $id)->where('role_id', $item)->delete();
        //     }
        // }
        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        return redirect()->route('admin.user.index');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        set_notify('success', 'ลบข้อมูลเรียบร้อย');

        return redirect()->route('admin.user.index');
    }
}
