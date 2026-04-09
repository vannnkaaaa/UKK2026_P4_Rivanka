<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - Perpustakaan</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="fixed-left">

    <div class="accountbg"></div>

    <div class="wrapper-page">
        <div class="card">
            <div class="card-body">

                <h3 class="text-center mt-0 m-b-15">
                    <a href="#" class="logo logo-admin">
                        <img src="{{ asset('assets/images/logo.png') }}" height="24">
                    </a>
                </h3>

                <div class="p-3">

                    {{-- ERROR --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- FORM LOGIN --}}
                    <form class="form-horizontal m-t-20" method="POST" action="{{ url('/login-proses') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="email" name="email" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="password" name="password" placeholder="Password" required>
                            </div>
                        </div>

                        <div class="form-group text-center row m-t-20">
                            <div class="col-12">
                                <button class="btn btn-danger btn-block" type="submit">
                                    Log In
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

</body>
</html>