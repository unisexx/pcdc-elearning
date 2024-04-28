<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Buttons</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>
    @if (Auth::check())
        <a href="{{ url('test/logout') }}">Logout</a>
    @else
        <div class="container mt-5">
            <div class="row">
                {{-- <div class="col-md-4">
                <a href="{{ url('login/facebook') }}" class="btn btn-primary d-block w-100 mb-3">Login with Facebook</a>
            </div> --}}
                <div class="col-md-4">
                    <a href="{{ url('login/line') }}" class="btn btn-success d-block w-100 mb-3">Login with Line</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('login/google') }}" class="btn btn-danger d-block w-100 mb-3">Login with Google</a>
                </div>
            </div>
        </div>
    @endif
    <!-- Bootstrap Bundle JS (Popper.js and Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
