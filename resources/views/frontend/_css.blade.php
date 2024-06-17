<link href="{{ asset('html/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('html/css/animate.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

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
</style>

<!-- Animate.css CDN -->
@if (!request()->routeIs('home'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endif
