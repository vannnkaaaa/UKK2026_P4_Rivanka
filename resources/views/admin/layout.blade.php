<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard - Perpustakaan</title>

    <link href="{{ asset('assets/plugins/morris/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="fixed-left">

<div id="wrapper">

    {{-- SIDEBAR --}}
    <div class="left side-menu">
        <div class="topbar-left text-center">
            <a href="#" class="logo">Perpus</a>
        </div>

        <div class="sidebar-inner">
            <ul>
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="#">Buku</a></li>
                <li><a href="#">Anggota</a></li>
                <li><a href="#">Peminjaman</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content-page">
        <div class="content p-4">

            <h4 class="mb-4">Dashboard</h4>

            @yield('content')

        </div>
    </div>

</div>

{{-- JS --}}
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>

@yield('js')

</body>
</html>