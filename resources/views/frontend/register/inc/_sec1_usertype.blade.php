<fieldset class="mb-5 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
    <legend class="title-form w-auto rounded-2">ประเภทผู้ใช้งาน</legend>
    <div class="row g-3 pt-4">
        <div class="col-md-12">
            {!! Form::label('user_type_id', 'ประเภทผู้ใช้งาน', ['class' => 'form-label']) !!}
            <span class="text-danger ms-1">*</span>
            {!! Form::select('user_type_id', $userTypes, null, ['class' => 'form-select select2 form-control-lg', 'id' => 'user_type_id', 'required' => true, 'placeholder' => 'โปรดเลือก...']) !!}
            <div class="invalid-feedback">
                กรุณาเลือกประเภทผู้ใช้งาน
            </div>
        </div>
    </div>
</fieldset>
