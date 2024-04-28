<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons -->
    <link href="{{ asset('argon/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('argon/assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('argon/assets/css/argon-dashboard.css') }}" rel="stylesheet" />

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body>
    <div id="app">
        {{-- <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">

                    <div class="container position-sticky z-index-sticky top-0">
                        <div class="row">
                            <div class="col-12">
                                <!-- Navbar -->
                                <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                                    <div class="container-fluid">
                                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ route('home') }}">
                                            Argon Dashboard 2 Laravel
                                        </a>
                                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon mt-2">
                                                <span class="navbar-toggler-bar bar1"></span>
                                                <span class="navbar-toggler-bar bar2"></span>
                                                <span class="navbar-toggler-bar bar3"></span>
                                            </span>
                                        </button>
                                        <div class="collapse navbar-collapse" id="navigation">
                                            <ul class="navbar-nav mx-auto">
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ route('home') }}">
                                                        <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                                                        Dashboard
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link me-2" href="{{ route('register') }}">
                                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                                        Sign Up
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link me-2" href="{{ route('login') }}">
                                                        <i class="fas fa-key opacity-6 text-dark me-1"></i>
                                                        Sign In
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="navbar-nav d-lg-block d-none">
                                                <li class="nav-item">
                                                    <a href="https://www.creative-tim.com/product/argon-dashboard-laravel" target="_blank" class="btn btn-sm mb-0 me-1 btn-primary">Free Download</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                                <!-- End Navbar -->
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div> --}}
        <main class="main-content  mt-0">
            <section>
                <div class="page-header min-vh-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-start">
                                        <h4 class="font-weight-bolder">เข้าสู่ระบบ</h4>
                                        <p class="mb-0">กรอกอีเมล์และรหัสผ่านเพื่อเข้าสู่ระบบ</p>
                                    </div>
                                    <div class="card-body">
                                        <form role="form" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            @method('post')
                                            <div class="flex flex-col mb-3">
                                                <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" aria-label="Email">
                                                @error('email')
                                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="flex flex-col mb-3">
                                                <input type="password" name="password" class="form-control form-control-lg" aria-label="Password" value="secret">
                                                @error('password')
                                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">จดจำ</label>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">เข้าสู่ระบบ</button>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-1 text-sm mx-auto">
                                            ลืมรหัสผ่าน? รีเซ็ตรหัสผ่าน
                                            <a href="{{ route('password.request') }}" class="text-primary text-gradient font-weight-bold">ที่นี่</a>
                                        </p>
                                    </div> --}}
                                    {{-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-4 text-sm mx-auto">
                                            Don't have an account?
                                            <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                                        </p>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('{{ asset('argon/img/login-cover.jpg') }}');
                  background-size: cover;">
                                    <span class="mask bg-gradient-primary opacity-6"></span>
                                    <h4 class="mt-5 text-white font-weight-bolder position-relative">ระบบการเรียนรู้ออนไลน์ <br>ด้านการป้องกันควบคุมโรคติดต่อและภัยสุขภาพในเด็ก</h4>
                                    <p class="text-white position-relative">กองโรคติดต่อทั่วไป กรมควบคุมโรค © 2567</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
