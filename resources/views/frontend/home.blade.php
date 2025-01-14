@extends('layouts.frontend')

@section('content')
    <div class="bg-theme">

        <!--Start Carousel -->
        <div class="container px-0">
            <div id="myCarousel" class="carousel" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>

                    @if (!empty($hilights))
                        @foreach ($hilights as $key => $item)
                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $key + 1 }}" aria-label="Slide {{ $key + 2 }}"></button>
                        @endforeach
                    @endif

                </div>
                <div class="carousel-inner wow fadeInDown">

                    <div class="carousel-item shadow-slide active">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-5 text-center text-lg-start  wow bounceInLeft">
                                <div class="pt-4 pt-lg-4 mt-4 px-3">
                                    <p class="upskill">Upskill & Reskill</p>
                                    <p class="upskill_intro">ความรู้เรื่องโรคติดต่อและภัยสุขภาพในเด็ก</p>
                                    <p class="upskill_intro2">เรียนที่ไหน ตอนไหนก็ได้ สะดวก เข้าถึงง่าย<br>ได้ใบประกาศนียบัตร (e-Certificate)</p>
                                    <a href="#" class="btn btn-yellow rounded-pill">Click</a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5 text-center text-lg-start wow bounceInRight">
                                <img src="{{ asset('html/images/cartoon-1.png') }}" alt="" class="pt-lg-4 element1 mt-3 img-fluid" width="500" height="402">
                            </div>
                        </div>
                    </div>

                    @if (!empty($hilights))
                        @foreach ($hilights as $item)
                            <a href="{{ $item->link }}">
                                <div class="carousel-item shadow-slide">
                                    <div class="row justify-content-center">
                                        <div class="col-12 text-center wow flipInX mt-4">
                                            <img src="{{ Storage::url('uploads/hilight/' . @$item->image) }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <i class="fa-solid fa-chevron-left fa-2x"></i>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <i class="fa-solid fa-chevron-right fa-2x"></i>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!--End Carousel -->

        <div class="shape1"></div>
    </div><!--.bg-theme -->

    <!--########### Start Stat ###########-->
    <div class="bg-stat">
        <div class="container">
            <div class="row">
                <div id="curriculumState" class="carousel" data-bs-ride="carousel">
                    <div class="carousel-indicators">

                        @if (!empty($post_test_curriculum))
                            @foreach ($post_test_curriculum as $pkey => $item)
                                @php
                                    $active = $pkey == 0 ? 'active' : '';
                                @endphp
                                <button type="button" data-bs-target="#curriculumState" class="{{ $active }}" data-bs-slide-to="{{ $pkey }}" aria-label="Slide {{ $pkey }}"></button>
                            @endforeach
                        @endif

                    </div>


                    @push('css')
                        <style>
                            .carousel-item {
                                transition: none !important;
                            }
                        </style>
                    @endpush
                    <div class="carousel-inner">
                        @if ($post_test_curriculum)
                            @foreach ($post_test_curriculum as $pkey => $item)
                                @php
                                    $active = $pkey == 0 ? 'active' : '';
                                @endphp
                                <div class="carousel-item shadow-slide {{ $active }}">
                                    <div class="row">
                                        <div class="col-lg-5 col-xxl-4 text-center position-relative">
                                            <img src="{{ asset('images/certificate.png') }}" alt="" width="380" height="268" class="shadow certificate_thumbnail mx-auto">
                                            <div class="circular"></div>
                                        </div>
                                        <div class="col-lg-7 col-xxl-6 mx-auto align-content-center">
                                            <div class="position-relative pb-2">
                                                <img src="{{ asset('html/images/icon-hat.svg') }}" alt="" class="icon-hat"> <span class="stat-info">ข้อมูลสถิติ</span>
                                            </div>
                                            <p>{{ $item->name }}</p>
                                            @php
                                                $all_post_exam = \App\Models\UserCurriculumExamHistory::where('curriculum_id', $item->id)
                                                    ->whereNotNull('post_date_finished')
                                                    ->count();
                                                $all_post_exam_pass = \App\Models\UserCurriculumExamHistory::where('curriculum_id', $item->id)
                                                    ->whereNotNull('post_date_finished')
                                                    ->where('post_pass_status', 'y')
                                                    ->count();
                                            @endphp
                                            <div class="d-inline-flex align-items-center">
                                                <div class="circular-icon"><img src="{{ asset('html/images/icon-user-computer.svg') }}" alt="" width="65" height="63"></div>
                                                <div class="ms-4">
                                                    <p class="all_tester_count">{{ number_format($all_post_exam, 0) }}</p>
                                                    <p class="all_tester">ผู้ทำแบบทดสอบทั้งหมด</p>
                                                </div>
                                            </div>

                                            <div class="d-inline-flex align-items-center float-xxl-end">
                                                <div class="circular-icon"><img src="{{ asset('html/images/icon-doc-passed.svg') }}" alt="" width="65" height="63"></div>
                                                <div class="ms-4">
                                                    <p class="all_tester_count">{{ number_format($all_post_exam_pass, 0) }}</p>
                                                    <p class="all_tester">ผู้ที่ผ่านแบบทดสอบแล้ว</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-9 mx-auto py-5">
                                            <div class="divider"></div>
                                            <div class="icon-bus float-end"><img src="{{ asset('html/images/icon-bus.svg') }}" alt="" width="96" height="72"></div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>




                    <button class="carousel-control-prev" type="button" data-bs-target="#curriculumState" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" style="background-image: url(data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'><path d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/></svg>);" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#curriculumState" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <!--########### End Stat ###########-->

    <!--########### Start Step ###########-->
    <div class="container">
        <div class="position-relative pb-2 mt-5">
            <img src="{{ asset('html/images/icon-hat.svg') }}" alt="" class="icon-hat"> <span class="stat-info">ขั้นตอนการเรียน e-Learning</span>
        </div>
        <p>เรียนที่ไหน ตอนไหนก็ได้ สะดวก เข้าถึงง่าย ได้ใบประกาศนียบัตร (e-Certificate) เพียง 6 ขั้นตอน</p>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-4 my-5 justify-content-center wow flipInX">

            <div class="col">
                @guest
                    <a href="{{ url('front/register') }}">
                    @endguest
                    <div class="box_step bg_step1">
                        <div class="step-number bg-step-1">
                            <div class="runnumber">1</div>
                        </div>
                        <div class="step-content">
                            <p>ลงทะเบียนเรียน</p>
                            <p class="step_text_eng">Register</p>
                        </div>
                        <div class="line_step1"></div>
                    </div>
                    @guest
                    </a>
                @endguest
            </div>
            <div class="col">
                {{-- <a href="#"> --}}
                <div class="box_step bg_step2">
                    <div class="step-number bg-step-2">
                        <div class="runnumber">2</div>
                    </div>
                    <div class="step-content">
                        <p>ทำแบบทดสอบ ก่อนเรียน</p>
                        <p class="step_text_eng">Pre-Test</p>
                    </div>
                    <div class="line_step2"></div>
                </div>
                {{-- </a> --}}
            </div>
            <div class="col">
                {{-- <a href="#"> --}}
                <div class="box_step bg_step3">
                    <div class="step-number bg-step-3">
                        <div class="runnumber">3</div>
                    </div>
                    <div class="step-content">
                        <p>เรียนรู้บทเรียน</p>
                        <p class="step_text_eng">Learning</p>
                    </div>
                    <div class="line_step3"></div>
                </div>
                {{-- </a> --}}
            </div>
            <div class="col">
                {{-- <a href="#"> --}}
                <div class="box_step bg_step4">
                    <div class="step-number bg-step-4">
                        <div class="runnumber">4</div>
                    </div>
                    <div class="step-content">
                        <p>ทำแบบทดสอบ ท้ายบทเรียน</p>
                        <p class="step_text_eng">Quiz</p>
                    </div>
                    <div class="line_step4"></div>
                </div>
                {{-- </a> --}}
            </div>
            <div class="col">
                {{-- <a href="#"> --}}
                <div class="box_step bg_step5">
                    <div class="step-number bg-step-5">
                        <div class="runnumber">5</div>
                    </div>
                    <div class="step-content">
                        <p>วัดผลหลังเรียนรู้</p>
                        <p class="step_text_eng">Post-Test</p>
                    </div>
                    <div class="line_step5"></div>
                </div>
                {{-- </a> --}}
            </div>
            <div class="col">
                {{-- <a href="#"> --}}
                <div class="box_step bg_step6">
                    <div class="step-number bg-step-6">
                        <div class="runnumber">6</div>
                    </div>
                    <div class="step-content">
                        <p>รับประกาศนียบัตร</p>
                        <p class="step_text_eng">e-certificate</p>
                    </div>
                    <div class="line_step6"></div>
                </div>
                {{-- </a> --}}
            </div>
        </div>
    </div>
    <!--########### End Step ###########-->

    <!--########### Start courses ###########-->
    <div class="container pt-2 pt-lg-5 position-relative pb-5 mb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="position-relative pb-2 my-4 title_courses">
                    <img src="{{ asset('html/images/icon-hat.svg') }}" alt="" class="icon-hat"> <span class="stat-info">หลักสูตร (courses)</span>
                </div>
            </div>
            <div class="col-lg-12 text-center text-lg-end">
                <!--##### Nav tabs #####-->
                <ul class="nav nav-pills tab-class d-inline-flex flex-column flex-sm-row justify-content-lg-end wow bounceInUp fs-4" id="myTab" role="tablist">
                    @foreach ($curriculums as $index => $item)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link d-flex rounded-pill @if ($index === 0) active @endif fs-4" id="courses{{ $item->id }}-tab" data-bs-toggle="tab" data-bs-target="#courses{{ $item->id }}" type="button" role="tab" aria-controls="courses{{ $item->id }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                {{ $item->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!--##### Tab panes ####-->
        <div class="tab-content">
            @foreach ($curriculums as $index => $item)
                <div class="tab-pane @if ($index === 0) wow fadeInDown active @else fade @endif" id="courses{{ $item->id }}" role="tabpanel" aria-labelledby="courses{{ $item->id }}-tab" tabindex="0">
                    <div class="w-100">
                        <div class="title_tab">
                            <a href="{{ url('elearning/curriculum/' . $item->id) }}">
                                <span>บทเรียนที่ {{ $index + 1 }}</span>{{ $item->name }}
                            </a>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center">
                        @foreach ($item->curriculum_lesson as $key => $lesson)
                            <div class="col my-4">
                                <div class="blog-style1 h-100 position-relative">
                                    <div class="blog-img">
                                        <a id="a_lesson_{{ $lesson->id }}" href="{{ url('elearning/curriculum/lesson/' . $lesson->id) }}">
                                            <img src="{{ Storage::url('uploads/curriculum_lesson/' . @$lesson->cover_image) }}" alt="" class="img-fluid w-100">
                                        </a>
                                    </div>
                                    <div class="blog-content">
                                        <span class="lesson"><img src="{{ asset('html/images/bulb.svg') }}" alt="" width="24"> หัวข้อที่ {{ $key + 1 }}</span>
                                        <h3 class="blog-title h5">
                                            <a id="a_lesson_{{ $lesson->id }}" href="{{ url('elearning/curriculum/lesson/' . $lesson->id) }}">
                                                {{ $lesson->name }}
                                            </a>
                                        </h3>
                                        <p>{{ $lesson->description }}</p>
                                    </div>
                                    <a href="{{ url('elearning/curriculum/lesson/' . $lesson->id) }}" class="blog-btn position-absolute bottom-0">เข้าสู่บทเรียน <em class="fa fa-angle-right"></em></a>
                                </div>
                            </div>
                        @endforeach
                        <div class="w-100 d-flex justify-content-center">
                            <a class="viewall" href="{{ url('elearning/index') }}">ดูทั้งหมด</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="icon_star"><img src="{{ asset('html/images/icon_star.svg') }}" alt="" width="90"></div>
        <div class="icon_slide"><img src="{{ asset('html/images/icon_slide.svg') }}" alt="" width="80"></div>
    </div>
    <!--########### End courses ###########-->

    <!--########### Start FAQ ###########-->
    <div class="container position-relative">
        <div class="icon_book"><img src="{{ asset('html/images/icon_book.svg') }}" alt="" width="80"></div>
        <div class="position-relative pb-2 my-4">
            <img src="{{ asset('html/images/icon-hat.svg') }}" alt="" class="icon-hat"> <span class="stat-info">คำถามที่พบบ่อย</span>
        </div>
        <div class="row my-4">
            <div class="accordion accordion-style1 wow rotateInDownLeft" id="accordionExample">
                @if (!empty(@$faqs))
                    @foreach (@$faqs as $key => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button @if ($key != 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $key }}" aria-expanded="@if ($key == 0) true @else false @endif" aria-controls="collapse_{{ $key }}">
                                    {{ @$item->question }}
                                </button>
                            </h2>
                            <div id="collapse_{{ $key }}" class="accordion-collapse collapse @if ($key == 0) show @endif" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! nl2br(e(@$item->answer)) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!--########### End FAQ ###########-->
@endsection
