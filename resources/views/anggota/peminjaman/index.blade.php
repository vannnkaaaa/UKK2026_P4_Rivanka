@extends('anggota.master')

@section('title', 'Peminjaman')
@section('breadcrumb', 'Peminjaman')
@section('page-title', 'Peminjaman Buku')

@section('content')
<div class="row">

    {{-- Form Ajukan Pinjam --}}
    <div class="col-lg-4">
        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title mt-0 mb-3">
                    <i class="mdi mdi-book-arrow-right mr-1"></i> Ajukan Peminjaman
                </h5>

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                @endif

                <form action="{{ route('anggota.peminjaman.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Pilih Buku <span class="text-danger">*</span></label>
                        <select name="buku_id" class="form-control @error('buku_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach($bukus as $b)
                                <option value="{{ $b->id }}" {{ old('buku_id') == $b->id ? 'selected' : '' }}>
                                    {{ $b->judul }}
                                    <span class="text-muted">(Stok: {{ $b->stok }})</span>
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Kembali Rencana <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_kembali_rencana"
                            class="form-control @error('tgl_kembali_rencana') is-invalid @enderror"
                            value="{{ old('tgl_kembali_rencana') }}"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            max="{{ date('Y-m-d', strtotime('+30 days')) }}"
                            required>
                        @error('tgl_kembali_rencana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Maksimal 30 hari dari sekarang</small>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">
                        <i class="mdi mdi-send mr-1"></i> Ajukan Peminjaman
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Tabel Riwayat Peminjaman --}}
    <div class="col-lg-8">
        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title mt-0 mb-3">
                    <i class="mdi mdi-history mr-1"></i> Riwayat Peminjaman Saya
                </h5>

                {{-- Tab Filter --}}
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <a class="nav-link {{ !request('status') || request('status') == 'semua' ? 'active' : '' }}"
                            href="?status=semua">Semua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}"
                            href="?status=pending">
                            Pending
                            @if($totalPending > 0)
                                <span class="badge badge-warning ml-1">{{ $totalPending }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == 'diterima' ? 'active' : '' }}"
                            href="?status=diterima">Aktif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == 'selesai' ? 'active' : '' }}"
                            href="?status=selesai">Selesai</a>
                    </li>
                </ul>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Judul Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th width="100">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjaman as $i => $p)
                            <tr>
                                <td>{{ $peminjaman->firstItem() + $i }}</td>
                                <td>
                                    <strong>{{ $p->buku->judul ?? '-' }}</strong>
                                    <br><small class="text-muted">{{ $p->buku->penulis ?? '' }}</small>
                                </td>
                                <td>{{ $p->tgl_pinjam ? \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') : '-' }}</td>
                                <td>
                                    {{ $p->tgl_kembali_rencana ? \Carbon\Carbon::parse($p->tgl_kembali_rencana)->format('d/m/Y') : ($p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') : '-') }}
                                    @if($p->tgl_kembali_rencana && \Carbon\Carbon::parse($p->tgl_kembali_rencana)->isPast() && $p->status == 'diterima')
                                        <br><span class="badge badge-danger">Terlambat!</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($p->status == 'diterima')
                                        <span class="badge badge-success">Dipinjam</span>
                                    @elseif($p->status == 'ditolak')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @elseif($p->status == 'selesai')
                                        <span class="badge badge-secondary">Selesai</span>
                                    @else
                                        <span class="badge badge-info">{{ $p->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="mdi mdi-book-off mdi-36px d-block mb-2"></i>
                                    Belum ada riwayat peminjaman
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-2">
                    {{ $peminjaman->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
