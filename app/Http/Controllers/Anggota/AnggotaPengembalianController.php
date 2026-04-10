<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnggotaPengembalianController extends Controller
{
    public function index()
    {
        return view('anggota.pengembalian.index');
    }

    public function store(Request $request)
    {
        return back()->with('success', 'Pengembalian berhasil');
    }
}