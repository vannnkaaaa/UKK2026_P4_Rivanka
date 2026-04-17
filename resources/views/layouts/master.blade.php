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
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
    @stack('styles')
</head>

<body class="fixed-left">

    {{-- Loader --}}
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <div id="wrapper">

        {{-- ========== LEFT SIDEBAR ========== --}}
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            {{-- LOGO --}}
            <div class="topbar-left">
                <div class="text-center">
                    <a href="{{ route('admin.dashboard') }}" class="logo">
                        <i class="mdi mdi-book-open-page-variant"></i> ANNEX
                    </a>
                </div>
            </div>

            <div class="sidebar-inner slimscrollleft">
                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Menu Utama</li>

                        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                                <i class="mdi mdi-airplay"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="menu-title">Master Data</li>

                        <li class="{{ request()->routeIs('admin.buku.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.buku.index') }}" class="waves-effect">
                                <i class="mdi mdi-book-multiple"></i>
                                <span>Buku</span>
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.rak.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.rak.index') }}" class="waves-effect">
                                <i class="mdi mdi-library-shelves"></i>
                                <span>Rak Buku</span>
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.kelas.index') }}" class="waves-effect">
                                <i class="mdi mdi-tag-multiple"></i>
                                <span>Kelas</span>
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.penerbit.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.penerbit.index') }}" class="waves-effect">
                                <i class="mdi mdi-domain"></i>
                                <span>Penerbit</span>
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.pengarang.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.pengarang.index') }}" class="waves-effect">
                                <i class="mdi mdi-account-edit"></i>
                                <span>Pengarang</span>
                            </a>
                        </li>

                        <li class="menu-title">Manajemen User</li>

                        <li class="{{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.anggota.index') }}" class="waves-effect">
                                <i class="mdi mdi-account-multiple"></i>
                                <span>Anggota</span>
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.index') }}" class="waves-effect">
                                <i class="mdi mdi-account-hard-hat"></i>
                                <span>Petugas</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        {{-- ========== LEFT SIDEBAR END ========== --}}

        {{-- ========== CONTENT AREA ========== --}}
        <div class="content-page">
            <div class="content">

                {{-- TOP BAR --}}
                <div class="topbar">
                    <nav class="navbar-custom">
                        <ul class="list-inline float-right mb-0">

                            {{-- Search --}}
                            <li class="list-inline-item hide-phone app-search" style="margin-top:8px;">
                                <form role="search" action="" method="GET">
                                    <input type="text" name="search" placeholder="Cari buku..."
                                        value="{{ request('search') }}" class="form-control">
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </form>
                            </li>

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
                                    <a href="#" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning"><i class="mdi mdi-book-clock"></i></div>
                                        <p class="notify-details"><b>Ada peminjaman pending</b>
                                            <small class="text-muted">Menunggu konfirmasi petugas</small>
                                        </p>
                                    </a>
                                </div>
                            </li>

                            {{-- Profile Dropdown --}}
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                                    data-toggle="dropdown" href="#" role="button">
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user"
                                        class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                    <div class="dropdown-item noti-title">
                                        <h5>{{ auth()->user()->name }}</h5>
                                        <small class="text-muted">{{ auth()->user()->role }}</small>
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
                {{-- TOP BAR END --}}

                <div class="page-content-wrapper">
                    <div class="container-fluid">

                        {{-- Flash Message --}}
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-circle mr-2"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle mr-2"></i> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                        @endif

                        {{-- Page Header --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">@yield('breadcrumb', 'Home')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">@yield('page-title', 'Dashboard')</h4>
                                </div>
                            </div>
                        </div>

                        {{-- MAIN CONTENT --}}
                        @yield('content')

                    </div>
                </div>

            </div>

            <footer class="footer">© {{ date('Y') }} Sistem Perpustakaan.</footer>
        </div>
        {{-- ========== CONTENT AREA END ========== --}}

    </div>

    {{-- Modal Stack --}}
    @stack('modal')

    {{-- Scripts --}}
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

    {{-- Auto buka modal jika ada error validasi --}}
    @if($errors->any())
    <script>
        $(document).ready(function() {
            var modalId = "{{ session('open_modal') }}";
            if (modalId) {
                $('#' + modalId).modal('show');
            }
        });
    </script>
    @endif

    @stack('scripts')
</body>

</html>