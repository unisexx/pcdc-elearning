<div class="bg-theme">
    <header>
        <div class="container">
            <div class="row wow fadeInDown g-0">
                <div class="col-lg-6 d-flex justify-content-center justify-content-sm-start align-items-center py-2">
                    <!-- logo -->
                    <div class="d-block d-sm-flex text-center">
                        <img src="{{ asset('html/images/logo_pcdc.svg') }}" class="logo_pcdc me-2" alt="logo pcdc">
                        <img src="{{ asset('html/images/logo_ddc_moph2.svg') }}" class="logo ms-2" alt="logo กรมควบคุมโรค">
                        <a href="{{ url('home') }}" class="d-table mt-2">
                            <div class="organization_name"><span class="text-e">e</span>-learning</div>
                            <div class="organization_name2">โรคติดต่อในเด็กและโควิด 19</div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-end align-items-center py-2">
                    @auth
                        <div class="dropdown">
                            <button class="btn rounded-pill btn-yellow dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                ยินดีต้อนรับ {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ url('elearning/history')}}" data-bs-toggle="popover" data-bs-content="ข้อมูลและประวัติการเรียน"><i class="fas fa-clock"></i> ข้อมูลและประวัติการเรียน</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit', ['user' => Auth::user()->id]) }}" data-bs-toggle="popover" data-bs-content="แก้ไขข้อมูลส่วนตัว"><i class="fas fa-edit"></i> แก้ไขข้อมูลส่วนตัว</a></li>
                                <li><a class="dropdown-item" href="{{ route('change_password.edit', ['user' => Auth::user()->id]) }}" data-bs-toggle="popover" data-bs-content="เปลี่ยนรหัสผ่าน"><i class="fas fa-key"></i> เปลี่ยนรหัสผ่าน</a></li>
                                <li><a class="dropdown-item" href="{{ url('front/logout') }}" data-bs-toggle="popover" data-bs-content="ออกจากระบบ"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a></li>
                            </ul>
                        </div>
                        <style>
                            .dropdown-item {
                                color: #5a6268;
                                /* สีเทาสำหรับข้อความ */
                            }

                            .dropdown-item i {
                                margin-right: 10px;
                                color: #5a6268;
                                /* สีเทาสำหรับไอคอน */
                            }

                            .dropdown-item:hover {
                                color: #444;
                                /* สีเทาเข้มเมื่อ hover */
                            }

                            .btn-yellow:hover,
                            .btn-yellow.show {
                                background: linear-gradient(45deg, #ffeb3b, #ffd600);
                                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
                            }

                            .dropdown-item:focus,
                            .dropdown-item.active {
                                background-color: #ffeb3b;
                                /* สีเหลืองเมื่อถูกคลิก */
                                color: #212529;
                                /* สีข้อความเมื่อถูกคลิก */
                            }
                        </style>
                    @else
                        <div class="btn btn-red rounded-pill text-white">
                            <a id="loginBtn" href="#">เข้าสู่ระบบ</a>
                        </div>
                        <div class="btn btn-red rounded-pill text-white ms-2">
                            <a href="{{ url('front/register') }}">สมัครสมาชิก</a>
                        </div>
                    @endauth
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
                                    <a class="nav-link active text-nowrap" aria-current="page" href="{{ url('home') }}">หน้าแรก</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('stat') }}">ข้อมูลสถิติ</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('elearning-steps') }}">ขั้นตอนการเรียน e-learning</a></li>                               
                                @if(\Auth::user())
                                @php
                                $curriculum_menu = \App\Models\Curriculum::where('status','active')
                                                ->where(function($q) {
                                                        if(Auth::user()->is_admin!='1'){
                                                            $q->whereHas('curriculum_user_type', function ($q) {
                                                                $q->where('user_type_id', Auth::user()->user_type_id);
                                                            });
                                                        }
                                                })
                                                ->orderBy('pos','asc')->get();
                                @endphp
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="courses.html" data-bs-toggle="dropdown" data-bs-auto-close="outside">หลักสูตร</a>
                                    <ul class="dropdown-menu shadow">
                                        @foreach($curriculum_menu as $curriculum_menu)
                                        @php
                                            $url = env('CURRICULUM_CONTINUE') ? url("elearning/curriculum/".$curriculum_menu->id.'/continue') : url("elearning/curriculum/".$curriculum_menu->id);
                                        @endphp
                                        <li><a class="dropdown-item" href="{{ $url }}">{{ $curriculum_menu->name }}</a></li>
                                        @endforeach                                        
                                    </ul>
                                </li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="CurriculumLoginMenu" class="nav-link dropdown-toggle" href="#">หลักสูตร</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('faq') }}">คำถามที่พบบ่อย</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('contact') }}">ติดต่อ</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                {{-- <div class="col-lg-1 ms-auto search_md">

                    <div class="search-input-box">
                        <input type="text" placeholder="ค้นหา">
                        <span class="icon">
                            <i class="fa fa-search search-icon"></i>
                        </span>
                        <i class="fa fa-times close-icon"></i>
                    </div>

                </div> --}}
            </div>
        </div>
    </header>
</div>

@push('js')
    @guest
        <script>
            document.getElementById('CurriculumLoginMenu').addEventListener('click', function() {
                Swal.fire({
                    title: 'เข้าสู่ระบบ',
                    html: `
        <form id="loginForm" class="g-4 my-4 justify-content-center">
            <div class="col-lg-12 align-self-center">
                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="text" id="email" name="email" class="form-control form-control-md" placeholder="Username" />
                    <label class="form-label sr-only" for="email">Email</label>
                </div>
                <!-- Password input -->
                <div class="form-outline mb-3">
                    <input type="password" id="password" name="password" class="form-control form-control-md" placeholder="Password" />
                    <label class="form-label sr-only" for="password">Password</label>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" value="" id="remember" name="remember" />
                        <label class="form-check-label" for="remember">จำรหัสผ่าน</label>
                    </div>
                    <a href="#!" class="text-body">ลืมรหัสผ่าน?</a>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <!-- agree to the Terms & Policy -->
                    <div class="form-check mb-0 mt-2">
                        <input class="form-check-input me-2" type="checkbox" value="1" id="terms" name="terms" />
                        <label class="form-check-label" for="terms">ยอมรับใน <a href="{{ url('/privacy-policy') }}">ข้อกำหนดและนโยบาย</a></label>
                    </div>
                </div>
                </div>
                <div class="text-center text-lg-start mt-4 pt-2 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-md shadow rounded-pill btn-login-form" style="padding-left: 2.5rem; padding-right: 2.5rem;">เข้าสู่ระบบ</button>
                </div>
                <div>
                    <p class="small fw-bold mt-2 pt-3 mb-0">ยังไม่เป็นสมาชิก? <a href="{{ url('/front/register') }}" class="link-danger">สมัครสมาชิก</a></p>
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
    `,
                    showConfirmButton: false,
                    didOpen: () => {
                        const loginForm = document.getElementById('loginForm');
                        loginForm.addEventListener('submit', function(e) {
                            e.preventDefault();

                            const email = document.getElementById('email').value;
                            const password = document.getElementById('password').value;
                            const remember = document.getElementById('remember').checked;
                            const terms = document.getElementById('terms').checked;

                            if (!email || !password) {
                                Swal.showValidationMessage('กรุณากรอกอีเมล์และรหัสผ่าน');
                                return;
                            } else if (!terms) {
                                Swal.showValidationMessage('กรุณายอมรับข้อกำหนดและนโยบาย');
                                return;
                            }

                            const formData = new FormData(loginForm);
                            fetch('{{ route('front.login') }}', {
                                    method: 'POST', // เปลี่ยนเป็น POST
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire('เข้าสู่ระบบสำเร็จ', '', 'success');
                                        // รีเฟรชหน้าเว็บหรือนำทางไปยังหน้าหลัก
                                        window.location.href = '{{ url('home') }}';
                                    } else {
                                        Swal.fire('เข้าสู่ระบบไม่สำเร็จ', data.message, 'error');
                                    }
                                }).catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire('เกิดข้อผิดพลาด', error.toString(), 'error');
                                });
                        });
                    }
                });
            });
        </script>
        <script>
            document.getElementById('loginBtn').addEventListener('click', function() {
                Swal.fire({
                    title: 'เข้าสู่ระบบ',
                    html: `
            <form id="loginForm" class="g-4 my-4 justify-content-center">
                <div class="col-lg-12 align-self-center">
                    <!-- Username input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="email" name="email" class="form-control form-control-md" placeholder="Username" />
                        <label class="form-label sr-only" for="email">Email</label>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input type="password" id="password" name="password" class="form-control form-control-md" placeholder="Password" />
                        <label class="form-label sr-only" for="password">Password</label>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                            <input class="form-check-input me-2" type="checkbox" value="" id="remember" name="remember" />
                            <label class="form-check-label" for="remember">จำรหัสผ่าน</label>
                        </div>
                        <a href="#!" class="text-body">ลืมรหัสผ่าน?</a>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- agree to the Terms & Policy -->
                        <div class="form-check mb-0 mt-2">
                            <input class="form-check-input me-2" type="checkbox" value="1" id="terms" name="terms" />
                            <label class="form-check-label" for="terms">ยอมรับใน <a href="{{ url('/privacy-policy') }}">ข้อกำหนดและนโยบาย</a></label>
                        </div>
                    </div>
                    </div>
                    <div class="text-center text-lg-start mt-4 pt-2 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-md shadow rounded-pill btn-login-form" style="padding-left: 2.5rem; padding-right: 2.5rem;">เข้าสู่ระบบ</button>
                    </div>
                    <div>
                        <p class="small fw-bold mt-2 pt-3 mb-0">ยังไม่เป็นสมาชิก? <a href="{{ url('/front/register') }}" class="link-danger">สมัครสมาชิก</a></p>
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
        `,
                    showConfirmButton: false,
                    didOpen: () => {
                        const loginForm = document.getElementById('loginForm');
                        loginForm.addEventListener('submit', function(e) {
                            e.preventDefault();

                            const email = document.getElementById('email').value;
                            const password = document.getElementById('password').value;
                            const remember = document.getElementById('remember').checked;
                            const terms = document.getElementById('terms').checked;

                            if (!email || !password) {
                                Swal.showValidationMessage('กรุณากรอกอีเมล์และรหัสผ่าน');
                                return;
                            } else if (!terms) {
                                Swal.showValidationMessage('กรุณายอมรับข้อกำหนดและนโยบาย');
                                return;
                            }

                            const formData = new FormData(loginForm);
                            fetch('{{ route('front.login') }}', {
                                    method: 'POST', // เปลี่ยนเป็น POST
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire('เข้าสู่ระบบสำเร็จ', '', 'success');
                                        // รีเฟรชหน้าเว็บหรือนำทางไปยังหน้าหลัก
                                        window.location.href = '{{ url('home') }}';
                                    } else {
                                        Swal.fire('เข้าสู่ระบบไม่สำเร็จ', data.message, 'error');
                                    }
                                }).catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire('เกิดข้อผิดพลาด', error.toString(), 'error');
                                });
                        });
                    }
                });
            });
        </script>
    @endguest
@endpush
