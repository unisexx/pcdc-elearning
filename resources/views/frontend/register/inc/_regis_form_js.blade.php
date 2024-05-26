@push('js')
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
