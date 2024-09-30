@extends('layouts.frontend')

@section('page', 'ขั้นตอนการเรียน e-learning')

@section('content')
    <!--====================================================
                                    =                      CONTENT                         =
                                    =====================================================-->
    <div class="container-fluid bg_e_learning py-5">

        <!--########## START STEP ##########-->
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-auto d-flex flex-column align-items-center position-relative wrap_title_elearning wow fadeInRightBig">
                    <div class="icon-saturn"><img src="{{ asset('html/images/saturn.svg') }}" alt="" class="rotate-25"></div>
                    <div class="title-content">ขั้นตอนการเรียน <span class="e-learning-text">e-learning</span></div>
                    <p class="e-learning-p">เรียนที่ไหน ตอนไหนก็ได้ สะดวก เข้าถึงง่าย ได้ใบประกาศนียบัตร (e-Certificate) เพียง 6 ขั้นตอน</p>
                    <div class="icon-abc"><img src="{{ asset('html/images/abc.svg') }}" alt="" class="rotate-25"></div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="main-timeline">
                        <div class="timeline wow bounceIn">
                            <a href="#" class="timeline-content">
                                <h3 class="title">ขั้นตอนที่ 1</h3>
                                <div class="title_step_learning2">ลงทะเบียนเรียน <span>Register</span></div>
                                <p class="description">ก่อนเริ่มเรียนต้องทำการสมัครสมาชิกและเข้าสู่ระบบก่อน สมาชิกเก่า ล็อกอินเข้าสู่ระบบด้วยบัญชีเดิม</p>
                            </a>
                        </div>
                        <div class="timeline wow bounceIn">
                            <a href="#" class="timeline-content">
                                <h3 class="title">ขั้นตอนที่ 2</h3>
                                <div class="title_step_learning2">ทำแบบทดสอบ ก่อนเรียน <span>Pre-Test</span></div>
                                <p class="description">เริ่มทำแบบทดสอบก่อนเรียน (ทำข้อสอบทีละบทเรียน) จำนวนข้อสอบ 5-10 ข้อ คะแนนเต็ม 10 คะแนน</p>
                            </a>
                        </div>
                        <div class="timeline wow bounceIn">
                            <a href="#" class="timeline-content">
                                <h3 class="title">ขั้นตอนที่ 3</h3>
                                <div class="title_step_learning2">เรียนรู้บทเรียน <span>Learning</span></div>
                                <p class="description">เริ่มเรียนจากคลิปวิดีโอ เรียนทีละ 1 บทเรียน ระยะเวลาในการเรียนในแต่ละบทเรียน 1-2 ชั่วโมง</p>
                            </a>
                        </div>
                        <div class="timeline wow bounceIn">
                            <a href="#" class="timeline-content">
                                <h3 class="title">ขั้นตอนที่ 4</h3>
                                <div class="title_step_learning2">ทำแบบทดสอบ ท้ายบทเรียน <span>Quiz</span></div>
                                <p class="description">ทำแบบทดสอบหลังเรียนของแต่ละบทเรียนหลังเรียนจบ</p>
                            </a>
                        </div>
                        <div class="timeline wow bounceIn">
                            <a href="#" class="timeline-content">
                                <h3 class="title">ขั้นตอนที่ 5</h3>
                                <div class="title_step_learning2">วัดผลหลังเรียนรู้ <span>Post-Test</span></div>
                                <p class="description">ตรวจสอบคะแนนสอบ ทำได้ 80% ขึ้นไปถึงจะผ่าน</p>
                            </a>
                        </div>
                        <div class="timeline wow bounceIn">
                            <a href="#" class="timeline-content">
                                <h3 class="title">ขั้นตอนที่ 6</h3>
                                <div class="title_step_learning2">รับประกาศนียบัตร <span>e-certificate</span></div>
                                <p class="description">สามารถดาวน์โหลดใบประกาศนียบัตรจากระบบได้ โดยใบประกาศนียบัตรจะมีอายุการรับรองผลการเรียนบทเรียนเป็นเวลา 3 ปี</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--########## End STEP ##########-->

    </div>
    <!--=================== End Content =================-->
@endsection
