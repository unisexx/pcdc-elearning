@extends('layouts.frontend')

@section('content')
    <div class="bg-theme">

        <!--Start Carousel -->
        <div class="container px-0">
            <div id="myCarousel" class="carousel" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
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

                    @forelse($hilights as $item)
                        <div class="carousel-item shadow-slide">
                            <div class="row justify-content-center">
                                <div class="col-12 text-center wow flipInX mt-4">
                                    <img src="{{ asset('html/images/slide.jpg') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="carousel-item shadow-slide">
                            <div class="row justify-content-center">
                                <div class="col-12 text-center wow flipInX mt-4">
                                    <img src="{{ asset('html/images/slide.jpg') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    @endforelse

                    {{-- <div class="carousel-item shadow-slide">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center wow flipInX mt-4">
                                <img src="{{ asset('html/images/slide.jpg') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item shadow-slide">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-5 text-center text-lg-start wow bounceInLeft">
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
                    </div> --}}
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
    <div class="container">
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
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            ความเสี่ยง (ร้อยละ) ที่เชื้อจะแพร่กระจายจากการติดอยู่บนสิ่งของ
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            เชื้อ COVID-19 สามารถแพร่กระจายผ่านสิ่งของที่แปดเปื้อนเชื้อโรคได้ อยู่ได้นานหลายวันหากไม่มีการทำความสะอาด ยกตัวอย่างอุปกรณ์ต่างๆ ที่ใช้ในที่สาธารณะ เช่น ลูกบิดประตู และมือจับประตู ก๊อกน้ำ ราวจับรถสาธารณะ เป็นต้น นอกจากนี้อาจมีการแปดเปื้อนผ่านมือแล้วจับโทรศัพท์มือถือ หากใช้มือสัมผัสสิ่งของแล้วนำมาแตะบริเวณหน้า หรือหยิบอาหารเข้าปาก สามารถติดเชื้อได้เช่นเดียวกับการสัมผัสเชื้อจากผู้ป่วยโดยตรง จึงควรต้องระมัดระวัง ทำความสะอาดพื้นผิวที่อาจแปดเปื้อนบ่อยๆ และล้างมือบ่อยๆ
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            เชื้อสามารถแพร่กระจายในบริเวณสระว่ายน้ำได้หรือไม่
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            ในปัจจุบันยังไม่มีรายงานการติดเชื้อจากการว่ายน้ำในสระ หรือแหล่งน้ำอื่น แต่ควรหลีกเลี่ยงสระน้ำที่มีผู้คนแออัด
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            ยาสมุนไพร เช่น ฟ้าทะลายโจร สามารถรักษาโรคไวรัสโคโรนา ได้หรือไม่
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            ฟ้าทะลายโจรเป็นยาสมุนไพรที่กรมแพทย์แผนไทยและการแพทย์ทางเลือกแนะนำให้ใช้รักษาหวัด และให้กินทันที ส่วน COVID-19 เป็นเชื้อไวรัสสายพันธ์หนึ่งในกลุ่มโคโรนาไวรัส ไม่ใช่เชื้อไวรัสไข้หวัดใหญ่ ยังไม่เคยมีการนำฟ้าทลายโจรมาทดลองใช้รักษา COVID-19
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                            การล้างมือด้วยน้ำอย่างเดียวสามารถทำลายเชื้อได้หรือไม่
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            การล้างมือเป็นการขจัดสิ่งสกปรกต่างๆ เหงื่อ ไขมัน ที่ออกมาตามธรรมชาติ และลดจำนวนเชื้อโรคที่อาศัยอยู่ชั่วคราวบนมือ การล้างมือด้วยน้ำธรรมดาไม่สามารถทำลายเชื้อได้ การล้างมืออย่างถูกวิธีต้องล้างด้วยสบู่ก้อนหรือสบู่เหลว ใช้เวลาในการฟอกมือนานประมาณ 15-20 วินาที ในกรณีที่ไม่มีสบู่ก้อนหรือสบู่เหลว ขอให้ล้างน้ำสะอาดปริมาณมากๆ นานกว่า 20 วินาที และถูมือให้ทั่วถึง
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                            หน้ากากอนามัย N95 แต่ละรุ่น เช่น 9001 , 8201 มีความแตกต่างกันอย่างไร สามารถป้องกันไวรัสโคโรนา 2019 ได้หรือไม่
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            ประชาชนทั่วไปไม่จำเป็นต้องใช้ หน้ากาก N95 ผู้ที่ไม่มีอาการป่วย สามารถใช้หน้ากากอนามัยแบบผ้า หรือ หน้ากากอนามัยทางการแพทย์ได้ ผู้ที่มีอาการป่วยให้ใช้หน้ากากอนามัย สำหรับหน้ากาก N95 ที่ใช้ในการแพทย์ แนะนำให้ใช้เฉพาะกับบุคลากรที่ต้องปฏิบัติงานกับผู้ติดเชื้อหรือสงสัยติดเชื้อ COVID-19
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--########### End FAQ ###########-->
@endsection
