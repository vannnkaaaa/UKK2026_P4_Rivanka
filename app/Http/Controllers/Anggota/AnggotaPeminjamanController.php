<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnggotaPeminjamanController extends Controller
{
    public function index()
    {
        return view('anggota.peminjaman.index');
    }

    public function store(Request $request)
    {
        // nanti isi logic database
        return back()->with('success', 'Peminjaman berhasil ditambahkan');
    }
}