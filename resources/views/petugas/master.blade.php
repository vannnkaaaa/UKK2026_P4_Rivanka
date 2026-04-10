<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>@yield('title', 'Rivanka') | Perpustakaan Digital</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    @stack('styles')
</head>

<body class="fixed-left">

    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <div id="wrapper">

        {{-- ========== LEFT SIDEBAR PETUGAS ========== --}}
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <div class="topbar-left">
                <div class="text-center">
                    <a href="{{ route('petugas.dashboard') }}" class="logo">
                        <i class="mdi mdi-book-open-page-variant"></i> ANNEX
                    </a>
                </div>
            </div>

            <div class="sidebar-inner slimscrollleft">
                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Menu Petugas</li>

                        <li class="{{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('petugas.dashboard') }}" class="waves-effect">
                                <i class="mdi mdi-airplay"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="menu-title">Transaksi</li>

                        <li class="{{ request()->routeIs('petugas.peminjaman.*') ? 'active' : '' }}">
                            <a href="{{ route('petugas.peminjaman.index') }}" class="waves-effect">
                                <i class="mdi mdi-book-arrow-right"></i>
                                <span>Peminjaman</span>
                                {{-- Badge jumlah pending --}}
                                @isset($totalPending)
                                @if($totalPending > 0)
                                <span class="badge badge-pill badge-danger float-right">{{ $totalPending }}</span>
                                @endif
                                @endisset
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('petugas.pengembalian.*') ? 'active' : '' }}">
                            <a href="{{ route('petugas.pengembalian.index') }}" class="waves-effect">
                                <i class="mdi mdi-book-arrow-left"></i>
                                <span>Pengembalian</span>
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('petugas.denda.*') ? 'active' : '' }}">
                            <a href="{{ route('petugas.denda.index') }}" class="waves-effect">
                                <i class="mdi mdi-cash-multiple"></i>
                                <span>Denda</span>
                            </a>
                        </li>

                        <li class="menu-title">Referensi</li>

                        <li class="{{ request()->routeIs('petugas.buku.*') ? 'active' : '' }}">
                            <a href="{{ route('petugas.buku.index') }}" class="waves-effect">
                                <i class="mdi mdi-book-multiple"></i>
                                <span>Data Buku</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        {{-- ========== LEFT SIDEBAR PETUGAS END ========== --}}

        <div class="content-page">
            <div class="content">

                <div class="topbar">
                    <nav class="navbar-custom">
                        <ul class="list-inline float-right mb-0">

                            {{-- Notifikasi peminjaman pending --}}
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown"
                                    href="#" role="button">
                                    <i class="ti-bell noti-icon"></i>
                                    <span class="badge badge-danger noti-icon-badge">!</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                    <div class="dropdown-item noti-title">
                                        <h5>Notifikasi</h5>
                                    </div>
                                    <a href="{{ route('petugas.peminjaman.index') }}" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning"><i class="mdi mdi-book-clock"></i></div>
                                        <p class="notify-details"><b>Ada peminjaman pending</b>
                                            <small class="text-muted">Menunggu konfirmasi kamu</small>
                                        </p>
                                    </a>
                                    <a href="{{ route('petugas.pengembalian.index') }}" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info"><i class="mdi mdi-book-arrow-left"></i></div>
                                        <p class="notify-details"><b>Ada pengembalian pending</b>
                                            <small class="text-muted">Perlu dikonfirmasi</small>
                                        </p>
                                    </a>
                                </div>
                            </li>

                            {{-- Profile --}}
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                                    data-toggle="dropdown" href="#" role="button">
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user"
                                        class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                    <div class="dropdown-item noti-title">
                                        <h5>{{ auth()->user()->name }}</h5>
                                        <small class="text-muted">Petugas</small>
                                    </div>
                                    <a class="dropdown-item" href="#">
                                        <i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="mdi mdi-logout m-r-5 text-muted"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </li>

                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </nav>
                </div>

                <div class="page-content-wrapper">
                    <div class="container-fluid">

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-circle mr-2"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle mr-2"></i> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li class="breadcrumb-item"><a href="{{ route('petugas.dashboard') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">@yield('breadcrumb', 'Home')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">@yield('page-title', 'Dashboard')</h4>
                                </div>
                            </div>
                        </div>

                        @yield('content')

                    </div>
                </div>

            </div>

            <footer class="footer">© {{ date('Y') }} Sistem Perpustakaan.</footer>
        </div>

    </div>

    @stack('modal')

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @if($errors->any())
    <script>
        $(document).ready(function() {
            var modalId = "{{ session('open_modal') }}";
            if (modalId) { $('#' + modalId).modal('show'); }
        });
    </script>
    @endif

    @stack('scripts')
</body>
</html>
