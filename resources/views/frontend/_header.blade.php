<div class="bg-theme">
    <header>
        <div class="container">
            <div class="row wow fadeInDown g-0">
                <div class="col-lg-6 d-flex justify-content-center justify-content-sm-start align-items-center py-2">
                    <!-- logo -->
                    <div class="d-block d-sm-flex text-center">
                        <img src="{{ asset('html/images/logo_pcdc.svg') }}" class="logo_pcdc me-2" alt="logo pcdc">
                        <img src="{{ asset('html/images/logo_ddc_moph2.svg') }}" class="logo ms-2" alt="logo กรมควบคุมโรค">
                        <a href="index.html" class="d-table mt-2">
                            <div class="organization_name"><span class="text-e">e</span>-learning</div>
                            <div class="organization_name2">โรคติดต่อในเด็กและโควิด 19</div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-end align-items-center py-2">
                    <div class="btn btn-red rounded-pill text-white">
                        <a href="login.html">เข้าสู่ระบบ</a> /
                        <a href="register.html">สมัครสมาชิก</a>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInDown bg_menu rounded-pill">
                <div class="col-lg-8 ms-3">
                    <!--========================================
                =            Navigation Section            =
                =========================================-->
                    <nav class="navbar navbar-expand-lg wow fadeInDown position-relative">
                        <button class="navbar-toggler ms-auto menu-hamburger" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbar-content">
                            <ul class="navbar-nav nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 topmenu">
                                <li class="nav-item">
                                    <a class="nav-link active text-nowrap" aria-current="page" href="index.html">หน้าแรก</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="stat-info.html">ข้อมูลสถิติ</a></li>
                                <li class="nav-item"><a class="nav-link" href="e-learning.html">ขั้นตอนการเรียน e-learning</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="courses.html" data-bs-toggle="dropdown" data-bs-auto-close="outside">หลักสูตร</a>
                                    <ul class="dropdown-menu shadow">
                                        <li><a class="dropdown-item" href="courses-1.html">หลักสูตร 1</a></li>
                                        <li><a class="dropdown-item" href="courses-2.html">หลักสูตร 2</a></li>
                                        <li class="dropend">
                                            <a href="courses-3.html" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown">หลักสูตร 3</a>
                                            <ul class="dropdown-menu shadow">
                                                <li><a class="dropdown-item" href="courses-3-1.html">หลักสูตร 3.1</a></li>
                                                <li><a class="dropdown-item" href="courses-3-2.html">หลักสูตร 3.2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="faq.html">คำถามที่พบบ่อย</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">ติดต่อ</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-1 ms-auto search_md">

                    <div class="search-input-box">
                        <input type="text" placeholder="ค้นหา">
                        <span class="icon">
                            <i class="fa fa-search search-icon"></i>
                        </span>
                        <i class="fa fa-times close-icon"></i>
                    </div>

                </div>
            </div>
        </div>
    </header>
</div>
