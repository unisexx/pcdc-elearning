<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hilight;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class HilightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rs = Hilight::paginate(10);

        return view('admin.hilight.index', compact('rs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hilight.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        // อัพโหลดรูป
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '.' . $request->image->extension();
            $image    = ImageManager::gd()->read($request->file('image'));
            $image    = $image->resize(1905, 620);
            $image->toJpeg(80)->save(base_path('public/storage/uploads/hilight/' . $fileName));
            $input['image'] = $fileName;
        }

        $hilight = Hilight::create($input);

        set_notify('success', 'บันทึกข้อมูลเรียบร้อย');

        return redirect()->route('admin.hilight.index');
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
        $rs = Hilight::find($id);

        return view('admin.hilight.edit', @compact('rs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();

        // อัพโหลดรูป
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '.' . $request->image->extension();
            $image    = ImageManager::gd()->read($request->file('image'));
            $image    = $image->resize(1905, 620);
            $image->toJpeg(80)->save(base_path('public/storage/uploads/hilight/' . $fileName));
            $input['image'] = $fileName;
        }

        $rs = Hilight::find($id);
        $rs->update($input);

        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        return redirect()->route('admin.hilight.index');
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
