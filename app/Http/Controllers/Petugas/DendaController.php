<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Denda;

class DendaController extends Controller
{
    public function index()
    {
        $dendas = Denda::with(['pengembalian.peminjaman.user', 'pengembalian.peminjaman.buku'])
            ->latest()
            ->paginate(10);

        return view('petugas.denda.index', compact('dendas'));
    }

    // Tandai denda sudah lunas
    public function lunas($id)
    {
        $denda = Denda::findOrFail($id);

        if ($denda->status_lunas) {
            return back()->with('error', 'Denda sudah lunas sebelumnya.');
        }

        $denda->update(['status_lunas' => true]);

        return back()->with('success', 'Denda berhasil ditandai lunas.');
    }
}
