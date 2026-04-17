<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with(['pengarang', 'penerbit', 'rak'])
            ->latest()
            ->get();

        return view('anggota.buku.index', compact('bukus'));
    }
}