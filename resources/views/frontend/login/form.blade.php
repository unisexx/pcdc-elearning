@extends('layouts.frontend')

@section('page', 'เข้าสู่ระบบ')

@section('content')
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-5 mx-auto">
                <div class="box-contact">
                    {{-- <div class="title-register text-center mb-3">เข้าสู่ระบบ</div> --}}

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <fieldset class="mb-5 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
                        <legend class="title-form w-auto rounded-2">เข้าสู่ระบบ</legend>
                        <div class="row g-3 pt-4">

                            <form action="{{ route('front.login2') }}" method="POST" id="loginForm" class="g-4 my-4 justify-content-center">
                                @csrf
                                <div class="col-lg-12 align-self-center">
                                    <div class="form-outline mb-4">
                                        <input type="text" id="email" name="email" class="form-control form-control-md" placeholder="Email" value="{{ old('email') }}" required />
                                        <label class="form-label sr-only" for="email">Email</label>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="password" id="password" name="password" class="form-control form-control-md" placeholder="Password" required />
                                        <label class="form-label sr-only" for="password">Password</label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input me-2" type="checkbox" value="" id="remember" name="remember" />
                                            <label class="form-check-label" for="remember">จำรหัสผ่าน</label>
                                        </div>
                                        <a href="{{ url('/front/password/forgot') }}" class="text-body">ลืมรหัสผ่าน?</a>
                                    </div>
                                </div>
                                <div class="text-center text-lg-start mt-4 pt-2 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-lg shadow rounded-pill btn-login-form" style="padding-left: 4rem; padding-right: 4rem; font-size: 1.5rem;">
                                        เข้าสู่ระบบ
                                    </button>
                                </div>
                                <div>
                                    <p class="small fw-bold mt-2 pt-3 mb-0 text-center">ยังไม่เป็นสมาชิก? <a href="{{ url('/front/register') }}" class="link-danger">สมัครสมาชิก</a></p>
                                </div>

                                {{-- <div class="divider2 d-flex align-items-center my-4">
                                    <p class="text-center fw-bold mx-3 mb-0 text-muted">หรือ เข้าสู่ระบบด้วย</p>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-md btn-block px-5 rounded-4 btn-line" href="{{ url('login/line') }}" role="button">
                                        <em class="fab fa-line me-2"></em> Line
                                    </a>
                                    <a class="btn btn-md btn-block px-5 ms-3 rounded-4 btn-google" href="{{ url('login/google') }}" role="button">
                                        <em class="fab fa-google me-2"></em> google
                                    </a>
                                </div> --}}
                            </form>

                        </div>
                    </fieldset>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;

            if (!email) {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณากรอกอีเมล',
                    showConfirmButton: true
                });
                event.preventDefault(); // ป้องกันการส่งฟอร์ม
                return;
            }

            if (!password) {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณากรอกรหัสผ่าน',
                    showConfirmButton: true
                });
                event.preventDefault(); // ป้องกันการส่งฟอร์ม
                return;
            }
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>
@endpush
