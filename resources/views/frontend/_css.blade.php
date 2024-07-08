<link href="{{ asset('html/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('html/css/animate.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('html/css/all.min.css') }}" />

<!-- Styles for this template -->
<link href="{{ asset('html/css/style.css') }}?v={{ time() }}" rel="stylesheet">
<link href="{{ asset('html/css/custom.css') }}?v={{ time() }}" rel="stylesheet">

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 Bootstrap 5 Theme CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    .select2-container .select2-selection--single {
        height: calc(1.5em + 1rem + 2px) !important;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.5rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 2.5 !important;
        /* Adjust this value if needed */
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(1.5em + 1rem + 2px) !important;
    }

    .page-content img {
        max-width: 100%;
        height: auto;
    }

    .blog-style1 {
        position: relative;
        padding-bottom: 2.5rem;
        /* เพิ่มระยะห่างด้านล่างสำหรับปุ่ม */
    }

    .blog-btn {
        position: absolute;
        /* bottom: 1rem; */
        /* ระยะห่างจากด้านล่าง */
        left: 50%;
        transform: translateX(-50%);
    }
</style>

<!-- Animate.css CDN -->
@if (!request()->routeIs('home'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endif
