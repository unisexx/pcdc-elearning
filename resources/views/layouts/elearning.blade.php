<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.name', 'e-learning โรคติดต่อในเด็กและโควิด 19') }}">
    <meta name="author" content="{{ config('app.name', 'e-learning โรคติดต่อในเด็กและโควิด 19') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'e-learning โรคติดต่อในเด็กและโควิด 19') }}</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('html/images/favicon.svg') }}" type="image/x-icon" />
    
    <link href="{{ asset("elearning/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("elearning/css/animate.css") }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("elearning/css/all.min.css") }}" />
    <!-- Styles for this template -->
    <link href="{{ asset("elearning/css/style.css") }}" rel="stylesheet">
    <link href="{{ asset("elearning/css/custom.css") }}" rel="stylesheet">
    @stack('css')
</head>

<body>
    @include('layouts.elearning.header')
    
<main>
    <!-- /.container breadcrumb-->
    <div class="container-fluid mt-4 pt-2">
        <nav class="breadcrumb-line" aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-end mb-3">
            <li class="breadcrumb-item">
                <a href="{{ url('/home')}}">
                    <em class="fa fa-home-alt fs-6 me-2"></em>หน้าแรก
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('elearning/curriculum/'.$curriculum->id)}}">
                    {{$curriculum->name}}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">@yield('page')</li>
          </ol>
        </nav>
    </div>
    <!-- /.container breadcrumb-->

<!--====================================================
=                      CONTENT                         =
=====================================================-->
<div class="container-fluid">

<!-- ##### START tabs ##### -->
<div class="tab_lesson">
    <!--##### Nav tabs #####-->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item mt-2" role="presentation">
        <a class="nav-link active" id="lesson-tab" data-bs-toggle="tab" data-bs-target="#lesson-tab-pane" type="button" role="tab" aria-controls="lesson-tab-pane" aria-selected="false">บทเรียน</a>
      </li>
      <li class="nav-item mt-2" role="presentation">
        <a class="nav-link" id="academic_results-tab" data-bs-toggle="tab" data-bs-target="#academic_results-tab-pane" type="button" role="tab" aria-controls="academic_results-tab-pane" aria-selected="false">ผลการเรียน</a>
      </li>
    </ul>

    <!--##### Tab content ####-->
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="lesson-tab-pane" role="tabpanel" aria-labelledby="lesson-tab" tabindex="0">
      <div class="row bg-white rounded-5 p-3">
        <div class="col-lg-8">
            @yield('content')
        </div>
        <div class="col-lg-4">
          <div class="widget_block sticky-top sticky-offset vh-100 overflow-auto scrollable-element1">
            <div class="list_menu">{{ $curriculum->name }}</div>
            <hr>
            <div class="list_menu">สารบัญ</div>
            <div class="widget_categories">
              <ul>
                <li>
                  <div class="pass_score">
                    <a href="#"><em class="fa fa-home fs-5 me-2 icon_list_menu "></em> บทนำ</a>
                  </div>
                </li>
                @if($curriculum->curriculum_exam_setting->pre_test_status == 'active')
                  <li>
                    <div class="pass_score">
                      <a href="{{ url('elearning/curriculum/4/pretest') }}"><em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>ทำแบบทดสอบก่อนเรียน (pre-Test)</a>
                    </div>
                  </li>
                @endif
                <hr>
                <div class="list_menu">เรียนรู้บทเรียน (Learning)</div>
                @foreach($curriculum->curriculum_lesson()->where('status','active')->orderBy('pos','asc')->get() as $key=>$lesson)
                    <li>
                        <div class="pass_score">
                            <a href="{{ url("elearning/curriculum/lesson/".$lesson->id) }}">
                                <em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em>
                                {{ $lesson->name }}
                            </a>
                        </div>
                    </li>
                    @php
                        $lesson_exam = $curriculum->curriculum_exam_setting->curriculum_exam_setting_detail()->where('curriculum_lesson_id',$lesson->id)->first();
                    @endphp
                    @if($lesson_exam->exam_status == 'active')
                        <li style="padding-left:30px;">
                            <div class="pass_score">
                                <a href="quiz_1.html">
                                    <em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>
                                    ทำแบบทดสอบท้ายบท                                    
                                </a>
                            </div>
                        </li>
                    @endif
                @endforeach
                <hr>                
                @if($curriculum->curriculum_exam_setting->pre_test_status == 'active')
                  <li>
                    <div class="pass_score">
                      <a href="{{ url('elearning/curriculum/4/posttest') }}"><em class="fas fa-graduation-cap fs-5 me-2 icon_list_menu "></em>วัดผลหลังเรียนรู้ (Post-test)</a>
                    </div>
                  </li>
                @endif
                {{-- <li><div class="pass_score"><a href="quiz_1.html"><em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>ทำแบบทดสอบท้ายบทเรียนที่1 (Quiz 1)</a></div></li>
                <li><div class="pass_score"><a href="#"><em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em>บทเรียนที่2 โรคติดต่อที่พบบ่อยในเด็ก</a></div></li>
                <li><div class="pass_score"><a href="#"><em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>ทำแบบทดสอบท้ายบทเรียนที่2 (Quiz 2)</a></div></li>
                <li><div class="pass_score"><a href="#"><em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em>บทเรียนที่3 การป้องกันควบคุมโรคติดต่อ</a></div></li>
                <li><div class="pass_score"><a href="#"><em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>ทำแบบทดสอบท้ายบทเรียนที่3 (Quiz 3)</a></div></li>
                <li><div class="pass_score"><a href="#"><em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em>บทเรียนที่4 แนวปฏิบัติการเฝ้าระวังป้องกัน ควบคุมโรคติดเชื้อไวรัส โคโรนา 2019 (Covid-19) ในสถานศึกษา</a></div></li>
                <li><div class="pass_score"><a href="#"><em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>ทำแบบทดสอบท้ายบทเรียนที่4 (Quiz 4)</a></div></li>
                <li><div class="pass_score"><a href="#"><em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em>บทเรียนที่5 การดูแลเด็กป่วยเบื้องต้น</a></div></li>
                <li><div class="pass_score"><a href="#"><em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>ทำแบบทดสอบท้ายบทเรียนที่5 (Quiz 5)</a></div></li>
                <li><div class="pass_score"><a href="#"><em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em>บทเรียนที่6 สถานการณ์โรค</a></div></li>
                <li><div class="pass_score"><a href="#"><em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>ทำแบบทดสอบท้ายบทเรียนที่6 (Quiz 6)</a></div></li> --}}
                {{-- <hr>
                <li><div class="pass_score"><a href="post_test.html" class="active"><em class="fas fa-graduation-cap fs-5 me-2 icon_list_menu "></em>วัดผลหลังเรียนรู้ (Post-test)</a></div></li> --}}
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div><!-- End tab-content 1 -->

    </div><!-- End Tab-content-->

</div><!-- ##### End tabs ##### -->



</div>
<!--=================== End Content =================-->
    
</main>

    @include('layouts.elearning.footer')
    @include('frontend._script')
    @stack('js')
</body>
</html>