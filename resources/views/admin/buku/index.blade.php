@extends('layouts.master')

@section('title', 'Manajemen Buku')
@section('breadcrumb', 'Buku')
@section('page-title', 'Manajemen Buku')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="header-title mt-0 mb-0">
                        <i class="mdi mdi-book-multiple mr-1"></i> Daftar Buku
                    </h5>
                    <button type="button" class="btn btn-primary waves-effect waves-light"
                        data-toggle="modal" data-target="#modalTambahBuku">
                        <i class="mdi mdi-plus mr-1"></i> Tambah Buku
                    </button>
                </div>

                {{-- Error validasi --}}
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
                                <th>Judul</th>
                                <th>ISBN</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Rak</th>
                                <th>Kelas</th>
                                <th width="80">Stok</th>
                                <th width="130">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bukus as $i => $buku)
                            <tr>
                                <td>{{ $bukus->firstItem() + $i }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->isbn }}</td>
                                <td>{{ $buku->pengarang->nama ?? '-' }}</td>
                                <td>{{ $buku->penerbit->nama ?? '-' }}</td>
                                <td>{{ $buku->rak->nama_rak ?? '-' }}</td>
                                <td>{{ $buku->kelas->nama_kelas ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $buku->stok > 0 ? 'badge-success' : 'badge-danger' }} badge-pill">
                                        {{ $buku->stok }}
                                    </span>
                                </td>
                                <td>
                                    {{-- Tombol Edit --}}
                                    <button type="button" class="btn btn-warning btn-sm waves-effect btn-edit-buku"
                                        data-toggle="modal" data-target="#modalEditBuku"
                                        data-id="{{ $buku->id }}"
                                        data-judul="{{ $buku->judul }}"
                                        data-isbn="{{ $buku->isbn }}"
                                        data-stok="{{ $buku->stok }}"
                                        data-pengarang_id="{{ $buku->pengarang_id }}"
                                        data-penerbit_id="{{ $buku->penerbit_id }}"
                                        data-rak_id="{{ $buku->rak_id }}"
                                        data-kelas_id="{{ $buku->kelas_id }}"
                                        data-tahun="{{ $buku->tahun_terbit }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    {{-- Tombol Hapus --}}
                                    <button type="button" class="btn btn-danger btn-sm waves-effect btn-hapus-buku"
                                        data-toggle="modal" data-target="#modalHapusBuku"
                                        data-id="{{ $buku->id }}"
                                        data-judul="{{ $buku->judul }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    <i class="mdi mdi-book-off mdi-36px d-block mb-2"></i>
                                    Belum ada data buku
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-end mt-2">
                    {{ $bukus->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')

{{-- ===== MODAL TAMBAH BUKU ===== --}}
<div class="modal fade" id="modalTambahBuku" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-plus-circle mr-1"></i> Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('admin.buku.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Judul Buku <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                    value="{{ old('judul') }}" placeholder="Masukkan judul buku" required>
                                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ISBN</label>
                                <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror"
                                    value="{{ old('isbn') }}" placeholder="978-xxx-xxx">
                                @error('isbn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pengarang <span class="text-danger">*</span></label>
                                <select name="pengarang_id" class="form-control @error('pengarang_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Pengarang --</option>
                                    @foreach($pengarangs as $p)
                                        <option value="{{ $p->id }}" {{ old('pengarang_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pengarang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Penerbit <span class="text-danger">*</span></label>
                                <select name="penerbit_id" class="form-control @error('penerbit_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Penerbit --</option>
                                    @foreach($penerbits as $p)
                                        <option value="{{ $p->id }}" {{ old('penerbit_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('penerbit_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Rak Buku</label>
                                <select name="rak_id" class="form-control">
                                    <option value="">-- Pilih Rak --</option>
                                    @foreach($raks as $r)
                                        <option value="{{ $r->id }}" {{ old('rak_id') == $r->id ? 'selected' : '' }}>
                                            {{ $r->nama_rak }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kelas / Kategori</label>
                                <select name="kelas_id" class="form-control">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                                    value="{{ old('stok', 1) }}" min="0" required>
                                @error('stok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" class="form-control"
                                    value="{{ old('tahun_terbit', date('Y')) }}" min="1900" max="{{ date('Y') }}">
                            </div>
                        </div>
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

{{-- ===== MODAL EDIT BUKU ===== --}}
<div class="modal fade" id="modalEditBuku" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil mr-1"></i> Edit Buku</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formEditBuku" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Judul Buku <span class="text-danger">*</span></label>
                                <input type="text" id="edit_judul" name="judul" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ISBN</label>
                                <input type="text" id="edit_isbn" name="isbn" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pengarang <span class="text-danger">*</span></label>
                                <select id="edit_pengarang_id" name="pengarang_id" class="form-control" required>
                                    <option value="">-- Pilih Pengarang --</option>
                                    @foreach($pengarangs as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Penerbit <span class="text-danger">*</span></label>
                                <select id="edit_penerbit_id" name="penerbit_id" class="form-control" required>
                                    <option value="">-- Pilih Penerbit --</option>
                                    @foreach($penerbits as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Rak Buku</label>
                                <select id="edit_rak_id" name="rak_id" class="form-control">
                                    <option value="">-- Pilih Rak --</option>
                                    @foreach($raks as $r)
                                        <option value="{{ $r->id }}">{{ $r->nama_rak }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kelas / Kategori</label>
                                <select id="edit_kelas_id" name="kelas_id" class="form-control">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Stok <span class="text-danger">*</span></label>
                                <input type="number" id="edit_stok" name="stok" class="form-control" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tahun Terbit</label>
                                <input type="number" id="edit_tahun" name="tahun_terbit" class="form-control">
                            </div>
                        </div>
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

{{-- ===== MODAL HAPUS BUKU ===== --}}
<div class="modal fade" id="modalHapusBuku" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="mdi mdi-alert mr-1"></i> Hapus Buku</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formHapusBuku" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center">
                    <i class="mdi mdi-delete-forever mdi-48px text-danger"></i>
                    <p class="mt-2">Yakin ingin menghapus buku:</p>
                    <strong id="hapus_judul_buku"></strong>
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

    // isi modal edit
    $('.btn-edit-buku').on('click', function() {
        var btn = $(this);
        var id = btn.data('id');
        $('#edit_judul').val(btn.data('judul'));
        $('#edit_isbn').val(btn.data('isbn'));
        $('#edit_stok').val(btn.data('stok'));
        $('#edit_tahun').val(btn.data('tahun'));
        $('#edit_pengarang_id').val(btn.data('pengarang_id'));
        $('#edit_penerbit_id').val(btn.data('penerbit_id'));
        $('#edit_rak_id').val(btn.data('rak_id'));
        $('#edit_kelas_id').val(btn.data('kelas_id'));
        $('#formEditBuku').attr('action', '/admin/buku/' + id);
    });

    // isi modal hapus
    $('.btn-hapus-buku').on('click', function() {
        var btn = $(this);
        $('#hapus_judul_buku').text(btn.data('judul'));
        $('#formHapusBuku').attr('action', '/admin/buku/' + btn.data('id'));
    });

    // buka modal tambah jika ada error validasi
    @if($errors->any() && session('open_modal') == 'modalTambahBuku')
        $('#modalTambahBuku').modal('show');
    @endif

});
</script>
@endpush
