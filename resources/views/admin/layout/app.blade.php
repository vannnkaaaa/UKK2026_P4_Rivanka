<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Dashboard - Perpustakaan</title>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="fixed-left">

    <div id="wrapper">

        {{-- SIDEBAR --}}
        @include('admin.layout.sidebar')

        {{-- CONTENT --}}
        <div class="content-page">
            <div class="content">

                {{-- NAVBAR --}}
                @include('admin.layout.navbar')

                <div class="page-content-wrapper">
                    <div class="container-fluid">

                        @yield('content')

                    </div>
                </div>

            </div>

            <footer class="footer">© 2026 Perpustakaan</footer>
        </div>

    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('assets/pages/dashborad.js') }}"></script>
</body>

</html>