@extends('layouts.master')

@section('title', 'Manajemen Penerbit')
@section('breadcrumb', 'Penerbit')
@section('page-title', 'Manajemen Penerbit')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <div class="d-flex justify-content-between mb-3">
                    <h5 class="header-title">
                        <i class="mdi mdi-office-building"></i> Data Penerbit
                    </h5>

                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                        + Tambah
                    </button>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($penerbit as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-edit"
                                    data-id="{{ $p->id }}"
                                    data-nama="{{ $p->nama }}"
                                    data-alamat="{{ $p->alamat }}"
                                    data-toggle="modal"
                                    data-target="#modalEdit">
                                    Edit
                                </button>

                                <button class="btn btn-danger btn-sm btn-hapus"
                                    data-id="{{ $p->id }}"
                                    data-nama="{{ $p->nama }}"
                                    data-toggle="modal"
                                    data-target="#modalHapus">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Data kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection


@push('modal')

{{-- TAMBAH --}}
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form action="{{ route('admin.penerbit.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Penerbit</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>
                    <textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- EDIT --}}
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Penerbit</h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="edit_nama" name="nama" class="form-control mb-2">
                    <textarea id="edit_alamat" name="alamat" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- HAPUS --}}
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog modal-sm">
        <form id="formHapus" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p>Hapus:</p>
                    <strong id="nama_hapus"></strong>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endpush


@push('scripts')
<script>
    $('.btn-edit').click(function() {
        $('#edit_nama').val($(this).data('nama'));
        $('#edit_alamat').val($(this).data('alamat'));
        $('#formEdit').attr('action', '/admin/penerbit/' + $(this).data('id'));
    });

    $('.btn-hapus').click(function() {
        $('#nama_hapus').text($(this).data('nama'));
        $('#formHapus').attr('action', '/admin/penerbit/' + $(this).data('id'));
    });
</script>
@endpush