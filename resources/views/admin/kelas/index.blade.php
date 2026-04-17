@extends('layouts.master')

@section('title', 'Manajemen Kelas')
@section('breadcrumb', 'Kelas')
@section('page-title', 'Manajemen Kelas')

@section('content')

{{-- Summary Cards --}}
<div class="row mb-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;font-size:20px;">
                    <i class="mdi mdi-google-classroom"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold">{{ $totalKelas }}</h4>
                    <small class="text-muted">Total Kelas</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;font-size:20px;">
                    <i class="mdi mdi-account-group"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold">{{ $totalSiswa }}</h4>
                    <small class="text-muted">Total Siswa</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;font-size:20px;">
                    <i class="mdi mdi-chart-bar"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold">{{ $rataRata }}</h4>
                    <small class="text-muted">Rata-rata per Kelas</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="header-title mt-0 mb-0">
                        <i class="mdi mdi-google-classroom mr-1"></i> Daftar Kelas
                    </h5>
                    <button type="button" class="btn btn-primary waves-effect waves-light"
                        data-toggle="modal" data-target="#modalTambahKelas">
                        <i class="mdi mdi-plus mr-1"></i> Tambah Kelas
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
                                <th>Nama Kelas</th>
                                <th>Tingkat</th>
                                <th>Jurusan</th>
                                <th>Wali Kelas</th>
                                <th width="120">Jumlah Siswa</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelas as $i => $k)
                            <tr>
                                <td>{{ $kelas->firstItem() + $i }}</td>
                                <td><strong>{{ $k->nama_kelas }}</strong></td>
                                <td>
                                    <span class="badge badge-primary badge-pill">{{ $k->tingkat }}</span>
                                </td>
                                <td>
                                    @if($k->jurusan)
                                    <span class="badge badge-info badge-pill">{{ $k->jurusan }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $k->wali_kelas ?? '-' }}</td>
                                <td>{{ $k->anggota_count }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm waves-effect btn-edit-kelas"
                                        data-toggle="modal" data-target="#modalEditKelas"
                                        data-id="{{ $k->id }}"
                                        data-nama_kelas="{{ $k->nama_kelas }}"
                                        data-tingkat="{{ $k->tingkat }}"
                                        data-jurusan="{{ $k->jurusan }}"
                                        data-wali_kelas="{{ $k->wali_kelas }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm waves-effect btn-hapus-kelas"
                                        data-toggle="modal" data-target="#modalHapusKelas"
                                        data-id="{{ $k->id }}"
                                        data-nama_kelas="{{ $k->nama_kelas }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="mdi mdi-google-classroom mdi-36px d-block mb-2"></i>
                                    Belum ada data kelas
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-2">
                    {{ $kelas->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahKelas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-plus-circle mr-1"></i> Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror"
                            value="{{ old('nama_kelas') }}" placeholder="Contoh: XII Bahasa 1" required>
                        @error('nama_kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tingkat <span class="text-danger">*</span></label>
                                <select name="tingkat" class="form-control @error('tingkat') is-invalid @enderror" required>
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="X" {{ old('tingkat') == 'X' ? 'selected' : '' }}>X</option>
                                    <option value="XI" {{ old('tingkat') == 'XI' ? 'selected' : '' }}>XI</option>
                                    <option value="XII" {{ old('tingkat') == 'XII' ? 'selected' : '' }}>XII</option>
                                </select>
                                @error('tingkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jurusan</label>
                                <input type="text" name="jurusan" class="form-control"
                                    value="{{ old('jurusan') }}" placeholder="Contoh: IPA, IPS, Bahasa">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Wali Kelas</label>
                                <input type="text" name="wali_kelas" class="form-control"
                                    value="{{ old('wali_kelas') }}" placeholder="Nama wali kelas">
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

{{-- MODAL EDIT --}}
<div class="modal fade" id="modalEditKelas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-pencil mr-1"></i> Edit Kelas</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formEditKelas" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" id="edit_nama_kelas" name="nama_kelas" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tingkat <span class="text-danger">*</span></label>
                                <select id="edit_tingkat" name="tingkat" class="form-control" required>
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jurusan</label>
                                <input type="text" id="edit_jurusan" name="jurusan" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Wali Kelas</label>
                                <input type="text" id="edit_wali_kelas" name="wali_kelas" class="form-control">
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

{{-- MODAL HAPUS --}}
<div class="modal fade" id="modalHapusKelas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="mdi mdi-alert mr-1"></i> Hapus Kelas</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formHapusKelas" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center">
                    <i class="mdi mdi-delete-forever mdi-48px text-danger"></i>
                    <p class="mt-2">Yakin ingin menghapus kelas:</p>
                    <strong id="hapus_nama_kelas"></strong>
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
        $('.btn-edit-kelas').on('click', function() {
            var btn = $(this);
            var id = btn.data('id');
            $('#edit_nama_kelas').val(btn.data('nama_kelas'));
            $('#edit_tingkat').val(btn.data('tingkat'));
            $('#edit_jurusan').val(btn.data('jurusan'));
            $('#edit_wali_kelas').val(btn.data('wali_kelas'));
            $('#formEditKelas').attr('action', '/admin/kelas/' + id);
        });

        $('.btn-hapus-kelas').on('click', function() {
            var btn = $(this);
            $('#hapus_nama_kelas').text(btn.data('nama_kelas'));
            $('#formHapusKelas').attr('action', '/admin/kelas/' + btn.data('id'));
        });

        @if($errors->any())
        $('#modalTambahKelas').modal('show');
        @endif
    });
</script>
@endpush