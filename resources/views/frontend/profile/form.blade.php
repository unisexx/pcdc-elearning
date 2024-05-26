@extends('layouts.frontend')

@section('page', 'แก้ไขข้อมูลส่วนตัว')

@section('content')
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-8 mx-auto">
                <div class="box-contact">
                    <div class="title-register text-center mb-3">แก้ไขข้อมูลส่วนตัว</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::model($rs, [
                        'method' => 'PUT',
                        'route' => ['profile.update', $rs->id],
                        'class' => 'my-4 needs-validation register-form',
                        'novalidate',
                    ]) !!}

                    @include('frontend.register.inc._sec1_usertype')
                    @include('frontend.register.inc._sec2_profile')
                    {{-- @include('frontend.register.inc._sec3_login') --}}

                    <div class="col-12 mt-4 text-center">
                        <button class="btn btn-primary btn-lg px-5" type="submit">ยืนยัน</button>
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
        });
    </script>

    {{-- ซ่อน / แสดงฟอร์ม --}}
    <script>
        $(document).ready(function() {
            // Disable all input fields initially
            $('.form-control, .form-select').not('#user_type_id').prop('disabled', true);

            // ผูก event handlers กับการเปลี่ยนแปลง
            $('#user_type_id').change(function() {
                toggleFormFields();
            });

            $('#officer_type_id').change(function() {
                toggleOfficerTypeFields();
            });

            $('#affiliation_id').change(function() {
                toggleAffiliationOtherField();
            });

            // เรียกฟังก์ชั่นเริ่มต้นเพื่อกำหนดสถานะเบื้องต้น
            toggleFormFields();
            toggleOfficerTypeFields();
            toggleAffiliationOtherField();
        });

        function toggleFormFields() {
            // แสดงฟิลด์ทั้งหมดก่อน
            var allFields = $('#center_name, #center_phone, #school_name, #school_phone, #address_no, #village_no, #province_id, #district_id, #subdistrict_id, #zipcode, #affiliation_id, #officer_type_id, #area_id, #position, #education_level_id, #affiliation_other').parent();

            allFields.removeClass('animate__');
            allFields.removeClass('animate__animated animate__bounceIn').hide().addClass('animate__animated animate__bounceIn').show();

            // ซ่อนฟิลด์ที่ไม่ต้องการ
            var userType = $('#user_type_id').val();
            if (userType == '1') { // เจ้าหน้าที่ศูนย์เด็กเล็ก
                $('#school_name, #school_phone, #officer_type_id, #area_id, #education_level_id, #affiliation_other').parent().hide();
            } else if (userType == '2') { // เจ้าหน้าที่ครูโรงเรียน
                $('#center_name, #center_phone, #officer_type_id, #area_id, #education_level_id, #affiliation_other').parent().hide();
            } else if (userType == '3') { // เจ้าหน้าที่สาธารณสุข
                $('#center_name, #center_phone, #school_name, #school_phone, #address_no, #village_no, #province_id, #district_id, #subdistrict_id, #zipcode, #affiliation_id, #area_id, #affiliation_other').parent().hide();
            } else if (userType == '4') { // บุคคลทั่วไป
                $('#center_name, #center_phone, #school_name, #school_phone, #address_no, #village_no, #affiliation_id, #officer_type_id, #area_id, #position, #education_level_id, #affiliation_other').parent().hide();
            }

            if (userType !== '') {
                $('.form-control, .form-select').not('#user_type_id').prop('disabled', false);
            } else {
                $('.form-control, .form-select').not('#user_type_id').prop('disabled', true);
            }
        }

        function toggleOfficerTypeFields() {
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
        }

        function toggleAffiliationOtherField() {
            // เงื่อนไขเพิ่มเติม
            var affiliationId = $('#affiliation_id').val();

            if (affiliationId == '7') {
                $('#affiliation_other').parent().show();
            } else {
                $('#affiliation_other').parent().hide();
            }
        }
    </script>

    {{-- Chain Select จังหวัด / อำเภอ / ตำบล --}}
    <script>
        $(document).ready(function() {
            function loadDistricts(provinceId, districtId = null) {
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
                            if (districtId) {
                                $('#district_id').val(districtId).change();
                            }
                        }
                    });
                }
            }

            function loadSubdistricts(districtId, subdistrictId = null) {
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
                            if (subdistrictId) {
                                $('#subdistrict_id').val(subdistrictId).change();
                            }
                        }
                    });
                }
            }

            function loadZipcode() {
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
            }

            $('#province_id').change(function() {
                loadDistricts($(this).val());
            });

            $('#district_id').change(function() {
                loadSubdistricts($(this).val());
            });

            $('#subdistrict_id').change(function() {
                loadZipcode();
            });


            // รันคำสั่ง chain select ตอนโหลดหน้า form edit
            var initialProvinceId = "{{ @$rs->province_id }}";
            var initialDistrictId = "{{ @$rs->district_id }}";
            var initialSubdistrictId = "{{ @$rs->subdistrict_id }}";

            if (initialProvinceId) {
                loadDistricts(initialProvinceId, initialDistrictId);
            }

            if (initialDistrictId) {
                loadSubdistricts(initialDistrictId, initialSubdistrictId);
            }
        });
    </script>

    <script>
        // ล้างค่า input ที่อยู่ใน hidden element ก่อน submit form
        $(document).ready(function() {
            function clearHiddenInputs() {
                // หา element ทุกตัวภายใน form ที่มี display: none
                var hiddenElements = $('form *').filter(function() {
                    return $(this).css('display') === 'none';
                });

                // หา :input ที่อยู่ใน hiddenElements แล้วทำการล้างค่าออก
                hiddenElements.each(function() {
                    $(this).find(':input').val('');
                });

                // แสดงผลเพื่อดูว่าเลือกได้ถูกต้องหรือไม่
                hiddenElements.each(function() {
                    console.log($(this).attr('id')); // หรือทำสิ่งที่ต้องการกับ element เหล่านี้
                });
            }

            // รันฟังก์ชั่น clearHiddenInputs ตอน submit form
            $('form').on('submit', function(e) {
                clearHiddenInputs();
            });
        });
    </script>

    {{-- JS Validation --}}
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\RegisterUserRequest', '.register-form') !!}
@endpush
