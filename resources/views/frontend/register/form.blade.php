@extends('layouts.frontend')

@section('page', 'สมัครสมาชิก')

@section('content')
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-8 mx-auto">
                <div class="box-contact">
                    <div class="title-register text-center mb-3">สมัครสมาชิก</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(['url' => 'register', 'method' => 'post', 'class' => 'my-4 needs-validation register-form', 'novalidate']) !!}

                    <fieldset class="mb-5 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
                        <legend class="title-form w-auto rounded-2">ประเภทผู้ใช้งาน</legend>
                        <div class="row g-3 pt-4">
                            <div class="col-md-12">
                                {!! Form::label('user_type_id', 'ประเภทผู้ใช้งาน', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::select(
                                    'user_type_id',
                                    [
                                        '1' => 'เจ้าหน้าที่ศูนย์เด็กเล็ก',
                                        '2' => 'เจ้าหน้าที่ครูโรงเรียน',
                                        '3' => 'เจ้าหน้าที่สาธารณสุข',
                                        '4' => 'บุคคลทั่วไป',
                                    ],
                                    null,
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'user_type_id', 'required' => true, 'placeholder' => 'โปรดเลือก...'],
                                ) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกประเภทผู้ใช้งาน
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mb-5 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
                        <legend class="title-form w-auto rounded-2">ข้อมูลผู้ใช้งาน</legend>
                        <div class="row g-3 pt-4">
                            <div class="col-md-12">
                                {!! Form::label('prefix', 'คำนำหน้า', ['class' => 'form-label']) !!}
                                {!! Form::text('prefix', null, ['class' => 'form-control form-control-lg', 'id' => 'prefix', 'required']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('first_name', 'ชื่อ', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('first_name', null, ['class' => 'form-control form-control-lg', 'id' => 'first_name', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุชื่อ
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('last_name', 'นามสกุล', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('last_name', null, ['class' => 'form-control form-control-lg', 'id' => 'last_name', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุนามสกุล
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('gender_id', 'เพศ', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::select(
                                    'gender_id',
                                    [
                                        '1' => 'ชาย',
                                        '2' => 'หญิง',
                                        '3' => 'ไม่ระบุ',
                                    ],
                                    null,
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'gender_id', 'required', 'placeholder' => 'โปรดเลือก...'],
                                ) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกเพศ
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('age', 'อายุ', ['class' => 'form-label']) !!}
                                {!! Form::text('age', null, ['class' => 'form-control form-control-lg mask-age', 'id' => 'age', 'maxlength' => 3]) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('officer_type_id', 'ประเภทเจ้าหน้าที่', ['class' => 'form-label']) !!}
                                {!! Form::select(
                                    'officer_type_id',
                                    [
                                        '1' => 'เจ้าหน้าที่ประจำเขต',
                                        '2' => 'เจ้าหน้าที่ประจำจังหวัด',
                                        '3' => 'เจ้าหน้าที่ประจำอำเภอ',
                                        '4' => 'เจ้าหน้าที่ประจำตำบล',
                                    ],
                                    null,
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'officer_type_id', 'placeholder' => 'โปรดเลือก...'],
                                ) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('area_id', 'พื้นที่ เจ้าหน้าที่ประจำเขต', ['class' => 'form-label']) !!}
                                {!! Form::select(
                                    'area_id',
                                    [
                                        '999' => 'ส่วนกลาง',
                                        '1' => 'สคร.1',
                                        '2' => 'สคร.2',
                                        '3' => 'สคร.3',
                                        '4' => 'สคร.4',
                                        '5' => 'สคร.5',
                                        '6' => 'สคร.6',
                                        '7' => 'สคร.7',
                                        '8' => 'สคร.8',
                                        '9' => 'สคร.9',
                                        '10' => 'สคร.10',
                                        '11' => 'สคร.11',
                                        '12' => 'สคร.12',
                                        '99' => 'สปคม.',
                                    ],
                                    null,
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'area_id', 'placeholder' => 'โปรดเลือก...'],
                                ) !!}
                            </div>
                            <div class="col-md-12">
                                {!! Form::label('center_name', 'ชื่อศูนย์เด็กเล็ก', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('center_name', null, ['class' => 'form-control form-control-lg', 'id' => 'center_name', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุชื่อศูนย์เด็กเล็ก
                                </div>
                            </div>
                            <div class="col-md-12">
                                {!! Form::label('school_name', 'ชื่อสถานศึกษา', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('school_name', null, ['class' => 'form-control form-control-lg', 'id' => 'school_name', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุชื่อสถานศึกษา
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('address_no', 'เลขที่', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('address_no', null, ['class' => 'form-control form-control-lg', 'id' => 'address_no', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุเลขที่บ้าน
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('village_no', 'หมู่', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('village_no', null, ['class' => 'form-control form-control-lg', 'id' => 'village_no', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุหมู่ที่
                                </div>
                            </div>
                            <div class="col-md-12">
                                {!! Form::label('center_phone', 'เบอร์ติดต่อศูนย์', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('center_phone', null, ['class' => 'form-control form-control-lg', 'id' => 'center_phone', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุเบอร์ติดต่อศูนย์
                                </div>
                            </div>
                            <div class="col-md-12">
                                {!! Form::label('school_phone', 'เบอร์ติดต่อโรงเรียน', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('school_phone', null, ['class' => 'form-control form-control-lg', 'id' => 'school_phone', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุเบอร์ติดต่อโรงเรียน
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('province_id', 'จังหวัด', ['class' => 'form-label']) !!} <span class="text-danger ms-1">*</span>
                                {!! Form::select('province_id', $provinces, null, ['id' => 'province_id', 'class' => 'form-select select2 form-control-lg', 'placeholder' => 'โปรดเลือก...', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกจังหวัด
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('district_id', 'เขต/อำเภอ', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::select('district_id', [], null, ['class' => 'form-select select2 form-control-lg', 'id' => 'district_id', 'required', 'placeholder' => 'โปรดเลือก...']) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกเขต/อำเภอ
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('subdistrict_id', 'แขวง/ตำบล', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::select('subdistrict_id', [], null, ['class' => 'form-select select2 form-control-lg', 'id' => 'subdistrict_id', 'required', 'placeholder' => 'โปรดเลือก...']) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกแขวง/ตำบล
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('zipcode', 'รหัสไปรษณีย์', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('zipcode', null, ['class' => 'form-control form-control-lg', 'id' => 'zipcode', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณากรอกรหัสไปรษณีย์
                                </div>
                            </div>
                            <div class="col-md-12">
                                {!! Form::label('affiliation_id', 'สังกัด', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::select(
                                    'affiliation_id',
                                    [
                                        '1' => 'สพฐ.',
                                        '2' => 'เทศบาล/ตำบล',
                                        '3' => 'อบจ.',
                                        '4' => 'กทม.',
                                        '5' => 'มหาวิทยาลัย',
                                        '6' => 'เอกชน',
                                        '7' => 'อื่นๆ',
                                    ],
                                    null,
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'affiliation_id', 'required', 'placeholder' => 'โปรดเลือก...'],
                                ) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกสังกัด
                                </div>
                            </div>
                            <div class="col-md-12">
                                {!! Form::label('affiliation_other', 'อื่นๆ ระบุ', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('affiliation_other', null, ['class' => 'form-control form-control-lg', 'id' => 'affiliation_other', 'required']) !!}
                                <div class="invalid-feedback">
                                    อื่นๆ ระบุ
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('position', 'ตำแหน่ง', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('position', null, ['class' => 'form-control form-control-lg', 'id' => 'position', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุตำแหน่งงาน
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('education_level_id', 'ระดับการศึกษา', ['class' => 'form-label']) !!}
                                {!! Form::select(
                                    'education_level_id',
                                    [
                                        '1' => 'ต่ำกว่าปริญญาตรี',
                                        '2' => 'ปริญญาตรีขึ้นไป',
                                    ],
                                    null,
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'education_level_id', 'placeholder' => 'โปรดเลือก...'],
                                ) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('phone', 'เบอร์โทรศัพท์', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('phone', null, ['class' => 'form-control form-control-lg', 'id' => 'phone', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณากรอกหมายเลขเบอร์โทรศัพท์
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('email', 'อีเมล', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::email('email', null, ['class' => 'form-control form-control-lg', 'id' => 'email', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณากรอกอีเมล
                                </div>
                            </div>
                        </div>
                    </fieldset>


                    <fieldset class="mb-4 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
                        <legend class="title-form w-auto rounded-2">ข้อมูลการเข้าใช้งาน</legend>
                        <div class="row g-3 pt-4">
                            <div class="col-md-4">
                                {!! Form::label('username', 'ชื่อผู้ใช้งาน (Username)', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('username', null, ['class' => 'form-control form-control-lg', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    โปรดระบุชื่อผู้ใช้งาน Username
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
                                {!! Form::label('confirm_password', 'ยืนยันรหัสผ่าน', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::password('confirm_password', ['class' => 'form-control form-control-lg', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    โปรดยืนยันรหัสผ่าน
                                </div>
                            </div>
                        </div>
                    </fieldset>


                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="terms" required>
                            <label class="form-check-label" for="terms">
                                ฉันยอมรับข้อกำหนดและเงื่อนไข
                            </label>
                            <div class="invalid-feedback">
                                คุณยังไม่ได้ติ๊กเลือกยอมรับข้อกำหนดและเงื่อนไข
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 text-center">
                        <button class="btn btn-primary btn-lg px-5" type="submit">สมัครสมาชิก</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .select2-container .select2-selection--single {
            height: calc(1.5em + 1rem + 2px) !important;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.5rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.5 !important;
            /* Adjust this value if needed */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(1.5em + 1rem + 2px) !important;
        }
    </style>

    <style>
        fieldset {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1),
                0 4px 6px rgba(0, 0, 0, 0.08);
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Disable all input fields initially
            $('.form-control, .form-select').not('#user_type_id').prop('disabled', true);

            // Enable fields when user_type_id is selected
            $('#user_type_id').change(function() {
                if ($(this).val() !== '') {
                    $('.form-control, .form-select').not('#user_type_id').prop('disabled', false);
                } else {
                    $('.form-control, .form-select').not('#user_type_id').prop('disabled', true);
                }
            });
        });
    </script>

    {{-- ซ่อน / แสดงฟอร์ม --}}
    <script>
        $(document).ready(function() {
            // ซ่อน/แสดงฟอร์มเมื่อเลือกประเภทผู้ใช้
            $('#user_type_id').change(function() {
                // แสดงฟิลด์ทั้งหมดก่อน
                var allFields = $('#center_name, #center_phone, #school_name, #school_phone, #address_no, #village_no, #province_id, #district_id, #subdistrict_id, #zipcode, #affiliation_id, #officer_type_id, #area_id, #position, #education_level_id, #affiliation_other').parent();

                allFields.removeClass('animate__animated animate__bounceIn').hide().addClass('animate__animated animate__bounceIn').show();

                // ซ่อนฟิลด์ที่ไม่ต้องการ
                if ($(this).val() == '1') { // เจ้าหน้าที่ศูนย์เด็กเล็ก
                    $('#school_name, #school_phone, #officer_type_id, #area_id, #position, #education_level_id, #affiliation_other').parent().hide();
                } else if ($(this).val() == '2') { // เจ้าหน้าที่ครูโรงเรียน
                    $('#center_name, #center_phone, #officer_type_id, #area_id, #position, #education_level_id, #affiliation_other').parent().hide();
                } else if ($(this).val() == '3') { // เจ้าหน้าที่สาธารณสุข
                    $('#center_name, #center_phone, #school_name, #school_phone, #address_no, #village_no, #province_id, #district_id, #subdistrict_id, #zipcode, #affiliation_id, #area_id, #affiliation_other').parent().hide();
                } else if ($(this).val() == '4') { // บุคคลทั่วไป
                    $('#center_name, #center_phone, #school_name, #school_phone, #address_no, #village_no, #affiliation_id, #officer_type_id, #area_id, #position, #education_level_id, #affiliation_other').parent().hide();
                }


                $('#officer_type_id').change(function() {
                    // เงื่อนไขเพิ่มเติม
                    var officerType = $('#officer_type_id').val();

                    if (officerType == '1') {
                        $('#area_id').parent().show();
                        $('#province_id, #district_id, #subdistrict_id, #zipcode').parent().hide();
                    } else if (officerType == '2') {
                        $('#province_id').parent().show();
                        $('#area_id, #district_id, #subdistrict_id, #zipcode').parent().hide();
                    } else if (officerType == '3') {
                        $('#province_id, #district_id').parent().show();
                        $('#area_id, #subdistrict_id, #zipcode').parent().hide();
                    } else if (officerType == '4') {
                        $('#province_id, #district_id, #subdistrict_id, #zipcode').parent().show();
                        $('#area_id').parent().hide();
                    }
                });

                $('#affiliation_id').change(function() {
                    // เงื่อนไขเพิ่มเติม
                    var affiliationId = $('#affiliation_id').val();

                    if (affiliationId == '7') {
                        $('#affiliation_other').parent().show();
                    } else {
                        $('#affiliation_other').parent().hide();
                    }
                });
            });
        });
    </script>

    {{-- Select 2 --}}
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                placeholder: 'โปรดเลือก...'
            });
        });
    </script>

    {{-- Chain Select จังหวัด / อำเภอ / ตำบล --}}
    <script>
        $(document).ready(function() {
            $('#province_id').change(function() {
                var provinceId = $(this).val();
                $('#district_id').empty().append('<option value="">โปรดเลือก...</option>');
                $('#subdistrict_id').empty().append('<option value="">โปรดเลือก...</option>');
                $('#zipcode').val('');

                if (provinceId) {
                    $.ajax({
                        url: '/get-districts/' + provinceId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(id, name) {
                                $('#district_id').append('<option value="' + id + '">' + name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#district_id').change(function() {
                var districtId = $(this).val();
                $('#subdistrict_id').empty().append('<option value="">โปรดเลือก...</option>');
                $('#zipcode').val('');

                if (districtId) {
                    $.ajax({
                        url: '/get-subdistricts/' + districtId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(id, name) {
                                $('#subdistrict_id').append('<option value="' + id + '">' + name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#subdistrict_id').change(function() {
                var province_name = $('#province_id').find('option:selected').text();
                var district_name = $('#district_id').find('option:selected').text();
                var subdistrict_name = $('#subdistrict_id').find('option:selected').text();

                if (province_name && district_name && subdistrict_name) {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('ajaxGetZipCode') }}",
                        data: {
                            district: subdistrict_name,
                            amphoe: district_name,
                            province: province_name,
                        },
                        success: function(data) {
                            $('#zipcode').val(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Error occurred while fetching data. Please try again later.');
                        }
                    });
                }
            });
        });
    </script>

    {{-- JS Validation --}}
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\RegisterUserRequest', '.register-form') !!}
@endpush
