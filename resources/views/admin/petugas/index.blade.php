@extends('layouts.master')

@section('title', 'Manajemen Petugas')
@section('breadcrumb', 'Petugas')
@section('page-title', 'Manajemen Petugas')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="header-title mt-0 mb-0">
                        <i class="mdi mdi-account-tie mr-1"></i> Daftar Petugas
                    </h5>
                    <button type="button" class="btn btn-primary waves-effect waves-light"
                        data-toggle="modal" data-target="#modalTambah">
                        <i class="mdi mdi-plus mr-1"></i> Tambah Petugas
                    </button>
                </div>

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tgl Dibuat</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $i => $petugas)
                            <tr>
                                <td>{{ $items->firstItem() + $i }}</td>
                                <td>
                                    <i class="mdi mdi-account-tie text-primary mr-1"></i>
                                    {{ $petugas->name }}
                                </td>
                                <td>{{ $petugas->email }}</td>
                                <td>{{ $petugas->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm btn-edit"
                                        data-toggle="modal" data-target="#modalEdit"
                                        data-id="{{ $petugas->id }}"
                                        data-name="{{ $petugas->name }}"
                                        data-email="{{ $petugas->email }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-hapus"
                                        data-toggle="modal" data-target="#modalHapus"
                                        data-id="{{ $petugas->id }}"
                                        data-name="{{ $petugas->name }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="mdi mdi-account-off mdi-36px d-block mb-2"></i>
                                    Belum ada data petugas
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-2">
                    {{ $items->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-account-plus mr-1"></i> Tambah Petugas
                </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('admin.petugas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Nama lengkap petugas" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="email@example.com" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Minimal 8 karakter" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        <i class="mdi mdi-content-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-account-edit mr-1"></i> Edit Petugas
                </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formEdit" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" id="edit_name" name="name"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" id="edit_email" name="email"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password Baru
                            <small class="text-muted">(kosongkan jika tidak diubah)</small>
                        </label>
                        <input type="password" name="password"
                            class="form-control"
                            placeholder="Isi jika ingin ubah password">
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
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="mdi mdi-alert mr-1"></i> Hapus Petugas
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="formHapus" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center">
                    <i class="mdi mdi-account-remove mdi-48px text-danger"></i>
                    <p class="mt-2">Yakin hapus petugas:</p>
                    <strong id="hapus_nama"></strong>
                    <p class="text-muted mt-1 mb-0">
                        <small>Data tidak bisa dikembalikan!</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm">
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
    // Isi modal edit
    $('.btn-edit').on('click', function() {
        var btn = $(this);
        $('#edit_name').val(btn.data('name'));
        $('#edit_email').val(btn.data('email'));
        $('#formEdit').attr('action', '/admin/petugas/' + btn.data('id'));
    });

    // Isi modal hapus
    $('.btn-hapus').on('click', function() {
        var btn = $(this);
        $('#hapus_nama').text(btn.data('name'));
        $('#formHapus').attr('action', '/admin/petugas/' + btn.data('id'));
    });

    // Buka modal tambah jika ada error
    @if($errors->any())
        $('#modalTambah').modal('show');
    @endif
});
</script>
@endpush
