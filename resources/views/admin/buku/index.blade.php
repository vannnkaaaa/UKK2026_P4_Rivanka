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
                                <th width="60">Cover</th>
                                <th>Judul</th>
                                <th>ISBN</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Rak</th>
                                <th>Kategori</th>
                                <th width="80">Stok</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bukus as $i => $buku)
                            <tr>
                                <td>{{ $bukus->firstItem() + $i }}</td>
                                <td class="text-center">
                                    @if($buku->foto)
                                    <img src="{{ asset('storage/' . $buku->foto) }}"
                                        alt="{{ $buku->judul }}"
                                        style="width:45px;height:60px;object-fit:cover;border-radius:4px;cursor:pointer;"
                                        data-toggle="modal" data-target="#modalFoto"
                                        data-foto="{{ asset('storage/' . $buku->foto) }}"
                                        data-judul="{{ $buku->judul }}">
                                    @else
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                        style="width:45px;height:60px;border-radius:4px;margin:auto;">
                                        <i class="mdi mdi-book text-muted"></i>
                                    </div>
                                    @endif
                                </td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->isbn ?? '-' }}</td>
                                <td>{{ $buku->pengarang->nama ?? '-' }}</td>
                                <td>{{ $buku->penerbit->nama ?? '-' }}</td>
                                <td>{{ $buku->rak->nama_rak ?? '-' }}</td>
                                <td>
                                    @if($buku->kategori)
                                    <span class="badge badge-info badge-pill">{{ $buku->kategori }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $buku->stok > 0 ? 'badge-success' : 'badge-danger' }} badge-pill">
                                        {{ $buku->stok }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm waves-effect btn-edit-buku"
                                        data-toggle="modal" data-target="#modalEditBuku"
                                        data-id="{{ $buku->id }}"
                                        data-judul="{{ $buku->judul }}"
                                        data-isbn="{{ $buku->isbn }}"
                                        data-stok="{{ $buku->stok }}"
                                        data-pengarang_id="{{ $buku->pengarang_id }}"
                                        data-penerbit_id="{{ $buku->penerbit_id }}"
                                        data-rak_id="{{ $buku->rak_id }}"
                                        data-kategori="{{ $buku->kategori }}"
                                        data-tahun="{{ $buku->tahun_terbit }}"
                                        data-foto="{{ $buku->foto ? asset('storage/' . $buku->foto) : '' }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
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
                                <td colspan="10" class="text-center text-muted py-4">
                                    <i class="mdi mdi-book-off mdi-36px d-block mb-2"></i>
                                    Belum ada data buku
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-2">
                    {{ $bukus->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')

{{-- MODAL PREVIEW FOTO --}}
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fotoJudul"></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center p-2">
                <img id="fotoPreviewBesar" src="" alt="" style="width:100%;border-radius:6px;">
            </div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH BUKU --}}
<div class="modal fade" id="modalTambahBuku" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-plus-circle mr-1"></i> Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" name="isbn" class="form-control"
                                    value="{{ old('isbn') }}" placeholder="978-xxx-xxx">
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
                                <label>Kategori</label>
                                <input type="text" name="kategori" class="form-control"
                                    value="{{ old('kategori') }}" placeholder="Contoh: Fiksi, Sains, dll">
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
                    <div class="form-group">
                        <label>Cover Buku</label>
                        <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror"
                            accept="image/*" id="inputFotoTambah">
                        @error('foto')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        <div class="mt-2">
                            <img id="previewFotoTambah" src="" alt="" style="display:none;width:80px;height:110px;object-fit:cover;border-radius:4px;">
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

{{-- MODAL EDIT BUKU --}}
<div class="modal fade" id="modalEditBuku" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil mr-1"></i> Edit Buku</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formEditBuku" action="" method="POST" enctype="multipart/form-data">
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
                                <label>Kategori</label>
                                <input type="text" id="edit_kategori" name="kategori" class="form-control"
                                    placeholder="Contoh: Fiksi, Sains, dll">
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
                    <div class="form-group">
                        <label>Cover Buku</label>
                        <div class="mb-2">
                            <img id="previewFotoEdit" src="" alt=""
                                style="width:80px;height:110px;object-fit:cover;border-radius:4px;display:none;">
                            <span id="noFotoEdit" class="text-muted small">Belum ada foto</span>
                        </div>
                        <input type="file" name="foto" class="form-control-file" accept="image/*" id="inputFotoEdit">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
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

{{-- MODAL HAPUS BUKU --}}
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

        // preview foto saat tambah
        $('#inputFotoTambah').on('change', function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewFotoTambah').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file);
            }
        });

        // preview foto saat edit
        $('#inputFotoEdit').on('change', function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewFotoEdit').attr('src', e.target.result).show();
                    $('#noFotoEdit').hide();
                }
                reader.readAsDataURL(file);
            }
        });

        // isi modal edit
        $('.btn-edit-buku').on('click', function() {
            var btn = $(this);
            var id = btn.data('id');
            var foto = btn.data('foto');

            $('#edit_judul').val(btn.data('judul'));
            $('#edit_isbn').val(btn.data('isbn'));
            $('#edit_stok').val(btn.data('stok'));
            $('#edit_tahun').val(btn.data('tahun'));
            $('#edit_pengarang_id').val(btn.data('pengarang_id'));
            $('#edit_penerbit_id').val(btn.data('penerbit_id'));
            $('#edit_rak_id').val(btn.data('rak_id'));
            $('#edit_kategori').val(btn.data('kategori'));
            $('#formEditBuku').attr('action', '/admin/buku/' + id);

            // tampilkan foto existing
            if (foto) {
                $('#previewFotoEdit').attr('src', foto).show();
                $('#noFotoEdit').hide();
            } else {
                $('#previewFotoEdit').hide();
                $('#noFotoEdit').show();
            }

            // reset input file
            $('#inputFotoEdit').val('');
        });

        // isi modal hapus
        $('.btn-hapus-buku').on('click', function() {
            var btn = $(this);
            $('#hapus_judul_buku').text(btn.data('judul'));
            $('#formHapusBuku').attr('action', '/admin/buku/' + btn.data('id'));
        });

        // modal preview foto besar
        $(document).on('click', 'img[data-target="#modalFoto"]', function() {
            $('#fotoPreviewBesar').attr('src', $(this).data('foto'));
            $('#fotoJudul').text($(this).data('judul'));
        });

        @if($errors->any())
        $('#modalTambahBuku').modal('show');
        @endif

    });
</script>
@endpush