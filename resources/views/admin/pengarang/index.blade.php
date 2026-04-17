@extends('layouts.master')

@section('title', 'Manajemen Pengarang')
@section('breadcrumb', 'Pengarang')
@section('page-title', 'Manajemen Pengarang')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <div class="d-flex justify-content-between mb-3">
                    <h5 class="header-title">
                        <i class="mdi mdi-account-edit"></i> Data Pengarang
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
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pengarang as $i => $pg)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $pg->nama }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-edit"
                                    data-id="{{ $pg->id }}"
                                    data-nama="{{ $pg->nama }}"
                                    data-toggle="modal"
                                    data-target="#modalEdit">
                                    Edit
                                </button>

                                <button class="btn btn-danger btn-sm btn-hapus"
                                    data-id="{{ $pg->id }}"
                                    data-nama="{{ $pg->nama }}"
                                    data-toggle="modal"
                                    data-target="#modalHapus">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Data kosong</td>
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
        <form action="{{ route('admin.pengarang.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Pengarang</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required>
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
                    <h5>Edit Pengarang</h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="edit_nama" name="nama" class="form-control">
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
        $('#formEdit').attr('action', '/admin/pengarang/' + $(this).data('id'));
    });

    $('.btn-hapus').click(function() {
        $('#nama_hapus').text($(this).data('nama'));
        $('#formHapus').attr('action', '/admin/pengarang/' + $(this).data('id'));
    });
</script>
@endpush