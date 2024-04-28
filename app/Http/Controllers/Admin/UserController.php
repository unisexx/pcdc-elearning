<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UserRequest;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request)
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

    public function update(UserRequest $request, $id)
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
