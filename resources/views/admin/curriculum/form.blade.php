@component('components.card.form')
    @slot('cardHeaderText')
        หลักสูตร
    @endslot

    @slot('form')
        <div class="row mt-3">
            <div class="col-12">
                <label>หมวดหมู่หลักสูตร
                {!! Form::select(
                    'curriculum_category_id',
                    \App\Models\CurriculumCategory::where('status','active')->orderBy('pos','asc')->pluck('name','id'),
                    @$rs->curriculum_category_id,
                    ['class' => 'form-select select2 form-control', 'id' => 'user_type_id', 'placeholder' => '--เลือกหมวดหมู่--'],
                ) !!}  
            </div>
            <div class="col-12">
                {{ Form::bsText('name', 'ชื่อหลักสูตร') }}
            </div>
            <div class="col-12">
                {{ Form::bsTiny('intro', 'บทนำ') }}
            </div>
            <div class="col-12">
                {{ Form::bsTiny('objective', 'วัตถุประสงค์') }}
            </div>
            <div class="col-12">
                {{ Form::bsTiny('pass_criteria', 'เกณฑ์การผ่านหลักสูตร') }}
            </div>
            <div class="col-12">
                {{ Form::bsFile('cover_image', 'ภาพหน้าปก (ขนาด 1400 x 476 px)', @$rs->cover_image, 'uploads/curriculum', ['accept' => 'image/*']) }}
            </div>
            <div class="col-12">
                <label>ประเภทสมาชิกที่สามารถเข้าเรียน</label>
                <div>
                    @php
                        $user_type = \App\Models\UserType::orderBy('pos', 'asc')->get();
                    @endphp
                    @foreach ($user_type as $key => $ut)
                        @php
                            if (@$rs) {
                                $checked = $rs
                                    ->curriculum_user_type()
                                    ->where('user_type_id', $ut->id)
                                    ->count()
                                    ? true
                                    : false;
                            } else {
                                $checked = false;
                            }
                        @endphp
                        <label>
                            {!! Form::checkbox('user_type_id[]', $ut->id, @$checked, ['class' => 'form-check-input ms-2', 'style' => 'border:1px solid #CCC;']) !!}
                            {{ $ut->name }}
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="col-12">
                {{ Form::bsSwitch('status', 'เปิดใช้งาน', @$rs->status, 'active', 'inactive') }}
            </div>
        </div>

        <div class="col-auto mt-3 float-end">
            {{ link_to_route('admin.curriculum.index', 'ย้อนกลับ', $parameters = [], $attributes = ['class' => 'btn btn-lg btn-light px-4']) }}
            {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
        </div>
    @endslot
@endcomponent
