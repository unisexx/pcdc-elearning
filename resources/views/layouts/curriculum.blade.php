<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- ถ้าขึ้น production ของจริงแล้วให้เอา robots ออก --}}
    <meta name="robots" content="noindex, nofollow">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.name', 'e-learning โรคติดต่อในเด็กและโควิด 19') }}">
    <meta name="author" content="{{ config('app.name', 'e-learning โรคติดต่อในเด็กและโควิด 19') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'e-learning โรคติดต่อในเด็กและโควิด 19') }}</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('html/images/favicon.svg') }}" type="image/x-icon" />

    <link href="{{ asset('elearning/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('elearning/css/animate.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('elearning/css/all.min.css') }}" />

    <!-- Styles for this template -->
    <link href="{{ asset('elearning/css/style.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('elearning/css/custom.css') }}?v={{ time() }}" rel="stylesheet">

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
                        <a href="{{ url('/home') }}">
                            <em class="fa fa-home-alt fs-6 me-2"></em>หน้าแรก
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('elearning/curriculum/' . $curriculum->id) }}">
                            {{ $curriculum->name }}
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
                <ul class="nav nav-tabs fs-4" id="myTab" role="tablist">
                    <li class="nav-item mt-2" role="presentation">
                        <a class="nav-link active" id="lesson-tab" data-bs-toggle="tab"
                            data-bs-target="#lesson-tab-pane" type="button" role="tab"
                            aria-controls="lesson-tab-pane" aria-selected="false">บทเรียน</a>
                    </li>
                    <li class="nav-item mt-2" role="presentation">
                        <a class="nav-link" id="academic_results-tab" data-bs-toggle="tab"
                            data-bs-target="#academic_results-tab-pane" type="button" role="tab"
                            aria-controls="academic_results-tab-pane" aria-selected="false">ผลการเรียน</a>
                    </li>
                </ul>

                <!--##### Tab content ####-->
                @php
                    $all_exam_result = \App\Models\UserCurriculumPpExam::where('user_id', Auth::user()->id)
                        ->where('curriculum_id', $curriculum->id)
                        ->get();
                @endphp
                <div class="tab-content" id="myTabContent">
                    <!-- Start Tab-content 1-->
                    <div class="container">
                        <div class="tab-pane fade active show" id="lesson-tab-pane" role="tabpanel"
                            aria-labelledby="lesson-tab" tabindex="0">
                            <div class="row bg-white rounded-5 p-3">
                                <div class="col-lg-12">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End tab-content 1 -->

                    <!-- Start Tab-content 2-->
                    <div class="tab-pane fade " id="academic_results-tab-pane" role="tabpanel"
                        aria-labelledby="academic_results-tab" tabindex="0">
                        <div class="container">
                            <div class="title_disease">ผลการเรียน</div>
                            <hr>
                            <div class="row justify-content-center gx-5 box-bar">
                                <div class="col-lg-5">
                                    <div class="box_point_style1">
                                        <div class="box_point_bg1"></div>
                                        <div class="box_point_bg2"></div>
                                        <div class="card-text">คะแนนแบบทดสอบก่อนเรียน (pre-Test)</div>
                                        @php
                                            $pretest = \App\Models\UserCurriculumPpExam::where(
                                                'user_id',
                                                \Auth::user()->id,
                                            )
                                                ->where('curriculum_id', $curriculum->id)
                                                ->where('exam_type', 'pretest')
                                                ->first();
                                            $total_score = empty($pretest) ? 0 : $pretest->total_score;
                                            $total_question = empty($pretest) ? 0 : $pretest->n_question;
                                        @endphp
                                        @if (empty($pretest))
                                            <div class="title_score_nopoints"><span>ยังไม่มี</span> คะแนน</div>
                                        @else
                                            <div class="title_score_points">
                                                <span>{{ number_format($pretest->total_score, 0) }}/{{ number_format($pretest->total_question, 0) }}</span>
                                                คะแนน
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="box_point_style1">
                                        <div class="box_point_bg1"></div>
                                        <div class="box_point_bg2"></div>
                                        <div class="card-text">คะแนนวัดผลหลังเรียนรู้ (Post-test)</div>
                                        @php
                                            $posttest = \App\Models\UserCurriculumPpExam::where(
                                                'user_id',
                                                \Auth::user()->id,
                                            )
                                                ->where('curriculum_id', $curriculum->id)
                                                ->where('exam_type', 'posttest')
                                                ->first();
                                            $total_score = empty($pretest) ? 0 : $pretest->total_score;
                                            $total_question = empty($pretest) ? 0 : $pretest->n_question;
                                        @endphp
                                        @if (empty($posttest))
                                            <div class="title_score_nopoints"><span>ยังไม่มี</span> คะแนน</div>
                                        @else
                                            <div class="title_score_points">
                                                <span>{{ number_format($posttest->total_score, 0) }}/{{ number_format($posttest->total_question, 0) }}</span>
                                                คะแนน
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if (!empty($posttest))
                                @if ($posttest->total_question == $posttest->n_question && $posttest->total_score >= $posttest->pass_score)
                                    <div class="row box-bar text-center fs-5">
                                        <p>ขอความร่วมมือตอบแบบสอบถามความพึงพอใจ เพื่อนำข้อมูลไปพัฒนาระบบ e-Learning
                                            <button type="button" class="btn btn-info rounded-pill open-survey-btn"
                                                data-bs-toggle="modal" data-bs-target="#surveyModal"
                                                data-curriculum-id="{{ $curriculum->id }}">
                                                แบบสอบถามความพึงพอใจ
                                            </button>
                                            @php
                                                $n_survey = \App\Models\SurveyResult::where(
                                                    'user_id',
                                                    \Auth::user()->id,
                                                )
                                                    ->where('curriculum_id', $curriculum->id)
                                                    ->count();
                                            @endphp
                                            <input type="hidden" name="exists_survey" id="exists_survey"
                                                value="{{ number_format($n_survey, 0) }}">
                                        </p>
                                        @include('components.frontend.survey')
                                        <p>ผ่านการเรียนและทดสอบตามที่กำหนด คลิกที่นี่เพื่อรับใบประกาศนียบัตร
                                            <button type="button"
                                                class="btn btn-success rounded-pill text-white btn-download-cert">
                                                <em class="fa fa-download me-2"></em>
                                                ดาวน์โหลดใบประกาศนียบัตรของคุณ
                                            </button>
                                            @push('js')
                                                <script>
                                                    $(document).ready(function() {
                                                        $(".btn-download-cert").click(function() {
                                                            $exists_survey = $("#exists_survey").val();
                                                            if ($exists_survey >= 1) {
                                                                window.open("{{ url('certificate/pdf/' . $curriculum->id) }}")
                                                            } else {
                                                                Swal.fire({
                                                                    title: 'แจ้งเตือนการใช้งาน',
                                                                    html: 'กรุณากรอกแบบสอบถามความพึงพอใจก่อนดาวน์โหลดใบประกาศนียบัตรของคุณ',
                                                                    showConfirmButton: true,
                                                                });
                                                            }
                                                        });
                                                    });
                                                </script>
                                            @endpush
                                        </p>
                                    </div>
                                @endif
                            @endif
                            <div class="row box-bar">
                                <div class="col-lg-11 mx-auto">
                                    <ul class="results_list1 fs-5">
                                        <li>
                                            <strong>แบบทดสอบก่อนเรียน (pre-Test)</strong>

                                            @if (empty($pretest) || $pretest->total_question < $pretest->n_question)
                                                <div class="notyet_pass">
                                                    ยังไม่ผ่าน (ยังไม่แล้วเสร็จ)
                                                </div>
                                            @else
                                                <div class="results_pass">
                                                    {{ number_format($pretest->total_score) }} /
                                                    {{ $pretest->n_question }}
                                                </div>
                                            @endif
                                            {{-- @elseif($pretest->total_question == $pretest->n_question && $pretest->total_score < $pretest->pass_score)
                                                <div class="notyet_pass">
                                                    ยังไม่ผ่าน
                                                    {{ number_format($pretest->total_score) }} /
                                                    {{ $pretest->n_question }}
                                                </div>
                                            @elseif($pretest->total_question == $pretest->n_question)
                                                <div class="results_pass">
                                                    <em class="fa fa-check me-2"></em>ผ่าน
                                                    {{ number_format($pretest->total_score) }} /
                                                    {{ $pretest->n_question }}
                                                </div>
                                            @endif --}}
                                        </li>
                                        @foreach ($curriculum->curriculum_lesson()->where('status', 'active')->orderBy('pos', 'asc')->get() as $key => $lesson)
                                            @php
                                                $cr_examsetting = \App\Models\CurriculumExamSettingDetail::where(
                                                    'curriculum_lesson_id',
                                                    $lesson->id,
                                                )->first();
                                            @endphp
                                            @if ($cr_examsetting == '1')
                                                @php
                                                    $lesson_exam = \App\Models\UserCurriculumPpExam::where(
                                                        'user_id',
                                                        \Auth::user()->id,
                                                    )
                                                        ->where('curriculum_lesson_id', $lesson->id)
                                                        ->where('exam_type', 'lesson')
                                                        ->first();
                                                    $total_score = empty($lesson_exam) ? 0 : $pretest->total_score;
                                                    $total_question = empty($lesson_exam) ? 0 : $pretest->n_question;
                                                @endphp
                                                <li>
                                                    <strong>{{ $lesson->name }}</strong>

                                                    @if (empty($lesson_exam) || $lesson_exam->total_question < $lesson_exam->n_question)
                                                        <div class="notyet_pass">
                                                            ยังไม่ผ่าน (ยังไม่แล้วเสร็จ)
                                                        </div>
                                                    @elseif($lesson_exam->total_question == $lesson_exam->n_question && $lesson_exam->total_score < $lesson_exam->pass_score)
                                                        <div class="notyet_pass">
                                                            ยังไม่ผ่าน
                                                            {{ number_format($lesson_exam->total_score) }} /
                                                            {{ $lesson_exam->n_question }}
                                                        </div>
                                                    @elseif($lesson_exam->total_question == $lesson_exam->n_question)
                                                        <div class="results_pass">
                                                            <em class="fa fa-check me-2"></em>ผ่าน
                                                            {{ number_format($lesson_exam->total_score) }} /
                                                            {{ $lesson_exam->n_question }}
                                                        </div>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                        <li>
                                            <strong>วัดผลหลังเรียนรู้ (Post-test)</strong>

                                            @if (empty($posttest) || $posttest->total_question < $posttest->n_question)
                                                <div class="notyet_pass">
                                                    ยังไม่ผ่าน (ยังไม่แล้วเสร็จ)
                                                </div>
                                            @elseif($posttest->total_question == $posttest->n_question && $posttest->total_score < $posttest->pass_score)
                                                <div class="notyet_pass">
                                                    ยังไม่ผ่าน
                                                    {{ number_format($posttest->total_score) }} /
                                                    {{ $posttest->n_question }}
                                                </div>
                                            @elseif($posttest->total_question == $posttest->n_question && $posttest->total_score >= $posttest->pass_score)
                                                <div class="results_pass">
                                                    <em class="fa fa-check me-2"></em>ผ่าน
                                                    {{ number_format($posttest->total_score) }} /
                                                    {{ $posttest->n_question }}
                                                </div>
                                            @endif
                                        </li>
                                        <li class="text-center">
                                            {!! Form::open([
                                                'url' => url('elearning/curriculum/' . $curriculum->id . '/reset'),
                                                'method' => 'POST',
                                                'files' => false,
                                                'class' => 'form needs-validation',
                                                'autocomplete' => 'off',
                                            ]) !!}
                                            <button type="submit" class="btn btn-lg btn-danger ms-3 btn-reset-class"
                                                name="btn_reset" value="reset"><i class="fa fa-undo"></i>
                                                เริ่มเรียนใหม่อีกครั้ง</button>
                                            {!! Form::close() !!}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <!-- End tab-content 2 -->

                </div><!-- End Tab-content-->

            </div><!-- ##### End tabs ##### -->



        </div>
        <!--=================== End Content =================-->

    </main>

    @include('layouts.elearning.footer')
    @include('frontend._script')
    @stack('js')
    <script>
        $(document).ready(function() {
            $(".btn-reset-class").click(function(event) {
                event.preventDefault(); // ป้องกันการส่งฟอร์มแบบดั้งเดิม
                Swal.fire({
                    title: 'เริ่มเรียนใหม่อีกครั้ง',
                    text: "คุณแน่ใจหรือไม่ว่าต้องการเริ่มต้นเรียนใหม่อีกครั้ง?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่, ฉันต้องการเริ่มใหม่',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ดำเนินการต่อเมื่อตอบ "ใช่"
                        Swal.fire({
                            title: '...กำลังดำเนินการ...',
                            html: '<img src="{{ asset('images/preload.gif') }}" width="200">',
                            showConfirmButton: false,
                        });
                        $(this).closest('form').submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
