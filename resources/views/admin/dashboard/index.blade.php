@extends('layouts.master')

@section('title', 'Dashboard Admin')
@section('breadcrumb', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round" style="background:#5b73e8;">
                            <i class="mdi mdi-book-multiple" style="color:#fff;font-size:22px;"></i>
                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center">
                        <h5 class="mt-0 round-inner">{{ $totalBuku ?? 0 }}</h5>
                        <p class="mb-0 text-muted">Total Buku</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <a href="{{ route('admin.buku.index') }}" class="btn btn-primary btn-sm">
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
                        <div class="round" style="background:#1abc9c;">
                            <i class="mdi mdi-account-multiple" style="color:#fff;font-size:22px;"></i>
                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center">
                        <h5 class="mt-0 round-inner">{{ $totalAnggota ?? 0 }}</h5>
                        <p class="mb-0 text-muted">Total Anggota</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <a href="{{ route('admin.anggota.index') }}" class="btn btn-success btn-sm">
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
                        <div class="round" style="background:#f7b84b;">
                            <i class="mdi mdi-book-clock" style="color:#fff;font-size:22px;"></i>
                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center">
                        <h5 class="mt-0 round-inner">{{ $totalPeminjaman ?? 0 }}</h5>
                        <p class="mb-0 text-muted">Dipinjam</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <span class="badge badge-warning">Aktif</span>
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
                        <h5 class="mt-0 round-inner">{{ $totalDenda ?? 0 }}</h5>
                        <p class="mb-0 text-muted">Denda Belum Lunas</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <span class="badge badge-danger">!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Peminjaman Terbaru + Buku Populer --}}
<div class="row">
    <div class="col-lg-8">
        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title mb-3 mt-0">
                    <i class="mdi mdi-history mr-1"></i> Peminjaman Terbaru
                </h5>
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjamanterbaru ?? [] as $p)
                            <tr>
                                <td>{{ $p->user->name ?? '-' }}</td>
                                <td>{{ $p->buku->judul ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') }}</td>
                                <td>
                                    @if($p->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($p->status == 'diterima')
                                        <span class="badge badge-success">Diterima</span>
                                    @elseif($p->status == 'ditolak')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @else
                                        <span class="badge badge-secondary">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada peminjaman</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title mt-0 mb-3">
                    <i class="mdi mdi-chart-bar mr-1"></i> Ringkasan Stok
                </h5>
                <ul class="list-unstyled mb-0">
                    <li class="p-2 border-bottom d-flex justify-content-between align-items-center">
                        <span><i class="mdi mdi-book text-primary mr-2"></i> Total Judul Buku</span>
                        <span class="badge badge-primary badge-pill">{{ $totalBuku ?? 0 }}</span>
                    </li>
                    <li class="p-2 border-bottom d-flex justify-content-between align-items-center">
                        <span><i class="mdi mdi-library-shelves text-info mr-2"></i> Total Rak</span>
                        <span class="badge badge-info badge-pill">{{ $totalRak ?? 0 }}</span>
                    </li>
                    <li class="p-2 border-bottom d-flex justify-content-between align-items-center">
                        <span><i class="mdi mdi-domain text-success mr-2"></i> Penerbit</span>
                        <span class="badge badge-success badge-pill">{{ $totalPenerbit ?? 0 }}</span>
                    </li>
                    <li class="p-2 border-bottom d-flex justify-content-between align-items-center">
                        <span><i class="mdi mdi-account-edit text-warning mr-2"></i> Pengarang</span>
                        <span class="badge badge-warning badge-pill">{{ $totalPengarang ?? 0 }}</span>
                    </li>
                    <li class="p-2 d-flex justify-content-between align-items-center">
                        <span><i class="mdi mdi-account-tie text-secondary mr-2"></i> Petugas</span>
                        <span class="badge badge-secondary badge-pill">{{ $totalPetugas ?? 0 }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title mt-0 mb-3">
                    <i class="mdi mdi-alert-circle text-danger mr-1"></i> Denda Belum Lunas
                </h5>
                @forelse($dendaBelumLunas ?? [] as $d)
                <div class="media mb-2 p-2 border rounded">
                    <div class="media-body">
                        <p class="mb-0 font-weight-bold">{{ $d->pengembalian->peminjaman->anggota->name ?? '-' }}</p>
                        <small class="text-danger">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center mb-0">Tidak ada denda</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
