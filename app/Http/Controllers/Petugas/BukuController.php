<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with(['pengarang', 'penerbit', 'rak'])
            ->when(request('search'), function ($q) {
                $q->where('judul', 'like', '%' . request('search') . '%');
            })
            ->latest()
            ->paginate(10);

        return view('petugas.buku.index', compact('bukus'));
    }
}