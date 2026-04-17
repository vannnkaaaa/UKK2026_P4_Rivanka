<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        $query = Peminjaman::with(['user', 'buku'])->latest();

        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        $peminjamans  = $query->paginate(10);
        $totalPending = Peminjaman::where('status', 'pending')->count();

        return view('petugas.peminjaman.index', compact('peminjamans', 'totalPending'));
    }

    public function terima($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Peminjaman sudah diproses sebelumnya.');
        }

        $buku = Buku::findOrFail($peminjaman->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis, tidak bisa diterima.');
        }

        $peminjaman->buku->decrement('stok');

        $peminjaman->update([
            'status'    => 'diterima',
            'tgl_pinjam' => now(),
        ]);

        return back()->with('success', 'Peminjaman berhasil diterima.');
    }

    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Peminjaman sudah diproses sebelumnya.');
        }

        $peminjaman->update(['status' => 'ditolak']);

        return back()->with('success', 'Peminjaman berhasil ditolak.');
    }
}
