<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    // Daftar buku yang bisa dikembalikan
    public function index()
    {
        $user = Auth::user();

        // Peminjaman yang sudah diterima dan belum dikembalikan
        $peminjamans = Peminjaman::where('user_id', $user->id)
            ->where('status', 'diterima')
            ->whereDoesntHave('pengembalian')
            ->with('buku')
            ->latest()
            ->paginate(10);

        // Riwayat pengembalian
        $riwayatKembali = Pengembalian::whereHas('peminjaman', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with('peminjaman.buku')->latest()->take(5)->get();

        return view('anggota.pengembalian.index', compact('peminjamans', 'riwayatKembali'));
    }

    // Anggota ajukan pengembalian
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
        ]);

        $peminjaman = Peminjaman::where('id', $request->peminjaman_id)
            ->where('user_id', Auth::id())
            ->where('status', 'diterima')
            ->firstOrFail();

        // Cek sudah pernah ajukan pengembalian belum
        $sudahAjukan = Pengembalian::where('peminjaman_id', $peminjaman->id)
            ->whereIn('status', ['pending', 'diterima'])
            ->exists();

        if ($sudahAjukan) {
            return back()->with('error', 'Pengembalian sudah diajukan, menunggu konfirmasi petugas.');
        }

        Pengembalian::create([
            'peminjaman_id'      => $peminjaman->id,
            'tanggal_kembali' => now(),
            'status'             => 'pending',
        ]);

        return back()->with('success', 'Pengembalian berhasil diajukan! Menunggu konfirmasi petugas.');
    }
}
