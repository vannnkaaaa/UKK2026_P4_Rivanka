@extends('petugas.layouts.master')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('page-title', 'Dashboard Petugas')

@section('content')

{{-- Stat Cards --}}
<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round" style="background:#f7b84b;">
                            <i class="mdi mdi-clock-alert" style="color:#fff;font-size:22px;"></i>
                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center">
                        <h5 class="mt-0 round-inner">{{ $totalPending ?? 0 }}</h5>
                        <p class="mb-0 text-muted">Peminjaman Pending</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round" style="background:#5b73e8;">
                            <i class="mdi mdi-book-arrow-right" style="color:#fff;font-size:22px;"></i>
                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center">
                        <h5 class="mt-0 round-inner">{{ $totalDipinjam ?? 0 }}</h5>
                        <p class="mb-0 text-muted">Sedang Dipinjam</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <span class="badge badge-primary badge-pill">Aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round" style="background:#1abc9c;">
                            <i class="mdi mdi-book-arrow-left" style="color:#fff;font-size:22px;"></i>
                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center">
                        <h5 class="mt-0 round-inner">{{ $totalKembaliPending ?? 0 }}</h5>
                        <p class="mb-0 text-muted">Pengembalian Pending</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <a href="{{ route('petugas.pengembalian.index') }}" class="btn btn-success btn-sm">
                            <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round" style="background:#f1556c;">
                            <i class="mdi mdi-cash-multiple" style="color:#fff;font-size:22px;"></i>
                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center">
                        <h5 class="mt-0 round-inner">{{ $totalDendaBelumLunas ?? 0 }}</h5>
                        <p class="mb-0 text-muted">Denda Belum Lunas</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <a href="{{ route('petugas.denda.index') }}" class="btn btn-danger btn-sm">
                            <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Tabel Peminjaman Pending --}}
    <div class="col-lg-8">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="header-title mt-0 mb-0">
                        <i class="mdi mdi-clock-alert mr-1 text-warning"></i> Peminjaman Menunggu Konfirmasi
                    </h5>
                    <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-warning btn-sm">
                        Lihat Semua
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjamanPending ?? [] as $p)
                            <tr>
                                <td>{{ $p->user->name ?? '-' }}</td>
                                <td>{{ $p->buku->judul ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') }}</td>
                                <td>
                                    <form action="{{ route('petugas.peminjaman.terima', $p->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="mdi mdi-check"></i> Terima
                                        </button>
                                    </form>
                                    <form action="{{ route('petugas.peminjaman.tolak', $p->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="mdi mdi-close"></i> Tolak
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    <i class="mdi mdi-check-circle text-success mr-1"></i>
                                    Tidak ada peminjaman pending
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Aksi Cepat + Buku Tersedia --}}
    <div class="col-lg-4">
        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title mt-0 mb-3">
                    <i class="mdi mdi-lightning-bolt mr-1"></i> Aksi Cepat
                </h5>
                <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-warning btn-block waves-effect mb-2">
                    <i class="mdi mdi-book-arrow-right mr-1"></i> Kelola Peminjaman
                </a>
                <a href="{{ route('petugas.pengembalian.index') }}" class="btn btn-info btn-block waves-effect mb-2">
                    <i class="mdi mdi-book-arrow-left mr-1"></i> Kelola Pengembalian
                </a>
                <a href="{{ route('petugas.denda.index') }}" class="btn btn-danger btn-block waves-effect">
                    <i class="mdi mdi-cash-multiple mr-1"></i> Kelola Denda
                </a>
            </div>
        </div>

        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title mt-0 mb-3">
                    <i class="mdi mdi-book-multiple mr-1"></i> Stok Buku Menipis
                </h5>
                @forelse($bukuStokRendah ?? [] as $b)
                <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                    <span class="text-truncate" style="max-width:160px;">{{ $b->judul }}</span>
                    <span class="badge badge-{{ $b->stok == 0 ? 'danger' : 'warning' }} badge-pill">
                        {{ $b->stok }} tersisa
                    </span>
                </div>
                @empty
                <p class="text-muted text-center mb-0">
                    <i class="mdi mdi-check-circle text-success mr-1"></i> Stok aman
                </p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
