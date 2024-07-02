@extends('layouts.frontend')

@section('page', 'คำถามที่พบบ่อย')

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
                            <div class="col-md-4 col-lg-4">
                                <label for="" class="form-label fs-5 text-primary">หลักสูตร</label>     
                                {!! Form::select(
                                    'curriculum_id',
                                    $curriculum_list,
                                    $curriculum_id,
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'user_type_id', 'placeholder' => '--ทั้งหมด--'],
                                ) !!}                                                                                          
                            </div>

                            <div class="col-12 col-md-3 pt-1">
                                <label for="" class="form-label">ประเภทของผู้ทดสอบ</label>
                                {!! Form::select(
                                    'user_type_id',
                                    $user_type_list,
                                    @$user_type_id,
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'user_type_id', 'placeholder' => '--ทั้งหมด--'],
                                ) !!}                                   
                            </div>
                            <div class="col-12 col-sm-auto pt-1">
                                <label for="" class="form-label">ปี</label>
                                <select class="form-select" id="exam_year" name="exam_year">
                                    <option selected disabled value="">--ทั้งหมด--</option>
                                    @for($i=(date("Y")+543);$i>=$min_year;$i--)
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
                                <label for="" class="form-label">เจ้าหน้าที่ประจำเขต</label>
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
                                    @$area_id,
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'area_id', 'placeholder' => '--ทั้งหมด--'],
                                ) !!}
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

                    @include('frontend.stat.inc.report1')

                    @include('frontend.stat.inc.report2')

                    @include('frontend.stat.inc.report3')                    

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
@endpush
