@extends('petugas.master')

@section('title', 'Peminjaman')
@section('breadcrumb', 'Peminjaman')
@section('page-title', 'Kelola Peminjaman')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                {{-- Tab Filter --}}
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request('status', 'pending') == 'pending' ? 'active' : '' }}"
                            href="?status=pending">
                            <i class="mdi mdi-clock-alert mr-1"></i> Pending
                            @if($totalPending > 0)
                                <span class="badge badge-danger ml-1">{{ $totalPending }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == 'diterima' ? 'active' : '' }}"
                            href="?status=diterima">
                            <i class="mdi mdi-check-circle mr-1"></i> Diterima
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == 'ditolak' ? 'active' : '' }}"
                            href="?status=ditolak">
                            <i class="mdi mdi-close-circle mr-1"></i> Ditolak
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == 'selesai' ? 'active' : '' }}"
                            href="?status=selesai">
                            <i class="mdi mdi-check-all mr-1"></i> Selesai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('status') == 'semua' ? 'active' : '' }}"
                            href="?status=semua">
                            <i class="mdi mdi-format-list-bulleted mr-1"></i> Semua
                        </a>
                    </li>
                </ul>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th width="100">Status</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjamans as $i => $p)
                            <tr>
                                <td>{{ $peminjamans->firstItem() + $i }}</td>
                                <td>
                                    <strong>{{ $p->user->name ?? '-' }}</strong>
                                    <br><small class="text-muted">{{ $p->user->nim ?? '' }}</small>
                                </td>
                                <td>{{ $p->buku->judul ?? '-' }}</td>
                                <td>{{ $p->tgl_pinjam ? \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') : '-' }}</td>
                                <td>
                                    {{ $p->tgl_kembali_rencana ? \Carbon\Carbon::parse($p->tgl_kembali_rencana)->format('d/m/Y') : ($p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') : '-') }}
                                    @if($p->tgl_kembali_rencana && \Carbon\Carbon::parse($p->tgl_kembali_rencana)->isPast() && $p->status == 'diterima')
                                        <span class="badge badge-danger ml-1">Terlambat!</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($p->status == 'diterima')
                                        <span class="badge badge-success">Diterima</span>
                                    @elseif($p->status == 'ditolak')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @elseif($p->status == 'selesai')
                                        <span class="badge badge-secondary">Selesai</span>
                                    @else
                                        <span class="badge badge-info">{{ $p->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->status == 'pending')
                                        {{-- Tombol Terima --}}
                                        <form action="{{ route('petugas.peminjaman.terima', $p->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm waves-effect"
                                                onclick="return confirm('Terima peminjaman ini?')">
                                                <i class="mdi mdi-check"></i> Terima
                                            </button>
                                        </form>
                                        {{-- Tombol Tolak --}}
                                        <button type="button" class="btn btn-danger btn-sm waves-effect btn-tolak"
                                            data-toggle="modal" data-target="#modalTolak"
                                            data-id="{{ $p->id }}"
                                            data-nama="{{ $p->user->name }}"
                                            data-buku="{{ $p->buku->judul }}">
                                            <i class="mdi mdi-close"></i> Tolak
                                        </button>
                                    @elseif($p->status == 'diterima')
                                        <span class="text-muted"><i class="mdi mdi-check-circle text-success mr-1"></i>Sudah diterima</span>
                                    @elseif($p->status == 'ditolak')
                                        <span class="text-muted"><i class="mdi mdi-close-circle text-danger mr-1"></i>Ditolak</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="mdi mdi-book-off mdi-36px d-block mb-2"></i>
                                    Tidak ada data peminjaman
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-2">
                    {{ $peminjamans->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
{{-- Modal Konfirmasi Tolak --}}
<div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="mdi mdi-alert mr-1"></i> Tolak Peminjaman</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formTolak" action="" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <i class="mdi mdi-close-circle mdi-48px text-danger"></i>
                    <p class="mt-2">Tolak peminjaman buku:</p>
                    <strong id="tolak_buku"></strong>
                    <p class="mt-1 mb-0">oleh <strong id="tolak_nama"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="mdi mdi-close mr-1"></i> Ya, Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('.btn-tolak').on('click', function() {
        var btn = $(this);
        $('#tolak_nama').text(btn.data('nama'));
        $('#tolak_buku').text(btn.data('buku'));
        $('#formTolak').attr('action', '/petugas/peminjaman/' + btn.data('id') + '/tolak');
    });
});
</script>
@endpush
