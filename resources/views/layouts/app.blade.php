<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    {{-- <!--     Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Noto+Serif+Thai' rel='stylesheet'>
    <style>
        body {
            font-family: 'Noto Serif Thai' !important;
        }
    </style> --}}

    <!-- Nucleo Icons -->
    <link href="{{ asset('argon/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('argon/assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.1-web/css/all.min.css" rel="stylesheet">
    {{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
    <link href="{{ asset('argon/assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('argon/assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <style>
        body,
        .btn,
        .nav-link,
        .navbar-brand {
            font-size: 110% !important;
        }
    </style>

    <!-- Scripts -->
    {{-- @vite([
        // 'resources/sass/app.scss',
        // 'resources/js/app.js',
    ]) --}}
    @vite([])

    @include('inc._css')
    @stack('css')
</head>

<body class="g-sidenav-show bg-gray-100">
    <div id="app">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <div class="position-absolute w-100 min-height-300 top-0">
            <span class="mask bg-primary opacity-6"></span>
        </div>

        @include('inc._sidebar')

        <main class="main-content position-relative border-radius-lg ">
            @include('inc._header')
            <div class="container-fluid">
                @yield('content')
                @include('inc._footer')
                {{-- @include('inc._theme_config') --}}
            </div>
        </main>
    </div>
    @stack('modal')
    @include('inc._script')
    @stack('js')
    {!! js_notify() !!}
</body>

</html>
