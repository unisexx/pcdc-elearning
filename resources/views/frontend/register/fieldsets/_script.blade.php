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
        var initialProvinceId = "{{ @$user->province_id }}";
        var initialDistrictId = "{{ @$user->district_id }}";
        var initialSubdistrictId = "{{ @$user->subdistrict_id }}";
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

<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
        });
    });
</script>
