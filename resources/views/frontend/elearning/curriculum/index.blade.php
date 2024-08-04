@extends('layouts.curriculum')

@section('page', 'บทนำ')

@section('content')
    <div class="bg-1 h-100">
        <div class="d-flex justify-content-center title_welcome">ยินดีต้อนรับเข้าสู่บทเรียน</div>
        <fieldset class="my-5 border rounded-3 pt-5 px-3 position-relative fs-5">
            <legend class="tab_lesson_title w-auto rounded-pill">
                <img src="{{ asset('elearning/images/info2.svg') }}" alt="" height="35" class="me-2">
                {{ $curriculum->name }}
            </legend>
            {!! $curriculum->intro !!}
        </fieldset>
        <fieldset class="my-5 border rounded-3 pt-5 px-3 position-relative fs-5">
            <legend class="tab_lesson_title w-auto rounded-pill">
                <img src="{{ asset('elearning/images/target-flag.svg') }}" alt="" height="35" class="me-2">
                วัตถุประสงค์
            </legend>
            {!! $curriculum->objective !!}
        </fieldset>
        <fieldset class="my-5 border rounded-3 pt-5 px-3 position-relative fs-5">
            <legend class="tab_lesson_title w-auto rounded-pill text-success">
                <i class="fa fa-download"></i> 
                ดาวน์โหลด
            </legend>
            <ul style="list-style-type: none;">
                <li class="text-success">เนื้อหาหลักสูตรและบทเรียน</li>
                <li style="padding-left:20px;">
                    <a href="">
                        <i class="fa fa-file-pdf"></i> เนื้อหาหลักสูตร "{{ $curriculum->name }}"
                    </a>
                </li>
                @if ($curriculum->curriculum_lesson)
                    @foreach ($curriculum->curriculum_lesson as $key => $lesson)
                        <li style="padding-left:60px;">
                            <a href="">
                                <i class="fa fa-file-pdf"></i> เนื้อหาบทเรียน "{{ $lesson->name }}"
                            </a>
                        </li>
                    @endforeach
                @endif
                @if ($curriculum->curriculum_exam_setting)
                    <li class="text-success">แบบทดสอบท้ายบทเรียน</li>
                    @foreach ($curriculum->curriculum_lesson as $key => $lesson)
                        @php
                            if ($curriculum->curriculum_exam_setting) {
                                $has_lesson_exam = $curriculum->curriculum_exam_setting
                                    ->curriculum_exam_setting_detail()
                                    ->where('curriculum_lesson_id', $lesson->id)
                                    ->where('exam_status', 'active')
                                    ->count();
                            } else {
                                $has_lesson_exam = 0;
                            }
                        @endphp

                        @if($has_lesson_exam > 0)
                            <li style="padding-left:60px;">
                                <a href="">
                                    <i class="fa fa-file-pdf"></i> แบบทดสอบท้ายบทเรียน "{{ $lesson->name }}"
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </fieldset>
        <div class="row">
            <div class="col-12 text-center">
                @if ($curriculum->curriculum_exam_setting)
                    @if ($curriculum->curriculum_exam_setting->pre_test_status == 'active')
                        <a href="{{ url('elearning/curriculum/' . $curriculum->id . '/pretest') }}" class="btn btn-lg btn-primary"><em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em> ทำแบบทดสอบก่อนเรียน (Pre-Test)</a>
                    @else
                        @if ($curriculum->curriculum_lesson)
                            <a href="{{ url('elearning/curriculum/lesson/' . $curriculum->curriculum_lesson->first()->id) }}" class="btn btn-lg btn-primary">ไปที่เนื้อหาบทเรียนถัดไป <em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em></a>
                        @endif
                    @endif
                @elseif ($curriculum->curriculum_lesson)
                    <a href="{{ url('elearning/curriculum/lesson/' . $curriculum->curriculum_lesson->first()->id) }}" class="btn btn-lg btn-primary">เข้าสู่เนื้อหาบทเรียน <em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em></a>                    
                @endif
            </div>
        </div>
        @if($curriculum->curriculum_lesson)        
        <div class="w-100" style="margin-top:55px;">
            <div class="title_tab"><span>บทเรียน</span> {{ $curriculum->name }}</div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center mt-3">
            
                @foreach ($curriculum->curriculum_lesson as $key => $lesson)
                    <div class="col my-4">
                        <div class="blog-style1 h-100 position-relative">
                            <div class="blog-img">
                                <img src="{{ Storage::url('uploads/curriculum_lesson/' . @$lesson->cover_image) }}" alt="" class="img-fluid w-100">
                            </div>
                            <div class="blog-content">
                                <span class="lesson"><img src="{{ asset('html/images/bulb.svg') }}" alt="" width="24"> บทเรียนที่ {{ $key + 1 }}</span>
                                <h3 class="blog-title h5">{{ $lesson->name }}</h3>
                                <p>{{ $lesson->description }}</p>
                            </div>                            
                            <a id="a_lesson_{{ $lesson->id }}" href="{{ url('elearning/curriculum/lesson/' . $lesson->id) }}" class="blog-btn position-absolute bottom-0">
                                เข้าสู่บทเรียน <em class="fa fa-angle-right"></em>
                            </a>
                        </div>
                    </div>
                @endforeach
            
        </div>
        @endif
    </div>
@endsection
@push('js')
    <script>
        $("#a_intro").addClass("active");
    </script>
@endpush
