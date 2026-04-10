@extends('layouts.master')

@section('title', 'Manajemen Anggota')
@section('breadcrumb', 'Anggota')
@section('page-title', 'Manajemen Anggota')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="header-title mt-0 mb-0">
                        <i class="mdi mdi-account-multiple mr-1"></i> Daftar Anggota
                    </h5>
                    <button type="button" class="btn btn-primary waves-effect waves-light"
                        data-toggle="modal" data-target="#modalTambahAnggota">
                        <i class="mdi mdi-plus mr-1"></i> Tambah Anggota
                    </button>
                </div>

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama</th>
                                <th>No Kartu</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th width="100">Status</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($anggotas as $i => $anggota)
                            <tr>
                                <td>{{ $anggotas->firstItem() + $i }}</td>
                                <td>{{ $anggota->name }}</td>
                                <td><span class="badge badge-secondary">{{ $anggota->no_kartu }}</span></td>
                                <td>{{ $anggota->email }}</td>
                                <td>{{ $anggota->alamat ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $anggota->status_aktif ? 'badge-success' : 'badge-danger' }}">
                                        {{ $anggota->status_aktif ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm btn-edit-anggota"
                                        data-toggle="modal" data-target="#modalEditAnggota"
                                        data-id="{{ $anggota->id }}"
                                        data-name="{{ $anggota->name }}"
                                        data-email="{{ $anggota->email }}"
                                        data-no_kartu="{{ $anggota->no_kartu }}"
                                        data-alamat="{{ $anggota->alamat }}"
                                        data-status="{{ $anggota->status_aktif }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-hapus-anggota"
                                        data-toggle="modal" data-target="#modalHapusAnggota"
                                        data-id="{{ $anggota->id }}"
                                        data-name="{{ $anggota->name }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="mdi mdi-account-off mdi-36px d-block mb-2"></i>
                                    Belum ada data anggota
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-2">{{ $anggotas->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahAnggota" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-account-plus mr-1"></i> Tambah Anggota</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('admin.anggota.store') }}" method="POST">
                @csrf       
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="Nama lengkap" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>No Kartu Anggota <span class="text-danger">*</span></label>
                        <input type="text" name="no_kartu" class="form-control @error('no_kartu') is-invalid @enderror"
                            value="{{ old('no_kartu') }}" placeholder="Contoh: ANG-001" required>
                        @error('no_kartu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="email@example.com" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Minimal 8 karakter" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2"
                            placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
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
<div class="modal fade" id="modalEditAnggota" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-account-edit mr-1"></i> Edit Anggota</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formEditAnggota" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No Kartu Anggota</label>
                        <input type="text" id="edit_no_kartu" name="no_kartu" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" id="edit_email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password Baru <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                        <input type="password" name="password" class="form-control" placeholder="Isi jika ingin ubah password">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea id="edit_alamat" name="alamat" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select id="edit_status" name="status_aktif" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
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
<div class="modal fade" id="modalHapusAnggota" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="mdi mdi-alert mr-1"></i> Hapus Anggota</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formHapusAnggota" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center">
                    <i class="mdi mdi-account-remove mdi-48px text-danger"></i>
                    <p class="mt-2">Yakin hapus anggota:</p>
                    <strong id="hapus_nama_anggota"></strong>
                    <p class="text-muted mt-1 mb-0"><small>Riwayat peminjaman tetap tersimpan.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm"><i class="mdi mdi-delete mr-1"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('.btn-edit-anggota').on('click', function() {
            var btn = $(this);
            $('#edit_name').val(btn.data('name'));
            $('#edit_email').val(btn.data('email'));
            $('#edit_no_kartu').val(btn.data('no_kartu'));
            $('#edit_alamat').val(btn.data('alamat'));
            $('#edit_status').val(btn.data('status'));
            $('#formEditAnggota').attr('action', '/admin/anggota/' + btn.data('id'));
        });
        $('.btn-hapus-anggota').on('click', function() {
            $('#hapus_nama_anggota').text($(this).data('name'));
            $('#formHapusAnggota').attr('action', '/admin/anggota/' + $(this).data('id'));
        });
    });
</script>
@endpush