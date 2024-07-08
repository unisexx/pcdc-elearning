<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="robots" content="noindex, nofollow">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
