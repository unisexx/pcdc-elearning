@extends('layouts.frontend')

@section('page', 'สมัครสมาชิก')

@section('content')
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-12">
                <div class="box-contact">
                    <div class="title-register text-center mb-3">สมัครสมาชิก</div>

                    {!! Form::open(['url' => 'your-route-here', 'method' => 'post', 'class' => 'my-4 needs-validation register-form', 'novalidate']) !!}

                    <fieldset class="mb-5 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
                        <legend class="title-form w-auto rounded-2"><img src="images/user-group.svg" alt="" width="24">ข้อมูลผู้ใช้งาน</legend>
                        <div class="row g-3 pt-4">
                            <div class="col-md-4 col-lg-2">
                                {!! Form::label('user_type', 'ประเภทผู้ใช้งาน', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::select(
                                    'user_type',
                                    [
                                        '1' => 'เจ้าหน้าที่ศูนย์เด็กเล็ก',
                                        '2' => 'เจ้าหน้าที่ครูโรงเรียน',
                                        '3' => 'เจ้าหน้าที่สาธารณสุข',
                                        '4' => 'บุคคลทั่วไป',
                                    ],
                                    null,
                                    ['class' => 'form-select', 'id' => 'user_type', 'required' => true, 'placeholder' => 'โปรดเลือก...'],
                                ) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกประเภทผู้ใช้งาน
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-2">
                                {!! Form::label('prefix', 'คำนำหน้า', ['class' => 'form-label']) !!}
                                {!! Form::select(
                                    'prefix',
                                    [
                                        '' => 'โปรดเลือก...',
                                        'นาย' => 'นาย',
                                        'นาง' => 'นาง',
                                        'นางสาว' => 'นางสาว',
                                    ],
                                    null,
                                    ['class' => 'form-select', 'id' => 'prefix'],
                                ) !!}
                            </div>

                            <div class="col-md-6 col-lg-4">
                                {!! Form::label('first_name', 'ชื่อ', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('first_name', null, ['class' => 'form-control', 'id' => 'first_name', 'required']) !!}
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    กรุณาระบุชื่อ
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                {!! Form::label('last_name', 'นามสกุล', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last_name', 'required']) !!}
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    กรุณาระบุนามสกุล
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-md-2">
                                {!! Form::label('gender', 'เพศ', ['class' => 'form-label']) !!}
                                {!! Form::select(
                                    'gender',
                                    [
                                        '' => 'โปรดเลือก...',
                                        'ชาย' => 'ชาย',
                                        'หญิง' => 'หญิง',
                                    ],
                                    null,
                                    ['class' => 'form-select', 'id' => 'gender', 'required'],
                                ) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกเพศ
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mb-3">
                                    {!! Form::label('age', 'อายุ', ['class' => 'form-label']) !!}
                                    <div class="input-group">
                                        {!! Form::text('age', null, ['class' => 'form-control', 'id' => 'age', 'maxlength' => 5]) !!}
                                        <span class="input-group-text">ปี</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-3">
                                {!! Form::label('officer_type', 'ประเภทเจ้าหน้าที่', ['class' => 'form-label']) !!}
                                {!! Form::select(
                                    'officer_type',
                                    [
                                        '' => 'โปรดเลือก...',
                                        'เจ้าหน้าที่ประจำเขต' => 'เจ้าหน้าที่ประจำเขต',
                                        'เจ้าหน้าที่ประจำจังหวัด' => 'เจ้าหน้าที่ประจำจังหวัด',
                                        'เจ้าหน้าที่ประจำอำเภอ' => 'เจ้าหน้าที่ประจำอำเภอ',
                                        'เจ้าหน้าที่ประจำตำบล' => 'เจ้าหน้าที่ประจำตำบล',
                                    ],
                                    null,
                                    ['class' => 'form-select', 'id' => 'officer_type'],
                                ) !!}
                            </div>

                            <div class="col-md-4 col-lg-3">
                                {!! Form::label('area', 'พื้นที่ เจ้าหน้าที่ประจำเขต', ['class' => 'form-label']) !!}
                                {!! Form::select(
                                    'area',
                                    [
                                        '' => 'โปรดเลือก...',
                                        'ส่วนกลาง' => 'ส่วนกลาง',
                                        'สคร.1' => 'สคร.1',
                                        'สคร.2' => 'สคร.2',
                                        'สคร.3' => 'สคร.3',
                                        'สคร.4' => 'สคร.4',
                                        'สคร.5' => 'สคร.5',
                                        'สคร.6' => 'สคร.6',
                                        'สคร.7' => 'สคร.7',
                                        'สคร.8' => 'สคร.8',
                                        'สคร.9' => 'สคร.9',
                                        'สคร.10' => 'สคร.10',
                                        'สคร.11' => 'สคร.11',
                                        'สคร.12' => 'สคร.12',
                                        'สปคม.' => 'สปคม.',
                                    ],
                                    null,
                                    ['class' => 'form-select', 'id' => 'area'],
                                ) !!}
                            </div>

                            <div class="col-md-6">
                                {!! Form::label('center_name', 'ชื่อศูนย์เด็กเล็ก', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('center_name', null, ['class' => 'form-control', 'id' => 'center_name', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุชื่อศูนย์เด็กเล็ก
                                </div>
                            </div>

                            <div class="col-md-6">
                                {!! Form::label('school_name', 'ชื่อสถานศึกษา', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('school_name', null, ['class' => 'form-control', 'id' => 'school_name', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุชื่อสถานศึกษา
                                </div>
                            </div>

                            <div class="col-md-2">
                                {!! Form::label('address_no', 'เลขที่', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('address_no', null, ['class' => 'form-control', 'id' => 'address_no', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณากรอก เลขที่บ้าน
                                </div>
                            </div>

                            <div class="col-md-2">
                                {!! Form::label('village_no', 'หมู่', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('village_no', null, ['class' => 'form-control', 'id' => 'village_no', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุ หมู่ที่
                                </div>
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('center_phone', 'เบอร์ติดต่อศูนย์', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('center_phone', null, ['class' => 'form-control', 'id' => 'center_phone', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณากรอก เบอร์ติดต่อศูนย์
                                </div>
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('school_phone', 'เบอร์ติดต่อโรงเรียน', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('school_phone', null, ['class' => 'form-control', 'id' => 'school_phone', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณากรอก เบอร์ติดต่อโรงเรียน
                                </div>
                            </div>

                            <div class="col-md-3">
                                {!! Form::label('province', 'จังหวัด', ['class' => 'form-label']) !!} <span class="text-danger ms-1">*</span>
                                {!! Form::select('province', $provinces, null, ['class' => 'form-select', 'placeholder' => 'โปรดเลือก...', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกจังหวัด
                                </div>
                            </div>
                            <div class="col-md-3">
                                {!! Form::label('district', 'เขต/อำเภอ', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::select(
                                    'district',
                                    [
                                        '' => 'โปรดเลือก...',
                                        'พญาไท' => 'พญาไท',
                                    ],
                                    null,
                                    ['class' => 'form-select', 'id' => 'district', 'required'],
                                ) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกเขต/อำเภอ
                                </div>
                            </div>

                            <div class="col-md-3">
                                {!! Form::label('subdistrict', 'แขวง/ตำบล', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::select(
                                    'subdistrict',
                                    [
                                        '' => 'โปรดเลือก...',
                                        'พญาไท' => 'พญาไท',
                                    ],
                                    null,
                                    ['class' => 'form-select', 'id' => 'subdistrict', 'required'],
                                ) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกแขวง/ตำบล
                                </div>
                            </div>

                            <div class="col-md-3">
                                {!! Form::label('zipcode', 'รหัสไปรษณีย์', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('zipcode', null, ['class' => 'form-control', 'id' => 'zipcode', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณากรอกรหัสไปรษณีย์
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-3">
                                {!! Form::label('affiliation', 'สังกัด', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::select(
                                    'affiliation',
                                    [
                                        '' => 'โปรดเลือก...',
                                        'สพฐ.' => 'สพฐ.',
                                        'เทศบาล/ตำบล' => 'เทศบาล/ตำบล',
                                        'อบจ.' => 'อบจ.',
                                        'กทม.' => 'กทม.',
                                        'มหาวิทยาลัย' => 'มหาวิทยาลัย',
                                        'เอกชน' => 'เอกชน',
                                        'อื่นๆ' => 'อื่นๆ',
                                    ],
                                    null,
                                    ['class' => 'form-select', 'id' => 'affiliation', 'required'],
                                ) !!}
                                <div class="invalid-feedback">
                                    กรุณาเลือกสังกัด
                                </div>
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('position', 'ตำแหน่ง', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('position', null, ['class' => 'form-control', 'id' => 'position', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณาระบุตำแหน่งงาน
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-3">
                                {!! Form::label('education_level', 'ระดับการศึกษา', ['class' => 'form-label']) !!}
                                {!! Form::select(
                                    'education_level',
                                    [
                                        '' => 'โปรดเลือก...',
                                        'ต่ำกว่าปริญญาตรี' => 'ต่ำกว่าปริญญาตรี',
                                        'ปริญญาตรีขึ้นไป' => 'ปริญญาตรีขึ้นไป',
                                    ],
                                    null,
                                    ['class' => 'form-select', 'id' => 'education_level'],
                                ) !!}
                            </div>

                            <div class="col-md-4 col-lg-3">
                                {!! Form::label('phone', 'เบอร์โทรศัพท์', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณากรอกหมายเลขเบอร์โทรศัพท์
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-3">
                                {!! Form::label('email', 'อีเมล', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณากรอกอีเมล
                                </div>
                            </div>

                        </div><!--.row -->
                    </fieldset>

                    <fieldset class="mb-4 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
                        <legend class="title-form w-auto rounded-2"><img src="images/user-group.svg" alt="" width="24">ข้อมูลการเข้าใช้งาน</legend>
                        <div class="row g-3 pt-4">
                            <div class="col-md-4">
                                <label for="username" class="form-label">ชื่อผู้ใช้งาน (Username)</label>
                                <input type="text" class="form-control" id="username" required>
                                <div class="invalid-feedback">
                                    โปรดระบุชื่อผู้ใช้งาน Username
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="password" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="password" required>
                                <div class="invalid-feedback">
                                    โปรดกรอกรหัสผ่าน
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน</label>
                                <input type="password" class="form-control" id="confirm_password" required>
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
                        <button class="btn btn-primary btn-lg px-5" type="submit" data-bs-toggle="modal" data-bs-target="#modalSheet">สมัครสมาชิก</button>
                    </div>

                    {!! Form::close() !!}

                    <!-- Modal -->
                    <div class="modal fade" id="modalSheet" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                                    </svg>
                                    <h5 class="text-success fs-4 pt-2">ระบบได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว</h5>
                                </div>
                                <div class="modal-footer">
                                    <div class="mx-auto">
                                        <a type="button" class="btn btn-success2 rounded-pill text-white px-4 mx-2" data-bs-dismiss="modal">OK</a>
                                        <a href="index.html" type="" class="btn btn-outline-primary rounded-pill mx-2" value="">กลับหน้าแรก</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Modal-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#user_type').change(function() {
                $('#center_name, #center_phone, #school_phone, #address_no, #village_no, #province, #district, #subdistrict, #zipcode, #affiliation, #officer_type, #area, #position, #education_level').parent().show();

                // Handle specific user type selections
                if ($(this).val() == '1') { // เจ้าหน้าที่ศูนย์เด็กเล็ก
                    $('#school_name, #officer_type, #area, #school_phone').parent().hide();
                } else if ($(this).val() == '2') { // เจ้าหน้าที่ครูโรงเรียน
                    $('#center_name, #center_phone, #officer_type, #area').parent().hide();
                } else if ($(this).val() == '3') { // เจ้าหน้าที่สาธารณสุข
                    $('#center_name, #center_phone, #school_name, #school_phone, #address_no, #village_no, #province, #district, #subdistrict, #zipcode, #affiliation').parent().hide();
                } else if ($(this).val() == '4') { // บุคคลทั่วไป
                    $('#center_name, #center_phone, #school_name, #school_phone, #address_no, #village_no, #affiliation, #officer_type, #area, #position, #education_level').parent().hide();
                }
            });
        });
    </script>
@endpush
