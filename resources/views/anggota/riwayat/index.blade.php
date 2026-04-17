@extends('anggota.master')

@section('title', 'Riwayat Peminjaman')
@section('breadcrumb', 'Riwayat Peminjaman')
@section('page-title', 'Riwayat Peminjaman')

@section('content')
<div class="card">
    <div class="card-body">

        <h5 class="mb-3">Riwayat Peminjaman</h5>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $item)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $item->buku->judul ?? '-' }}</td>
                        <td>{{ $item->tgl_pinjam }}</td>
                        <td>{{ $item->tgl_kembali_rencana }}</td>
                        <td>{{ $item->tanggal_kembali ?? '-' }}</td>

                        {{-- STATUS --}}
                        <td>
                            @if($item->status == 'pending')
                            <span class="badge badge-warning">Pending</span>

                            @elseif($item->status == 'diterima')
                            <span class="badge badge-primary">Diterima</span>

                            @elseif($item->status == 'ditolak')
                            <span class="badge badge-danger">Ditolak</span>

                            @elseif($item->status == 'dikembalikan' || $item->status == 'selesai')
                            <span class="badge badge-success">Selesai</span>

                            @else
                            <span class="badge badge-secondary">{{ $item->status }}</span>
                            @endif
                        </td>

                        {{-- DENDA --}}
                        <td>
                            @php $denda = $item->pengembalian->denda->jumlah ?? 0; @endphp
                            @if($denda > 0)
                            <span class="badge badge-danger">Rp {{ number_format($denda, 0, ',', '.') }}</span>
                            @else
                            <span class="badge badge-success">0</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Belum ada riwayat
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection