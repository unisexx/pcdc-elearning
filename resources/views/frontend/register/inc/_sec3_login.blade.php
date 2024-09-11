<fieldset id="loginSection" class="mb-4 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
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
        <div class="col-md-4 position-relative">
            {!! Form::label('password', 'รหัสผ่าน', ['class' => 'form-label']) !!}
            <span class="text-danger ms-1">*</span>
            <div class="input-group">
                {!! Form::password('password', ['class' => 'form-control form-control-lg', 'id' => 'password', 'required']) !!}
                <span class="input-group-text">
                    <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                </span>
            </div>
            <div class="errMsg"></div>
            <div class="invalid-feedback">
                โปรดกรอกรหัสผ่าน
            </div>
        </div>
        <div class="col-md-4 position-relative">
            {!! Form::label('password_confirmation', 'ยืนยันรหัสผ่าน', ['class' => 'form-label']) !!}
            <span class="text-danger ms-1">*</span>
            <div class="input-group">
                {!! Form::password('password_confirmation', ['class' => 'form-control form-control-lg', 'id' => 'password_confirmation', 'required']) !!}
                <span class="input-group-text">
                    <i class="bi bi-eye-slash" id="togglePasswordConfirm" style="cursor: pointer;"></i>
                </span>
            </div>
            <div class="errMsg"></div>
            <div class="invalid-feedback">
                โปรดยืนยันรหัสผ่าน
            </div>
        </div>
    </div>
</fieldset>

@push('js')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function(e) {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the icon
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });

        document.getElementById('togglePasswordConfirm').addEventListener('click', function(e) {
            const passwordConfirmInput = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');

            // Toggle the type attribute
            const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmInput.setAttribute('type', type);

            // Toggle the icon
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    </script>
@endpush
