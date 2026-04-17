@extends('anggota.master')

@section('title', 'Kembalikan Buku')
@section('breadcrumb', 'Kembalikan Buku')
@section('page-title', 'Kembalikan Buku')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

{{-- Buku yang bisa dikembalikan --}}
<div class="card m-b-30">
    <div class="card-body">
        <h5 class="header-title mt-0 mb-3">
            <i class="mdi mdi-book-arrow-left mr-1"></i> Buku yang Perlu Dikembalikan
        </h5>
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->buku->judul ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tgl_kembali_rencana)->format('d/m/Y') }}</td>
                        <td>
                            @if(\Carbon\Carbon::parse($p->tgl_kembali_rencana)->isPast())
                                <span class="badge badge-danger">Terlambat</span>
                            @else
                                <span class="badge badge-success">Tepat Waktu</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('anggota.pengembalian.store') }}" method="POST"
                                onsubmit="return confirm('Yakin ingin mengajukan pengembalian buku ini?')">
                                @csrf
                                <input type="hidden" name="peminjaman_id" value="{{ $p->id }}">
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="mdi mdi-arrow-left"></i> Kembalikan
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada buku yang perlu dikembalikan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $peminjamans->links() }}
    </div>
</div>

{{-- Riwayat Pengembalian --}}
<div class="card m-b-30">
    <div class="card-body">
        <h5 class="header-title mt-0 mb-3">
            <i class="mdi mdi-history mr-1"></i> Riwayat Pengembalian
        </h5>
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatKembali as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $r->peminjaman->buku->judul ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->tanggal_kembali)->format('d/m/Y') }}</td>
                        <td>
                            @if($r->status == 'pending')
                                <span class="badge badge-warning">Menunggu Konfirmasi</span>
                            @elseif($r->status == 'diterima')
                                <span class="badge badge-success">Diterima</span>
                            @elseif($r->status == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                            @else
                                <span class="badge badge-secondary">{{ $r->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada riwayat pengembalian</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection