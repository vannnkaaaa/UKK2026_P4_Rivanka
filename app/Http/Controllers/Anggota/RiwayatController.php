<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class RiwayatController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['buku', 'pengembalian.denda'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('anggota.riwayat.index', compact('data'));
    }
}
