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
        <div class="col-md-12">
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
        <div class="col-md-12">
            {!! Form::label('phone', 'เบอร์โทรศัพท์', ['class' => 'form-label']) !!}
            <span class="text-danger ms-1">*</span>
            {!! Form::text('phone', null, ['class' => 'form-control form-control-lg', 'id' => 'phone', 'required']) !!}
            <div class="invalid-feedback">
                กรุณากรอกหมายเลขเบอร์โทรศัพท์
            </div>
        </div>
    </div>
</fieldset>
