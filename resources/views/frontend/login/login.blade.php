@extends('layouts.frontend')

@section('page', 'เข้าสู่ระบบ')

@section('content')
    <!--====================================================
                =                      CONTENT                         =
                =====================================================-->
    <div class="container wow fadeInDown">
        <div class="title-login">เข้าสู่ระบบ</div>
        <form class="row g-4 my-4 justify-content-center">
            <div class="col-lg-6 align-self-center">
                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="username" id="form3Example3" class="form-control form-control-md" placeholder="Username" />
                    <label class="form-label sr-only" for="form3Example3">Username</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <input type="password" id="form3Example4" class="form-control form-control-md" placeholder="password" />
                    <label class="form-label sr-only" for="form3Example4">Password</label>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                        <label class="form-check-label" for="form2Example3">
                            จำรหัสผ่าน
                        </label>
                    </div>
                    <a href="#!" class="text-body">ลืมรหัสผ่าน?</a>
                </div>

                <!-- agree to the Terms & Policy -->
                <div class="form-check mb-0 mt-2">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example4" />
                    <label class="form-check-label" for="form2Example4">
                        ยอมรับใน<a href="#">ข้อกำหนดและนโยบาย</a>
                    </label>
                </div>

                <!-- Submit button -->
                <div class="text-center text-lg-start mt-4 pt-2">
                    <a href="index.html" type="button" class="btn btn-primary btn-md shadow rounded-pill btn-login-form" style="padding-left: 2.5rem; padding-right: 2.5rem;">เข้าสู่ระบบ</a>
                    <p class="small fw-bold mt-2 pt-3 mb-0">ยังไม่เป็นสมาชิก? <a href="{{ url('register') }}" class="link-danger">สมัครสมาชิก</a></p>
                </div>

                <div class="divider2 d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 text-muted">หรือ เข้าสู่ระบบด้วย</p>
                </div>

                <div class="d-flex justify-content-center">
                    <a class="btn btn-md btn-block px-5 rounded-4 btn-line" href="{{ url('login/line') }}" role="button">
                        <em class="fab fa-line me-2"></em> Line
                    </a>
                    <a class="btn btn-md btn-block px-5 ms-3 rounded-4 btn-google" href="{{ url('login/google') }}" role="button">
                        <em class="fab fa-google me-2"></em> google
                    </a>
                </div>

            </div>
        </form>
    </div>
    <!--=================== End Content =================-->
@endsection
