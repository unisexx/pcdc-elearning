@extends('layouts.frontend')

@section('page', 'ข้อมูลสถิติ')

@section('content')
    @php
        extract($data);
    @endphp
    <!--====================================================
                                                                                        =                      CONTENT                         =
                                                                                        =====================================================-->
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-12">
                <div class="box-contact">

                    {!! Form::open([
                        'url' => url('stat'),
                        'method' => 'POST',
                        'files' => false,
                        'class' => 'form',
                        'autocomplete' => 'off',
                        'class' => 'mb-4 needs-validation',
                    ]) !!}
                    <div class="row g-3 pt-4">
                        <div class="col-12 col-md-3 pt-1">
                            <label for="" class="form-label">ประเภทของผู้ทดสอบ</label>
                            {!! Form::select('user_type_id', $user_type_list, @$user_type_id, ['class' => 'form-select select2 form-control-lg', 'id' => 'user_type_id', 'placeholder' => '--ทั้งหมด--']) !!}
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <label for="" class="form-label fs-5 text-primary">หลักสูตร</label>
                            {!! Form::select('curriculum_id', $curriculum_list, $curriculum_id, ['class' => 'form-select select2 form-control-lg', 'id' => 'curriculum_id', 'placeholder' => '--ทั้งหมด--']) !!}
                        </div>

                        <div class="col-12 col-sm-auto pt-1">
                            <label for="" class="form-label">ปี</label>
                            <select class="form-select select2" id="exam_year" name="exam_year">
                                <option value="">--ทั้งหมด--</option>
                                @for ($i = date('Y') + 543; $i >= $min_year; $i--)
                                    @php
                                        $selected = @$exam_year == $i ? 'selected="selected"' : '';
                                    @endphp
                                    <option value="{{ $i }}" {!! $selected !!}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="fs-5 fw-medium text-primary">เขตพื้นที่</div>
                        <div class="col-12 col-sm-auto">
                            <label for="" class="form-label">เขตพื้นที่</label>
                            {!! Form::select('area_id', $prevention_office_list, @$area_id, ['class' => 'form-select select2 form-control-lg', 'id' => 'area_id', 'placeholder' => '--ทั้งหมด--']) !!}
                        </div>
                        <div class="col-auto">หรือ</div>
                        <div class="col-12 col-sm-3">
                            <label for="" class="form-label">จังหวัด</label>
                            {!! Form::select('province_id', $provinces, $province_id, ['id' => 'province_id', 'class' => 'form-select select2 form-control-lg', 'placeholder' => '--ทั้งหมด--']) !!}
                        </div>
                        <div class="col-12 col-sm-auto">
                            <label for="" class="form-label">เขต/อำเภอ</label>
                            {!! Form::select('district_id', $districts, $district_id, ['class' => 'form-select select2 form-control-lg', 'id' => 'district_id', 'placeholder' => '--ทั้งหมด--']) !!}
                        </div>
                        <div class="col-12 col-sm-auto">
                            <label for="" class="form-label">แขวง/ตำบล</label>
                            {!! Form::select('subdistrict_id', $subdistricts, $subdistrict_id, ['class' => 'form-select select2 form-control-lg', 'id' => 'subdistrict_id', 'placeholder' => '--ทั้งหมด--']) !!}
                        </div>
                        <div class="col-auto text-center d-flex flex-column-reverse">
                            <button class="btn btn-primary px-5" type="submit"><span class="fa fa-fw fa-search"></span> ค้นหา</button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                    <div class="row mt-3 mb-3">
                        <div class="col-12 text-center">
                            <a href="{{ url('stat/export-xls?export_type=xls&' . $export_param) }}" class="btn btn-lg btn-success" target="_blank"> <i class="fa fa-file-excel"></i> ดาวน์โหลด ตารางข้อมูล</a>
                        </div>
                    </div>

                    @include('frontend.stat.inc.report1')

                    <div class="row my-5">
                        <div class="col-lg-6 col-md-12">
                            @include('frontend.stat.inc.report2')
                        </div>
                        <div class="col-lg-6 col-md-12">
                            @include('frontend.stat.inc.report3')
                        </div>
                    </div>

                    @include('frontend.stat.inc.report4')

                </div>
            </div>

        </div>
    </div>
    <!--=================== End Content =================-->
@endsection

@push('css')
    <!-- Styles chart -->
    <link href="{{ asset('html/css/chart.css') }}" rel="stylesheet">
@endpush

@push('js')
    <!-- C3 CHART JS -->
    <script src="{{ asset('html/js/charts-c3/d3.v5.min.js') }}"></script>
    <script src="{{ asset('html/js/charts-c3/c3-chart.js') }}"></script>
    <!-- Chart -->
    {{-- <script src="{{ asset('html/js/charts.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            function loadProvinces(area_id, provinceId = null) {
                var deferred = $.Deferred();

                $('#province_id').empty().append('<option value="">กำลังโหลด...</option>').prop('disabled', true);
                $('#district_id').empty().append('<option value="">กำลังโหลด...</option>').prop('disabled', true);
                $('#subdistrict_id').empty().append('<option value="">กำลังโหลด...</option>').prop('disabled', true);
                $('#zipcode').val('');

                area_id = area_id ? area_id : 0;

                $.ajax({
                    url: '/get-provinces/' + area_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#province_id').empty().append('<option value="">--ทั้งหมด--</option>');
                        $.each(data, function(id, name) {
                            $('#province_id').append('<option value="' + id + '">' + name + '</option>');
                        });
                        if (provinceId) {
                            $('#province_id').val(provinceId).change();
                        }

                        $('#province_id').prop('disabled', false);

                        deferred.resolve();
                    },
                    error: function() {
                        deferred.reject();
                    }
                });

                return deferred.promise();
            }

            $('[name=area_id]').change(function() {
                loadProvinces($(this).val());
            });
        });
    </script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // เมื่อ document พร้อมใช้งานให้ทำการผูก event change กับ user_type_id
            $('#user_type_id').change(function() {
                ajaxGetCurriculumList();
            });
        });

        function ajaxGetCurriculumList() {
            var userTypeId = $('#user_type_id').val();

            // เปลี่ยนข้อความใน #curriculum_id เป็น "กำลังโหลด" และ disabled
            $('#curriculum_id').empty().append('<option value="">กำลังโหลด...</option>').prop('disabled', true);

            $.ajax({
                url: "{{ route('getCurriculumList') }}", // ใช้ route name เพื่อสร้าง URL
                type: 'GET', // ใช้ GET method ในการดึงข้อมูล
                data: {
                    user_type_id: userTypeId // ส่งค่า user_type_id ไปด้วยใน request
                },
                success: function(response) {
                    // ล้างข้อมูลใน select box ก่อนที่จะใส่ข้อมูลใหม่
                    $('#curriculum_id').empty();

                    // เพิ่ม option placeholder '--ทั้งหมด--'
                    $('#curriculum_id').append('<option value="">--ทั้งหมด--</option>');

                    // วนลูปเพื่อเพิ่ม option ที่ได้จาก response
                    $.each(response, function(key, value) {
                        $('#curriculum_id').append('<option value="' + key + '">' + value + '</option>');
                    });

                    // เปิดใช้งาน select box หลังจากโหลดข้อมูลเสร็จ
                    $('#curriculum_id').prop('disabled', false);

                    // รีเฟรช select2
                    $('#curriculum_id').trigger('change.select2');
                },
                error: function(xhr, status, error) {
                    console.log("เกิดข้อผิดพลาดในการดึงข้อมูลหลักสูตร: " + error);
                    $('#curriculum_id').empty().append('<option value="">เกิดข้อผิดพลาด</option>').prop('disabled', false);
                }
            });
        }
    </script>
@endpush
