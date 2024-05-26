<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('html/js/bootstrap.bundle.min.js') }}"></script>
<!-- JS Animate -->
<script src="{{ asset('html/js/wow.min.js') }}"></script>
<script>
    new WOW().init();
</script>
<script>
    let inputBox = document.querySelector(".search-input-box"),
        searchIcon = document.querySelector(".icon"),
        closeIcon = document.querySelector(".close-icon");

    searchIcon.addEventListener("click", () => inputBox.classList.add("open"));
    closeIcon.addEventListener("click", () => inputBox.classList.remove("open"));
</script>

<script>
    // Get the button GO TO TOP
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 200px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
{{-- Sweetalert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif
@if (session('error'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif
@if (session('warning'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: '{{ session('warning') }}',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif
@if (session('info'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: '{{ session('info') }}',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
        });
    });
</script>
{{-- jquery.inputmask.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
<script>
    $(document).ready(function() {
        $('.mask-age').inputmask({
            alias: "numeric",
            min: 0,
            max: 120,
            rightAlign: false,
            placeholder: ""
        });
    });
</script>


{{-- Chain Select จังหวัด / อำเภอ / ตำบล --}}
<script>
    $(document).ready(function() {
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
            loadDistricts(initialProvinceId, initialDistrictId).done(function() {
                if (initialDistrictId) {
                    loadSubdistricts(initialDistrictId, initialSubdistrictId);
                }
            });
        }
    });

    function loadDistricts(provinceId, districtId = null) {
        var deferred = $.Deferred();

        $('#district_id').empty().append('<option value="">กำลังโหลด...</option>');
        $('#subdistrict_id').empty().append('<option value="">กำลังโหลด...</option>');
        $('#zipcode').val('');

        if (provinceId) {
            $.ajax({
                url: '/get-districts/' + provinceId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#district_id').empty().append('<option value="">โปรดเลือก...</option>');
                    $.each(data, function(id, name) {
                        $('#district_id').append('<option value="' + id + '">' + name + '</option>');
                    });
                    if (districtId) {
                        $('#district_id').val(districtId).change();
                    }
                    deferred.resolve();
                },
                error: function() {
                    deferred.reject();
                }
            });
        } else {
            deferred.resolve();
        }

        return deferred.promise();
    }

    function loadSubdistricts(districtId, subdistrictId = null) {
        var deferred = $.Deferred();

        $('#subdistrict_id').empty().append('<option value="">กำลังโหลด...</option>');
        $('#zipcode').val('');

        if (districtId) {
            $.ajax({
                url: '/get-subdistricts/' + districtId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#subdistrict_id').empty().append('<option value="">โปรดเลือก...</option>');
                    $.each(data, function(id, name) {
                        $('#subdistrict_id').append('<option value="' + id + '">' + name + '</option>');
                    });
                    if (subdistrictId) {
                        $('#subdistrict_id').val(subdistrictId).change();
                    }
                    deferred.resolve();
                },
                error: function() {
                    deferred.reject();
                }
            });
        } else {
            deferred.resolve();
        }

        return deferred.promise();
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
</script>
