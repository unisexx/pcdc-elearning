<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsitePolicy;
use Illuminate\Http\Request;

class WebsitePolicyController extends Controller
{
    public function edit(string $id)
    {
        $rs = WebsitePolicy::find($id);

        return view('admin.website-policy.edit', @compact('rs'));
    }

    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $rs    = WebsitePolicy::find($id);
        $rs->update($input);

        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        return back();
    }
}
