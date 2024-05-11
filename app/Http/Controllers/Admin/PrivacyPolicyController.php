<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function edit(string $id)
    {
        $rs = PrivacyPolicy::find($id);

        return view('admin.privacy-policy.edit', @compact('rs'));
    }

    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $rs    = PrivacyPolicy::find($id);
        $rs->update($input);

        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        return back();
    }
}
