<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\CurriculumLesson;
use App\Models\CurriculumLessonDetail;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class CurriculumLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCurriculum($req){
        if(empty($req->curriculum_id)){
            return redirect(url('admin/curriculum'));
        }
        $curriculum = Curriculum::find($req->curriculum_id);
        if(empty($curriculum)){
            return redirect(url('admin/curriculum'));
        }
        return $curriculum;
    }
    public function index(Request $req){

        $curriculum = $this->getCurriculum($req);
        $rs = CurriculumLesson::where('curriculum_id',$req->curriculum_id)->paginate(10);

        return view('admin.curriculum-lesson.index', compact('rs','curriculum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req)
    {
        $curriculum = $this->getCurriculum($req);
        return view('admin.curriculum-lesson.create', compact('curriculum'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'pos' => (CurriculumLesson::where('curriculum_id',$request->curriculum_id)->max('pos') + 1)
        ]);
        $input = $request->all();

        // อัพโหลดรูป
        if ($request->hasFile('cover_image')) {
            $fileName = uniqid() . '.' . $request->cover_image->extension();
            $image    = ImageManager::gd()->read($request->file('cover_image'));
            $image    = $image->resize(740, 370);
            $image->toJpeg(80)->save(base_path('public/storage/uploads/curriculum_lesson/' . $fileName));
            $input['cover_image'] = $fileName;
        }
        
        $curriculum_lesson = CurriculumLesson::create($input);

        if(!empty($request->page_detail)){
            foreach($request->page_detail as $key=>$detail){
                $data['curriculum_lesson_id'] = $curriculum_lesson->id;
                $data['detail'] = $detail;
                $data['status'] = 'active';
                $data['pos'] = (CurriculumLessonDetail::where('curriculum_lesson_id',$curriculum_lesson->id)->max('pos') + 1);
                $curriculum_lession_detail = CurriculumLessonDetail::create($data);
            }

        }

        set_notify('success', 'บันทึกข้อมูลเรียบร้อย');

        return redirect(url('admin/curriculum-lesson?curriculum_id='.$curriculum_lesson->curriculum_id));
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
        $rs = CurriculumLesson::find($id);
        $curriculum = $rs->curriculum()->first();        
        return view('admin.curriculum-lesson.edit', @compact('rs', 'curriculum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();

        $rs = CurriculumLesson::find($id);

        // อัพโหลดรูป
        if ($request->hasFile('cover_image')) {
            $fileName = uniqid() . '.' . $request->cover_image->extension();
            $image    = ImageManager::gd()->read($request->file('cover_image'));
            $image    = $image->resize(740, 370);
            $image->toJpeg(80)->save(base_path('public/storage/uploads/curriculum_lesson/' . $fileName));
            $input['cover_image'] = $fileName;
        }

        $rs->update($input);

        CurriculumLessonDetail::where('curriculum_lesson_id',$id)->delete();

        if(!empty($request->page_detail)){
            foreach($request->page_detail as $key=>$detail){
                $data['curriculum_lesson_id'] = $id;
                $data['detail'] = $detail;
                $data['status'] = 'active';
                $data['pos'] = (CurriculumLessonDetail::where('curriculum_lesson_id',$id)->max('pos') + 1);
                $curriculum_lession_detail = CurriculumLessonDetail::create($data);
            }

        }

        set_notify('success', 'แก้ไขข้อมูลเรียบร้อย');

        return redirect()->route('admin.curriculum-lesson.index',['curriculum_id'=>$rs->curriculum_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CurriculumLesson::find($id)->delete();
        set_notify('success', 'ลบข้อมูลเรียบร้อย');

        return back();
    }
}
