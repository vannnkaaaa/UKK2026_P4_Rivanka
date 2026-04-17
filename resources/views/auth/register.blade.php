<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Daftar - Perpustakaan</title>
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
            padding: 2.2rem 2.5rem;
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
            margin-bottom: 1.5rem;
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
                <h2>Bergabung sekarang</h2>
                <p>Daftarkan diri dan nikmati akses penuh ke koleksi perpustakaan kami</p>
            </div>
            <div>
                <div class="stat-card">
                    <small>Buku tersedia</small>
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
            <h3>Buat akun baru</h3>
            <p class="sub">Isi data diri Anda untuk mendaftar</p>

            @if($errors->any())
            <div class="alert alert-danger mb-3" style="font-size:13px">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('register.proses') }}">
                @csrf

                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label-sm">Nama depan</label>
                        <div class="input-icon">
                            <i class="icon mdi mdi-account-outline"></i>
                            <input type="text" name="nama_depan" class="form-control" placeholder="Budi" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label-sm">Nama belakang</label>
                        <div class="input-icon">
                            <i class="icon mdi mdi-account-outline"></i>
                            <input type="text" name="nama_belakang" class="form-control" placeholder="Santoso">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-sm">NIS</label>
                    <div class="input-icon">
                        <i class="icon mdi mdi-card-account-details-outline"></i>
                        <input type="text" name="nis" class="form-control" placeholder="Nomor induk" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-sm">Alamat email</label>
                    <div class="input-icon">
                        <i class="icon mdi mdi-email-outline"></i>
                        <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label-sm">Kata sandi</label>
                        <div class="input-icon">
                            <i class="icon mdi mdi-lock-outline"></i>
                            <input type="password" name="password" id="pw1" class="form-control" placeholder="Min. 8 karakter" required>
                            <span class="eye-toggle mdi mdi-eye-outline"
                                onclick="var i=document.getElementById('pw1');i.type=i.type==='password'?'text':'password'"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label-sm">Konfirmasi sandi</label>
                        <div class="input-icon">
                            <i class="icon mdi mdi-lock-check-outline"></i>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi sandi" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label-sm">Alamat</label>
                    <div class="input-icon">
                        <i class="icon mdi mdi-map-marker-outline"></i>
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label-sm">Kelas</label>
                    <div class="input-icon">
                        <i class="icon mdi mdi-school-outline"></i>
                        <select name="kelas_id" class="form-control" style="padding-left: 34px">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-red">Buat akun</button>

                <p class="text-center mt-3" style="font-size:11px;color:#aaa">
                    Dengan mendaftar Anda menyetujui
                    <a href="#" style="color:#c0392b;text-decoration:none">Syarat & Ketentuan</a> dan
                    <a href="#" style="color:#c0392b;text-decoration:none">Kebijakan Privasi</a>
                </p>
                <p class="text-center mt-2" style="font-size:12px;color:#888">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" style="color:#c0392b;text-decoration:none;font-weight:600">Masuk di sini</a>
                </p>

            </form>
        </div>

    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>