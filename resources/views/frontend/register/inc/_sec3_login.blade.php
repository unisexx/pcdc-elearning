<fieldset class="mb-4 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
    <legend class="title-form w-auto rounded-2">ข้อมูลการเข้าใช้งาน</legend>
    <div class="row g-3 pt-4">
        <div class="col-md-4">
            {!! Form::label('email', 'อีเมล (สำหรับเข้าสู่ระบบ)', ['class' => 'form-label']) !!}
            <span class="text-danger ms-1">*</span>
            {!! Form::email('email', null, ['class' => 'form-control form-control-lg', 'id' => 'email', 'required']) !!}
            <div class="invalid-feedback">
                กรุณากรอกอีเมล
            </div>
        </div>
        <div class="col-md-4">
            {!! Form::label('password', 'รหัสผ่าน', ['class' => 'form-label']) !!}
            <span class="text-danger ms-1">*</span>
            {!! Form::password('password', ['class' => 'form-control form-control-lg', 'required' => 'required']) !!}
            <div class="invalid-feedback">
                โปรดกรอกรหัสผ่าน
            </div>
        </div>
        <div class="col-md-4">
            {!! Form::label('password_confirmation', 'ยืนยันรหัสผ่าน', ['class' => 'form-label']) !!}
            <span class="text-danger ms-1">*</span>
            {!! Form::password('password_confirmation', ['class' => 'form-control form-control-lg', 'required' => 'required']) !!}
            <div class="invalid-feedback">
                โปรดยืนยันรหัสผ่าน
            </div>
        </div>
    </div>
</fieldset>
