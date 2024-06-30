<!--   Core JS Files   -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="{{ asset('argon/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('argon/assets/js/core/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('argon/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('argon/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
{{-- <script src="{{ asset('argon/assets/js/argon-dashboard.js') }}"></script> --}}

{{-- tooltip --}}
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>

{{-- InputMask --}}
{{-- <script src="{{ asset('js/inputmask/dist/jquery.inputmask.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function() {
        $(".mask-email").inputmask({
            alias: "email"
        });
        $(".mask-idcard").inputmask({
            "mask": "9-9999-99999-99-9",
            removeMaskOnSubmit: true,
        });
        $(".mask-idcard-space").inputmask({
            "mask": "9 9999 99999 99 9"
        });
        $(".mask-maimad-idcard").inputmask({
            "mask": "99-99-999999-99",
            removeMaskOnSubmit: true,
        });
        $(".mask-maimad-idcard-space").inputmask({
            "mask": "99 99 999999 99"
        });
        $(".mask-mobile").inputmask({
            "mask": "999-999-9999",
            removeMaskOnSubmit: true,
        });
        $(".mask-moo").inputmask({
            "mask": "999",
            "placeholder": ""
        });
        $(".mask-postcode").inputmask({
            "mask": "99999",
            "placeholder": ""
        });
        $(".mask-fax").inputmask({
            "mask": "9999999999",
            "placeholder": ""
        });
        $(".mask-bank-number").inputmask({
            "mask": "999-9-99999-9"
        });
        $(".mask-money").inputmask({
            alias: 'currency',
            prefix: "",
            // digitsOptional: true,
            removeMaskOnSubmit: true,
            groupSeparator: ',',
            autoGroup: true,
            digits: 2,
            digitsOptional: false,
            placeholder: '0.00',
            min: 0,
            // groupSeparator: ',',
            // numericInput: true,
            // onBeforeMask: function(value, opts) {

            // }
        });
        $(".mask-age").inputmask("numeric", {
            digits: "0",
            min: 0,
            max: 150
        });
        $('.mask-alphanumeric').inputmask({
            "mask": "99999999999999999999",
            "placeholder": ""
        });
        $(".mask-thaidate").inputmask({
            "mask": "99-99-9999", // วัน-เดือน-ปี
        });
        $(".mask-card-lose").inputmask("numeric", {
            digits: "0",
            min: 1,
            max: 1000
        });
    })
</script>

{{-- datepicker --}}
<script src="{{ asset('js/bootstrap-datepicker-thai/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js') }}"></script>
<link rel='stylesheet' type='text/css' href="{{ asset('js/bootstrap-datepicker-thai/css/datepicker.css') }}" />
<script type="text/javascript">
    function datepicker_active(obj) {
        $(obj).datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            language: 'th-th',
            clearBtn: true,
            todayHighlight: true,
        });
        $(obj).each(function(k, v) {
            $(this).addClass('form-control').css({
                'display': 'inline-block',
                'padding': '7px',
            }); //.attr('readonly',true);
            $(this).attr('placeholder', (!$(this).attr('placeholder') ? 'วัน-เดือน-ปี' : $(this).attr(
                'placeholder')));
            $(this).parent('div').after(
                ' <div class="col-auto p-0"><img class="calendar-icon" src=' + "{{ asset('image/calendar.png') }}" +
                ' width="38" height="38" role="button"></div> '
            );
        });
    }

    function datepicker_active_start_today(obj) {
        $(obj).datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            language: 'th-th',
            clearBtn: true,
            todayHighlight: true,
            startDate: '+1d',
        });
        $(obj).each(function(k, v) {
            $(this).addClass('form-control').css({
                'display': 'inline-block',
                'padding': '7px',
            }); //.attr('readonly',true);
            $(this).attr('placeholder', (!$(this).attr('placeholder') ? 'วัน-เดือน-ปี' : $(this).attr(
                'placeholder')));
            $(this).parent('div').after(
                ' <div class="col-auto p-0"><img class="calendar-icon" src=' + "{{ asset('image/calendar.png') }}" +
                ' width="38" height="38" role="button"></div> '
            );
        });
    }

    $(function() {
        datepicker_active('.datepicker');
        datepicker_active_start_today('.datepicker_start_today');
        $('body').on('click', '.calendar-icon', function() {
            $(this).parent('div').prev().find('.datepicker').focus();
        });
    });

    /**
     * Daterange Picker
     */
    $('.input-daterange').datepicker({
        inputs: $('.range-date'),
        autoclose: true,
        todayHighlight: false,
        toggleActive: true,
        format: 'dd/mm/yyyy',
        autoclose: true,
        language: 'th-th',
        clearBtn: true,
    }).on('changeDate', function(selected) {
        updateDate($(this).closest('form').find('[name=start_date]'), selected);
    });

    // อัพเดทหลังจากที่เลือกวันแล้ว (วันที่เริ่มต้น เลือกวันไหนก็ได้) (แต่วันที่สิ้นสุด ไม่ให้เลือกก่อนวันเริ่มต้น)
    function updateDate(inputs, selected) {
        // console.log($(inputs).val());
        $('[name=end_date]').datepicker('setStartDate', $(inputs).val());
    }

    $('.range-date').each(function(k, v) {
        $(this).addClass('form-control').css({
            'display': 'inline-block',
            'padding': '7px',
            'border-radius': '.25rem',
        }); //.attr('readonly',true);
        $(this).attr('placeholder', (!$(this).attr('placeholder') ? 'วัน-เดือน-ปี' : $(this).attr(
            'placeholder')));
    });

    /*
     *   นำ start_date กับ end_date ที่ได้มาอัพเดทตั้งค่าใหม่
     *   ไม่ให้ start_date เลือกวันหลัง end_date ได้
     *   ไม่ได้ end_date เลือกวันหน้า start_date ได้
     */
    $(function() {
        startDate = "{{ @DB2Date(@$start_date) }}";
        endDate = "{{ @DB2Date(@$end_date) }}";
        // console.log(endDate);
        if (startDate) {
            $('[name=end_date]').datepicker('setStartDate', endDate);
            // $('[name=start_date]').datepicker('setEndDate', startDate);
        }
    });
</script>

{{-- print this --}}
<script src="{{ asset('js/print-this/printThis.js') }}"></script>

{{-- Tiny MCE --}}
{{-- <script src="https://cdn.tiny.cloud/1/3n6gkw4fc40e1p915bhekje73ea4erdpb5b1xq85eh4z2q9o/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
{{-- <script src="{{ asset('js/tinymce_7.1.2/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tiny',
        external_plugins: {
            "responsivefilemanager": "{{ asset('js/tinymce_7.1.2/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js') }}",
            'youtube': '{{ asset('js/tinymce_7.1.2/tinymce/js/tinymce/plugins/youtube/plugin.min.js') }}', // ตัวอย่างการเพิ่มปลั๊กอินจาก URL ภายนอก
        },
        plugins: 'link image code youtube responsivefilemanager', // ระบุชื่อปลั๊กอินที่ต้องการใช้ใน TinyMCE
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link responsivefilemanager youtube',
        external_filemanager_path: "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/filemanager') }}/",
        filemanager_title: "Responsive Filemanager",
    });
</script> --}}

<script src="{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: "textarea.tiny",
        menubar: false,
        theme: "silver",
        min_height: 600,
        resize: 'vertical',
        external_plugins: {
            "responsivefilemanager": "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js') }}",
            'youtube': '{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/youtube/plugin.min.js') }}',
        },
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code youtube"
        ],
        menubar: 'file edit view insert format tools table tc help',
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | fontsizeselect",
        // toolbar2: "| responsivefilemanager | link unlink | image media | youtube | forecolor backcolor | preview code ",
        toolbar2: "| responsivefilemanager | youtube | link unlink | forecolor backcolor | preview code ",
        image_advtab: true,
        external_filemanager_path: "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/filemanager') }}/",
        filemanager_title: "Responsive Filemanager",
        // content_css: "{{ asset('front-html/css/bootstrap.min.css') }}, {{ asset('front-html/css/styles.css') }}",
        // relative_urls : false,
        // remove_script_host : false,
        // convert_urls : true,
    });
</script>
