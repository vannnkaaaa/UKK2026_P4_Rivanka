@extends('petugas.master')

@section('title', 'Kelola Pengembalian')
@section('breadcrumb', 'Pengembalian')
@section('page-title', 'Kelola Pengembalian')

@section('content')

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

<div class="card m-b-30">
    <div class="card-body">
        <h5 class="header-title mt-0 mb-3">
            <i class="mdi mdi-book-arrow-left mr-1"></i> Daftar Pengembalian
        </h5>
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali Rencana</th>
                        <th>Tgl Kembali Aktual</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengembalians as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->peminjaman->user->name ?? '-' }}</td>
                        <td>{{ $p->peminjaman->buku->judul ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->peminjaman->tgl_pinjam)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->peminjaman->tgl_kembali_rencana)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}</td>
                        <td>
                            @if($p->status == 'pending')
                                <span class="badge badge-warning">Menunggu Konfirmasi</span>
                            @elseif($p->status == 'diterima')
                                <span class="badge badge-success">Diterima</span>
                            @elseif($p->status == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                            @else
                                <span class="badge badge-secondary">{{ $p->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($p->status == 'pending')
                            <form action="{{ route('petugas.pengembalian.terima', $p->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Terima pengembalian ini?')">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="mdi mdi-check"></i> Terima
                                </button>
                            </form>
                            <form action="{{ route('petugas.pengembalian.tolak', $p->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Tolak pengembalian ini?')">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-close"></i> Tolak
                                </button>
                            </form>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data pengembalian</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $pengembalians->links() }}
    </div>
</div>

@endsection