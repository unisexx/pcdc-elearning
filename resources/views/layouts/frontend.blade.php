<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- ถ้าขึ้น production ของจริงแล้วให้เอา robots ออก --}}
    <meta name="robots" content="noindex, nofollow">
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.name', 'Laravel') }}">
    <meta name="author" content="{{ config('app.name', 'Laravel') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('html/images/favicon.svg') }}" type="image/x-icon" />
    <!-- Scripts -->
    {{-- @vite([
        // 'resources/sass/app.scss',
        // 'resources/js/app.js',
    ]) --}}
    {{-- @vite([]) --}}
    @include('frontend._css')
    @stack('css')
</head>

<body>
    @include('frontend._header')

    {{-- Title Page กับ breadcrumb แสดงทุกหน้าที่ไม่ใช่หน้าแรก --}}
    @if (!request()->routeIs('home'))
        <div class="bg-theme">
            <div class="container">
                <div class="title-page py-5 px-4">@yield('page')</div>
            </div>

            {{-- Floating Clouds --}}
            <div id="background-wrap">
                <div class="x1">
                    <div class="cloud cloud1"></div>
                </div>
                <div class="x2">
                    <div class="cloud cloud4"></div>
                </div>
                {{-- <div class="x3">
                    <div class="cloud cloud1"></div>
                </div> --}}
            </div>
            {{-- Floating Clouds --}}
            <div class="shape1"></div>
        </div>
        <div class="container">
            <nav class="breadcrumb-line" aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-end mb-3">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">หน้าแรก</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('page')</li>
                </ol>
            </nav>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('frontend._footer')
    @include('frontend._script')
    @stack('js')
</body>

</html>
