<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        // sementara dummy dulu biar tampil
        $anggota = [
            ['id' => 1, 'nama' => 'Rivanka', 'email' => 'rivanka@gmail.com'],
            ['id' => 2, 'nama' => 'Adam', 'email' => 'adam@gmail.com'],
        ];

        return view('admin.anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        // nanti simpan ke database
        return redirect()->route('admin.anggota.index');
    }
}
