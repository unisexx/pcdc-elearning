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
                                    <p class="upskill_intro">ความรู้เรื่องโรคติดต่อในเด็กและโรคโควิด 19</p>
                                    <p class="upskill_intro2">เรียนที่ไหน ตอนไหนก็ได้ สะดวก เข้าถึงง่าย<br>ได้ใบประกาศนียบัตร (e-Certificate)</p>
                                    <a href="#" class="btn btn-yellow rounded-pill">Click</a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5 text-center text-lg-start wow bounceInRight">
                                <img src="{{ asset('html/images/girl-1.png') }}" alt="" class="pt-lg-4 element1 mt-3 img-fluid" width="500" height="402">
                            </div>
                        </div>
                    </div>

                    @if (!empty($hilights))
                        @foreach ($hilights as $item)
                            <div class="carousel-item shadow-slide">
                                <div class="row justify-content-center">
                                    <div class="col-12 text-center wow flipInX mt-4">
                                        <img src="{{ Storage::url('uploads/hilight/' . @$item->image) }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
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
                <div class="col-lg-5 col-xxl-4 text-center position-relative">
                    <img src="{{ asset('html/images/certificate_thumbnail.jpg') }}" alt="" width="380" height="268" class="wow bounce shadow certificate_thumbnail mx-auto">
                    <div class="circular"></div>
                </div>
                <div class="col-lg-7 col-xxl-6 mx-auto align-content-center wow flash">
                    <div class="position-relative pb-2">
                        <img src="{{ asset('html/images/icon-hat.svg') }}" alt="" class="icon-hat"> <span class="stat-info">ข้อมูลสถิติ</span>
                    </div>
                    <p>สถิติผู้ทำแบบทดสอบ และผู้ที่ผ่านแบบทดสอบ e-Learning โรคติดต่อในเด็กและโควิด 19</p>

                    <div class="d-inline-flex align-items-center">
                        <div class="circular-icon"><img src="{{ asset('html/images/icon-user-computer.svg') }}" alt="" width="65" height="63"></div>
                        <div class="ms-4">
                            <p class="all_tester_count">6,240</p>
                            <p class="all_tester">ผู้ทำแบบทดสอบทั้งหมด</p>
                        </div>
                    </div>

                    <div class="d-inline-flex align-items-center float-xxl-end">
                        <div class="circular-icon"><img src="{{ asset('html/images/icon-doc-passed.svg') }}" alt="" width="65" height="63"></div>
                        <div class="ms-4">
                            <p class="all_tester_count">5,133</p>
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
    </div>
    <!--########### End Stat ###########-->

    <!--########### Start Step ###########-->
    <div id="learning-step" class="container">
        <div class="position-relative pb-2 mt-5">
            <img src="{{ asset('html/images/icon-hat.svg') }}" alt="" class="icon-hat"> <span class="stat-info">ขั้นตอนการเรียน e-learning</span>
        </div>
        <p>เรียนที่ไหน ตอนไหนก็ได้ สะดวก เข้าถึงง่าย ได้ใบประกาศนียบัตร (e-Certificate) เพียง 6 ขั้นตอน</p>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-4 my-5 justify-content-center wow flipInX">

            <div class="col position-relative">
                <a href="register.html">
                    <div class="step bg1">
                        <div class="step_icon icon1">1</div>
                        <div class="box_textstep">
                            <div class="text_step">ลงทะเบียนเรียน</div>
                            <div class="text2_step">Register</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col position-relative">
                <div class="step bg2">
                    <div class="step_icon icon2">2</div>
                    <div class="box_textstep">
                        <div class="text_step">ทำแบบทดสอบ ก่อนเรียน</div>
                        <div class="text2_step">Pre-test</div>
                    </div>
                </div>
            </div>
            <div class="col position-relative">
                <div class="step bg3">
                    <div class="step_icon icon3">3</div>
                    <div class="box_textstep">
                        <div class="text_step">เรียนรู้บทเรียน</div>
                        <div class="text2_step">Learning</div>
                    </div>
                </div>
            </div>
            <div class="col position-relative">
                <div class="step bg4">
                    <div class="step_icon icon4">4</div>
                    <div class="box_textstep">
                        <div class="text_step">ทำแบบทดสอบ ท้ายบทเรียน</div>
                        <div class="text2_step">Quiz</div>
                    </div>
                </div>
            </div>
            <div class="col position-relative">
                <div class="step bg5">
                    <div class="step_icon icon5">5</div>
                    <div class="box_textstep">
                        <div class="text_step">วัดผลหลังเรียนรู้</div>
                        <div class="text2_step">Post-test</div>
                    </div>
                </div>
            </div>
            <div class="col position-relative">
                <div class="step bg6">
                    <div class="step_icon icon6">6</div>
                    <div class="box_textstep">
                        <div class="text_step">รับประกาศนียบัตร</div>
                        <div class="text2_step">e-certificate</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--########### End Step ###########-->

    <!--########### Start courses ###########-->
    <div class="container pt-2 pt-lg-5 position-relative">
        <div class="position-relative pb-2 my-4">
            <img src="{{ asset('html/images/icon-hat.svg') }}" alt="" class="icon-hat"> <span class="stat-info">หลักสูตร (courses)</span>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center wow fadeInDown">
            <div class="col my-4">
                <div class="blog-style1">
                    <div class="blog-img">
                        <a href="#"><img src="{{ asset('html/images/pic1_courses.jpg') }}" alt="" class="img-fluid w-100"></a>
                    </div>
                    <div class="blog-content">
                        <span class="lesson"><img src="{{ asset('html/images/bulb.svg') }}" alt="" width="24"> บทเรียนที่ 1</span>
                        <h3 class="blog-title h5"><a href="#">การเกิดโรค</a></h3>
                        <p>มีแบบทดสอบท้ายบท 10 ข้อ</p>
                    </div>
                    <a href="#" class="blog-btn">เข้าสู่บทเรียน <em class="fa fa-angle-right"></em></a>
                </div>
            </div>
            <div class="col my-4">
                <div class="blog-style1">
                    <div class="blog-img">
                        <a href="#"><img src="{{ asset('html/images/pic2_courses.jpg') }}" alt="" class="img-fluid w-100"></a>
                    </div>
                    <div class="blog-content">
                        <span class="lesson"><img src="{{ asset('html/images/bulb.svg') }}" alt="" width="24"> บทเรียนที่ 2</span>
                        <h3 class="blog-title h5"><a href="#">โรคติดต่อที่พบบ่อยในเด็ก</a></h3>
                        <p>มีแบบทดสอบท้ายบท 10 ข้อ</p>
                    </div>
                    <a href="#" class="blog-btn">เข้าสู่บทเรียน <em class="fa fa-angle-right"></em></a>
                </div>
            </div>
            <div class="col my-4">
                <div class="blog-style1">
                    <div class="blog-img">
                        <a href="#"><img src="{{ asset('html/images/pic3_courses.jpg') }}" alt="" class="img-fluid w-100"></a>
                    </div>
                    <div class="blog-content">
                        <span class="lesson"><img src="{{ asset('html/images/bulb.svg') }}" alt="" width="24"> บทเรียนที่ 3</span>
                        <h3 class="blog-title h5"><a href="#">การป้องกันควบคุมโรคติดต่อ</a></h3>
                        <p>มีแบบทดสอบท้ายบท 10 ข้อ</p>
                    </div>
                    <a href="#" class="blog-btn">เข้าสู่บทเรียน <em class="fa fa-angle-right"></em></a>
                </div>
            </div>
            <div class="col my-4">
                <div class="blog-style1">
                    <div class="blog-img">
                        <a href="#"><img src="{{ asset('html/images/pic4_courses.jpg') }}" alt="" class="img-fluid w-100"></a>
                    </div>
                    <div class="blog-content">
                        <span class="lesson"><img src="{{ asset('html/images/bulb.svg') }}" alt="" width="24"> บทเรียนที่ 4</span>
                        <h3 class="blog-title h5"><a href="#">แนวปฏิบัติการเฝ้าระวังป้องกัน ควบคุมโรคติดเชื้อไวรัส โคโรนา 2019 (Covid-19) ในสถานศึกษา</a></h3>
                        <p>มีแบบทดสอบท้ายบท 10 ข้อ</p>
                    </div>
                    <a href="#" class="blog-btn">เข้าสู่บทเรียน <em class="fa fa-angle-right"></em></a>
                </div>
            </div>
            <div class="col my-4">
                <div class="blog-style1">
                    <div class="blog-img">
                        <a href="#"><img src="{{ asset('html/images/pic5_courses.jpg') }}" alt="" class="img-fluid w-100"></a>
                    </div>
                    <div class="blog-content">
                        <span class="lesson"><img src="{{ asset('html/images/bulb.svg') }}" alt="" width="24"> บทเรียนที่ 5</span>
                        <h3 class="blog-title h5"><a href="#">การดูแลเด็กป่วยเบื้องต้น</a></h3>
                        <p>มีแบบทดสอบท้ายบท 10 ข้อ</p>
                    </div>
                    <a href="#" class="blog-btn">เข้าสู่บทเรียน <em class="fa fa-angle-right"></em></a>
                </div>
            </div>
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
                                    {{ @$item->answer }}
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
