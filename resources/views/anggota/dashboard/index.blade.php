@extends('anggota.master')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('page-title', 'Dashboard Anggota')

@section('content')

{{-- Stat Cards --}}
<div class="row">
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
                        <a href="{{ route('anggota.peminjaman.index') }}" class="btn btn-primary btn-sm">
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
                            <i class="mdi mdi-clock-alert" style="color:#fff;font-size:22px;"></i>
                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center">
                        <h5 class="mt-0 round-inner">{{ $totalPending ?? 0 }}</h5>
                        <p class="mb-0 text-muted">Menunggu Konfirmasi</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <span class="badge badge-warning">Pending</span>
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
                            <i class="mdi mdi-history" style="color:#fff;font-size:22px;"></i>
                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center">
                        <h5 class="mt-0 round-inner">{{ $totalSelesai ?? 0 }}</h5>
                        <p class="mb-0 text-muted">Total Riwayat</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <a href="{{ route('anggota.peminjaman.index') }}?status=selesai" class="btn btn-success btn-sm">
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
                        <h5 class="mt-0 round-inner">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h5>
                        <p class="mb-0 text-muted">Total Denda</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <span class="badge {{ ($totalDenda ?? 0) > 0 ? 'badge-danger' : 'badge-success' }}">
                            {{ ($totalDenda ?? 0) > 0 ? 'Ada' : 'Lunas' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Peminjaman Aktif --}}
    <div class="col-lg-8">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="header-title mt-0 mb-0">
                        <i class="mdi mdi-book-arrow-right mr-1"></i> Peminjaman Aktif
                    </h5>
                    <a href="{{ route('anggota.peminjaman.index') }}" class="btn btn-primary btn-sm">
                        Lihat Semua
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>Judul Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjamantAktif ?? [] as $p)
                            <tr>
                                <td>{{ $p->buku->judul ?? '-' }}</td>
                                <td>{{ $p->tgl_pinjam ? \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') : '-' }}</td>
                                <td>
                                    {{ $p->tgl_kembali_rencana ? \Carbon\Carbon::parse($p->tgl_kembali_rencana)->format('d/m/Y') : '-' }}
                                    @if($p->tgl_kembali_rencana && \Carbon\Carbon::parse($p->tgl_kembali_rencana)->isPast() && $p->status == 'diterima')
                                        <span class="badge badge-danger ml-1">Terlambat!</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($p->status == 'diterima')
                                        <span class="badge badge-success">Dipinjam</span>
                                    @elseif($p->status == 'ditolak')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @else
                                        <span class="badge badge-secondary">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    Tidak ada peminjaman aktif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Info & Shortcut --}}
    <div class="col-lg-4">
        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title mt-0 mb-3">
                    <i class="mdi mdi-account-circle mr-1"></i> Info Akun
                </h5>
                <ul class="list-unstyled mb-0">
                    <li class="p-2 border-bottom d-flex justify-content-between">
                        <span class="text-muted">Nama</span>
                        <strong>{{ auth()->user()->name }}</strong>
                    </li>
                    <li class="p-2 border-bottom d-flex justify-content-between">
                        <span class="text-muted">NIS</span>
                        <strong>{{ auth()->user()->nis ?? '-' }}</strong>
                    </li>
                    <li class="p-2 border-bottom d-flex justify-content-between">
                        <span class="text-muted">Email</span>
                        <strong>{{ auth()->user()->email }}</strong>
                    </li>
                    <li class="p-2 d-flex justify-content-between">
                        <span class="text-muted">Status</span>
                        <span class="badge badge-success">Aktif</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title mt-0 mb-3">
                    <i class="mdi mdi-lightning-bolt mr-1"></i> Aksi Cepat
                </h5>
                <a href="{{ route('anggota.peminjaman.index') }}" class="btn btn-primary btn-block waves-effect mb-2">
                    <i class="mdi mdi-book-arrow-right mr-1"></i> Pinjam Buku
                </a>
                <a href="{{ route('anggota.pengembalian.index') }}" class="btn btn-warning btn-block waves-effect">
                    <i class="mdi mdi-book-arrow-left mr-1"></i> Kembalikan Buku
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
