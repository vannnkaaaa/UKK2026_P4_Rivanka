@extends('petugas.master')

@section('title', 'Data Buku')
@section('breadcrumb', 'Data Buku')
@section('page-title', 'Data Buku')

@section('content')

<div class="card m-b-30">
    <div class="card-body">
        <h5 class="header-title mt-0 mb-3">
            <i class="mdi mdi-book-multiple mr-1"></i> Daftar Buku
        </h5>

        {{-- Search --}}
        <form method="GET" action="{{ route('petugas.buku.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control"
                    placeholder="Cari judul buku..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="mdi mdi-magnify"></i> Cari
                    </button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>ISBN</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Kategori</th>
                        <th>Rak</th>
                        <th>Stok</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukus as $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ $b->foto ? asset('storage/' . $b->foto) : 'https://via.placeholder.com/50' }}"
                                width="50" height="60" style="object-fit:cover; border-radius:4px;">
                        </td>
                        <td><strong>{{ $b->judul }}</strong></td>
                        <td>{{ $b->isbn ?? '-' }}</td>
                        <td>{{ $b->pengarang->nama ?? '-' }}</td>
                        <td>{{ $b->penerbit->nama ?? '-' }}</td>
                        <td>
                            @if($b->kategori)
                                <span class="badge badge-info">{{ $b->kategori }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $b->rak->nama_rak ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $b->stok > 0 ? 'badge-success' : 'badge-danger' }}">
                                {{ $b->stok }}
                            </span>
                        </td>
                        <td>
                            @if($b->stok > 0)
                                <span class="badge badge-success">Tersedia</span>
                            @else
                                <span class="badge badge-danger">Habis</span>
                            @endif
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
        {{ $bukus->links() }}
    </div>
</div>

@endsection