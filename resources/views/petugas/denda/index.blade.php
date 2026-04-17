@extends('petugas.master')

@section('title', 'Kelola Denda')
@section('breadcrumb', 'Denda')
@section('page-title', 'Kelola Denda')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <i class="mdi mdi-check-circle mr-2"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    <i class="mdi mdi-alert-circle mr-2"></i> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

<div class="card m-b-30">
    <div class="card-body">
        <h5 class="header-title mt-0 mb-3">
            <i class="mdi mdi-cash-multiple mr-1"></i> Daftar Denda
        </h5>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Hari Terlambat</th>
                        <th>Jumlah Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dendas as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->pengembalian->peminjaman->user->name ?? '-' }}</td>
                        <td>{{ $d->pengembalian->peminjaman->buku->judul ?? '-' }}</td>
                        <td>{{ $d->hari_terlambat }} hari</td>
                        <td>Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
                        <td>
                            @if($d->status_lunas)
                            <span class="badge badge-success">Lunas</span>
                            @else
                            <span class="badge badge-danger">Belum Lunas</span>
                            @endif
                        </td>
                        <td>
                            @if(!$d->status_lunas)
                            <form action="{{ route('petugas.denda.lunas', $d->id) }}" method="POST"
                                onsubmit="return confirm('Tandai denda ini sudah lunas?')">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="mdi mdi-check"></i> Tandai Lunas
                                </button>
                            </form>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada data denda</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $dendas->links() }}
    </div>
</div>

@endsection