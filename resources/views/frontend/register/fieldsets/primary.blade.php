<fieldset id="groupForm_2" class="mb-5 mt-4 border rounded-3 p-3 p-lg-5 position-relative form-section">
    <legend class="title-form w-auto rounded-2">ครูผู้ดูแลเด็กระดับประถมศึกษาปีที่ 1-6</legend>
    <div>
        <div class="mb-3">
            {!! Form::label('name', 'ชื่อ-นามสกุล', ['class' => 'form-label']) !!}
            <span class="text-danger ms-1"><small class="text-muted">(ข้อมูลส่วนนี้จะนำไปใช้ในการออกใบประกาศ)</small> *</span>
            {!! Form::text('name', $user ? $user->name : null, ['class' => 'form-control form-control-lg', 'id' => 'first_name', 'required']) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('school_name', 'ชื่อโรงเรียน', ['class' => 'form-label']) !!}
            <span class="text-danger ms-1"> *</span>
            {!! Form::text('school_name', $user ? $user->school_name : null, ['class' => 'form-control form-control-lg', 'id' => 'first_name', 'required']) !!}
        </div>
        <div class="row">
            <div class="col-md-4">
                {!! Form::label('province_id', 'จังหวัด', ['class' => 'form-label']) !!} <span class="text-danger ms-1">*</span>
                {!! Form::select('province_id', $provinces, $user ? $user->province_id : null, ['id' => 'province_id', 'class' => 'form-select select2 form-control-lg', 'placeholder' => 'โปรดเลือก...', 'required']) !!}
                <div class="invalid-feedback">
                    กรุณาเลือกจังหวัด
                </div>
            </div>
            <div class="col-md-4">
                {!! Form::label('district_id', 'เขต/อำเภอ', ['class' => 'form-label']) !!}
                <span class="text-danger ms-1">*</span>
                {!! Form::select('district_id', [], null, ['class' => 'form-select select2 form-control-lg', 'id' => 'district_id', 'required', 'placeholder' => 'โปรดเลือก...']) !!}
                <div class="invalid-feedback">
                    กรุณาเลือกเขต/อำเภอ
                </div>
            </div>
            <div class="col-md-4">
                {!! Form::label('subdistrict_id', 'แขวง/ตำบล', ['class' => 'form-label']) !!}
                <span class="text-danger ms-1">*</span>
                {!! Form::select('subdistrict_id', [], null, ['class' => 'form-select select2 form-control-lg', 'id' => 'subdistrict_id', 'required', 'placeholder' => 'โปรดเลือก...']) !!}
                <div class="invalid-feedback">
                    กรุณาเลือกแขวง/ตำบล
                </div>
            </div>
        </div>
    </div>
</fieldset>

@include('frontend.register.fieldsets._script')
