@extends('anggota.master')

@section('title', 'Katalog Buku')
@section('breadcrumb', 'Katalog Buku')
@section('page-title', 'Katalog Buku')

@section('content')
<div class="row">
    @forelse($bukus as $buku)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">

            {{-- FOTO --}}
            <img src="{{ $buku->foto ? asset('storage/' . $buku->foto) : 'https://via.placeholder.com/150' }}"
                class="card-img-top"
                style="height:200px; object-fit:cover;">

            {{-- BODY --}}
            <div class="card-body">
                <h6 class="font-weight-bold">{{ $buku->judul }}</h6>

                <small class="text-muted d-block">
                    {{ $buku->pengarang->nama ?? '-' }}
                </small>

                <span class="badge badge-info mt-1">
                    {{ $buku->kategori ?? '-' }}
                </span>
                <span class="badge badge-info">
                    Stok: {{ $buku->stok }}
                </span>
            </div>

            {{-- FOOTER --}}
            <div class="card-footer text-center">
                @if($buku->stok > 0)
                <span class="badge badge-success">Tersedia</span>
                @else
                <span class="badge badge-danger">Dipinjam</span>
                @endif
            </div>

        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted">
        Belum ada buku
    </div>
    @endforelse
</div>
@endsection