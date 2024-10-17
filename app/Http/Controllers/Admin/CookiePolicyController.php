<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CookiePolicy;
use Illuminate\Http\Request;

class CookiePolicyController extends Controller
{
    public function edit(string $id)
    {
        $rs = CookiePolicy::find($id);

        return view('admin.cookie-policy.edit', @compact('rs'));
    }

    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $rs    = CookiePolicy::find($id);
        $rs->update($input);

        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        return back();
    }
}
