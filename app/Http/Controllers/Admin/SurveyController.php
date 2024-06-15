<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{

    public function index()
    {
        $rs = Survey::orderBy('order', 'asc')->get();

        return view('admin.survey.index', compact('rs'));
    }

    public function create()
    {
        return view('admin.survey.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $Survey = Survey::create($input);

        set_notify('success', 'บันทึกข้อมูลเรียบร้อย');

        return redirect()->route('admin.survey.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $rs = Survey::find($id);

        return view('admin.survey.edit', @compact('rs'));
    }

    public function update(Request $request, string $id)
    {
        $input = $request->all();

        $rs = Survey::find($id);
        $rs->update($input);

        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        return redirect()->route('admin.survey.index');
    }

    public function destroy(string $id)
    {
        Survey::find($id)->delete();
        set_notify('success', 'ลบข้อมูลเรียบร้อย');

        return back();
    }

    public function updateOrder(Request $request)
    {
        $order = $request->input('order');
        foreach ($order as $index => $id) {
            $faq        = Survey::find($id);
            $faq->order = $index + 1;
            $faq->save();
        }
        return response()->json(['status' => 'success']);
    }
}
