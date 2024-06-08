<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rs = Curriculum::paginate(10);

        return view('admin.curriculum.index', compact('rs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.curriculum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $curriculum = Curriculum::create($input);

        set_notify('success', 'บันทึกข้อมูลเรียบร้อย');

        return redirect()->route('admin.curriculum.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rs = Curriculum::find($id);

        return view('admin.curriculum.edit', @compact('rs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();

        $rs = Curriculum::find($id);
        $rs->update($input);

        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        return redirect()->route('admin.curriculum.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Hilight::find($id)->delete();
        set_notify('success', 'ลบข้อมูลเรียบร้อย');

        return back();
    }
}
