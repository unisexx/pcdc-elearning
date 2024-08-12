<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\CurriculumUserType;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rs = Curriculum::with(['curriculum_user_type', 'curriculum_lesson.curriculum_lesson_question', 'curriculum_lesson.curriculum_lesson_detail'])
            ->paginate(10);

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

        // อัพโหลดรูป
        if ($request->hasFile('cover_image')) {
            $fileName = uniqid() . '.' . $request->cover_image->extension();
            $image    = ImageManager::gd()->read($request->file('cover_image'));
            $image    = $image->resize(1400, 476);
            $image->toJpeg(80)->save(base_path('public/storage/uploads/curriculum/' . $fileName));
            $input['cover_image'] = $fileName;
        }

        $curriculum = Curriculum::create($input);
        if (!empty($request->user_type_id)) {
            foreach ($request->user_type_id as $ut) {
                $data['curriculum_id'] = $curriculum->id;
                $data['user_type_id']  = $ut;
                CurriculumUserType::create($data);
            }
        }

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

        // อัพโหลดรูป
        if ($request->hasFile('cover_image')) {
            $fileName = uniqid() . '.' . $request->cover_image->extension();
            $image    = ImageManager::gd()->read($request->file('cover_image'));
            $image    = $image->resize(1400, 476);
            $image->toJpeg(80)->save(base_path('public/storage/uploads/curriculum/' . $fileName));
            $input['cover_image'] = $fileName;
        }

        $rs->update($input);

        CurriculumUserType::where('curriculum_id', $id)->delete();
        if (!empty($request->user_type_id)) {
            foreach ($request->user_type_id as $ut) {
                $data['curriculum_id'] = $id;
                $data['user_type_id']  = $ut;
                CurriculumUserType::create($data);
            }
        }

        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        return redirect()->route('admin.curriculum.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Curriculum::find($id)->delete();
        set_notify('success', 'ลบข้อมูลเรียบร้อย');

        return back();
    }
}
