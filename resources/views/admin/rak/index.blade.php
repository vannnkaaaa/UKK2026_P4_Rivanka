@extends('layouts.master')

@section('title', 'Manajemen Rak')
@section('breadcrumb', 'Rak')
@section('page-title', 'Manajemen Rak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="header-title mt-0 mb-0">
                        <i class="mdi mdi-bookshelf mr-1"></i> Daftar Rak
                    </h5>
                    <button type="button" class="btn btn-primary waves-effect waves-light"
                        data-toggle="modal" data-target="#modalTambahRak">
                        <i class="mdi mdi-plus mr-1"></i> Tambah Rak
                    </button>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Rak</th>
                                <th>Keterangan</th>
                                <th width="130">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rak as $i => $item)
                            <tr>
                                <td>{{ $rak->firstItem() + $i }}</td>
                                <td>{{ $item->nama_rak }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm waves-effect btn-edit-rak"
                                        data-toggle="modal" data-target="#modalEditRak"
                                        data-id="{{ $item->id }}"
                                        data-nama_rak="{{ $item->nama_rak }}"
                                        data-keterangan="{{ $item->keterangan }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm waves-effect btn-hapus-rak"
                                        data-toggle="modal" data-target="#modalHapusRak"
                                        data-id="{{ $item->id }}"
                                        data-nama_rak="{{ $item->nama_rak }}"
                                        data-keterangan="{{ $item->keterangan }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="mdi mdi-bookshelf mdi-36px d-block mb-2"></i>
                                    Belum ada data rak
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-2">
                    {{ $rak->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahRak" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-plus-circle mr-1"></i> Tambah Rak</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('admin.rak.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Rak <span class="text-danger">*</span></label>
                        <input type="text" name="nama_rak" class="form-control @error('nama_rak') is-invalid @enderror"
                            value="{{ old('nama_rak') }}" placeholder="Contoh: Rak A1" required>
                        @error('nama_rak')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"
                            placeholder="Keterangan rak (opsional)">{{ old('keterangan') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        <i class="mdi mdi-content-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade" id="modalEditRak" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil mr-1"></i> Edit Rak</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formEditRak" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Rak <span class="text-danger">*</span></label>
                        <input type="text" id="edit_nama_rak" name="nama_rak" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea id="edit_keterangan" name="keterangan" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning waves-effect waves-light">
                        <i class="mdi mdi-content-save mr-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal fade" id="modalHapusRak" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="mdi mdi-alert mr-1"></i> Hapus Rak</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formHapusRak" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center">
                    <i class="mdi mdi-delete-forever mdi-48px text-danger"></i>
                    <p class="mt-2">Yakin ingin menghapus rak:</p>
                    <strong id="hapus_nama_rak"></strong>
                    <p class="text-muted mt-1 mb-0"><small>Data tidak bisa dikembalikan!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect">
                        <i class="mdi mdi-delete mr-1"></i> Hapus
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
        $('.btn-edit-rak').on('click', function() {
            var btn = $(this);
            var id = btn.data('id');
            $('#edit_nama_rak').val(btn.data('nama_rak'));
            $('#edit_keterangan').val(btn.data('keterangan'));
            $('#formEditRak').attr('action', '/admin/rak/' + id);
        });

        $('.btn-hapus-rak').on('click', function() {
            var btn = $(this);
            $('#hapus_nama_rak').text(btn.data('nama_rak'));
            $('#formHapusRak').attr('action', '/admin/rak/' + btn.data('id'));
        });

        @if($errors->any())
        $('#modalTambahRak').modal('show');
        @endif
    });
</script>
@endpush