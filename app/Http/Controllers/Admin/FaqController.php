<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $rs = Faq::orderBy('order', 'asc')->get();

        return view('admin.faq.index', compact('rs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $faq = Faq::create($input);

        set_notify('success', 'บันทึกข้อมูลเรียบร้อย');

        return redirect()->route('admin.faq.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $rs = Faq::find($id);

        return view('admin.faq.edit', @compact('rs'));
    }

    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $rs    = Faq::find($id);
        $rs->update($input);

        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        return redirect()->route('admin.faq.index');
    }

    public function destroy(string $id)
    {
        Faq::find($id)->delete();
        set_notify('success', 'ลบข้อมูลเรียบร้อย');

        return back();
    }

    public function updateOrder(Request $request)
    {
        $order = $request->input('order');
        foreach ($order as $index => $id) {
            $faq        = Faq::find($id);
            $faq->order = $index + 1;
            $faq->save();
        }
        return response()->json(['status' => 'success']);
    }
}
