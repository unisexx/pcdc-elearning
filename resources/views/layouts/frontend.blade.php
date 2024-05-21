<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.name', 'Laravel') }}">
    <meta name="author" content="{{ config('app.name', 'Laravel') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('html/images/favicon.svg') }}" type="image/x-icon" />

    <link href="{{ asset('html/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('html/css/animate.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('html/css/all.min.css') }}" />

    <!-- Styles for this template -->
    <link href="{{ asset('html/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('html/css/custom.css') }}" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 Bootstrap 5 Theme CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            font-family: "Sarabun", sans-serif;
        }

        .select2-container .select2-selection--multiple {
            font-family: "Sarabun", sans-serif;
        }

        .select2-dropdown {
            font-family: "Sarabun", sans-serif;
        }
    </style>

    <!-- Scripts -->
    {{-- @vite([
        // 'resources/sass/app.scss',
        // 'resources/js/app.js',
    ]) --}}
    {{-- @vite([]) --}}
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('html/js/bootstrap.bundle.min.js') }}"></script>
    <!-- JS Animate -->
    <script src="{{ asset('html/js/wow.min.js') }}"></script>
    <script>
        new WOW().init();
    </script>
    <script>
        let inputBox = document.querySelector(".search-input-box"),
            searchIcon = document.querySelector(".icon"),
            closeIcon = document.querySelector(".close-icon");

        searchIcon.addEventListener("click", () => inputBox.classList.add("open"));
        closeIcon.addEventListener("click", () => inputBox.classList.remove("open"));
    </script>

    <script>
        // Get the button GO TO TOP
        let mybutton = document.getElementById("myBtn");

        // When the user scrolls down 200px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('js')
</body>

</html>
