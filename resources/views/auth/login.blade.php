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
    <style>
        body {
            background: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 1.5rem 0;
        }

        .auth-shell {
            display: flex;
            width: 860px;
            max-width: 98vw;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, .10);
        }

        .auth-left {
            width: 42%;
            background: #c0392b;
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .auth-left::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .07);
            top: -70px;
            right: -70px;
        }

        .auth-left::after {
            content: '';
            position: absolute;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .07);
            bottom: -40px;
            left: -40px;
        }

        .auth-brand {
            position: relative;
            z-index: 1;
        }

        .auth-brand .logo-box {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, .15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.2rem;
        }

        .auth-brand h2 {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: .5rem;
        }

        .auth-brand p {
            color: rgba(255, 255, 255, .72);
            font-size: 13px;
            line-height: 1.7;
            max-width: 200px;
        }

        .stat-card {
            background: rgba(255, 255, 255, .1);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: .75rem;
            position: relative;
            z-index: 1;
        }

        .stat-card small {
            color: rgba(255, 255, 255, .6);
            font-size: 11px;
            display: block;
            margin-bottom: 2px;
        }

        .stat-card strong {
            color: #fff;
            font-size: 22px;
            font-weight: 700;
        }

        .auth-right {
            flex: 1;
            background: #fff;
            padding: 2.5rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-right h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: .3rem;
            color: #222;
        }

        .auth-right .sub {
            color: #888;
            font-size: 13px;
            margin-bottom: 1.8rem;
        }

        .form-label-sm {
            font-size: 12px;
            font-weight: 600;
            color: #555;
            margin-bottom: 4px;
            display: block;
            letter-spacing: .02em;
        }

        .input-icon {
            position: relative;
        }

        .input-icon .icon {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 14px;
            z-index: 5;
        }

        .input-icon input {
            padding-left: 34px !important;
        }

        .input-icon input:focus {
            border-color: #c0392b !important;
            box-shadow: 0 0 0 3px rgba(192, 57, 43, .10) !important;
            outline: none;
        }

        .eye-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
            font-size: 14px;
            z-index: 5;
        }

        .btn-red {
            background: #c0392b;
            border: none;
            color: #fff;
            width: 100%;
            padding: 11px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-red:hover {
            background: #a93226;
        }

        .divider-or {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #bbb;
            font-size: 12px;
            margin: 1.2rem 0;
        }

        .divider-or::before,
        .divider-or::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 9px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            background: #fff;
            font-size: 13px;
            color: #333;
            cursor: pointer;
            width: 100%;
            transition: background .15s;
        }

        .btn-social:hover {
            background: #fafafa;
        }
    </style>
</head>

<body>

    <div class="auth-shell">

        {{-- Panel kiri --}}
        <div class="auth-left">
            <div class="auth-brand">
                <div class="logo-box">
                    <img src="{{ asset('assets/images/logo.png') }}" height="28" alt="Logo">
                </div>
                <h2>Selamat datang</h2>
                <p>Masuk dan akses koleksi perpustakaan digital kapan saja</p>
            </div>
            <div>
                <div class="stat-card">
                    <small>Total koleksi</small>
                    <strong>12.480</strong>
                </div>
                <div class="stat-card">
                    <small>Anggota aktif</small>
                    <strong>3.240</strong>
                </div>
            </div>
        </div>

        {{-- Panel kanan --}}
        <div class="auth-right">
            <h3>Masuk ke akun</h3>
            <p class="sub">Gunakan email dan kata sandi Anda</p>

            @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" style="font-size:13px">
                <i class="mdi mdi-alert-circle-outline"></i> {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ url('/login-proses') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label-sm">Alamat email</label>
                    <div class="input-icon">
                        <i class="icon mdi mdi-email-outline"></i>
                        <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label-sm">Kata sandi</label>
                    <div class="input-icon">
                        <i class="icon mdi mdi-lock-outline"></i>
                        <input type="password" name="password" id="pw-login" class="form-control" placeholder="••••••••" required>
                        <span class="eye-toggle mdi mdi-eye-outline"
                            onclick="var i=document.getElementById('pw-login');i.type=i.type==='password'?'text':'password'"></span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check" style="font-size:13px">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label text-muted" for="remember">Ingat saya</label>
                    </div>
                    <a href="#" style="font-size:12px;color:#c0392b;text-decoration:none">Lupa kata sandi?</a>
                </div>

                <button type="submit" class="btn-red">Masuk</button>

                <div class="divider-or">atau masuk dengan</div>

                <div class="row g-2">
                    <div class="col-6">
                        <button type="button" class="btn-social">
                            <svg width="16" height="16" viewBox="0 0 24 24">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
                            </svg>
                            Google
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn-social">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="#1877F2">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            Facebook
                        </button>
                    </div>
                </div>

                <p class="text-center mt-3" style="font-size:12px;color:#888">
                    Belum punya akun?
                    <a href="{{ route('register') }}" style="color:#c0392b;text-decoration:none;font-weight:600">Daftar sekarang</a>
                </p>

            </form>
        </div>

    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>