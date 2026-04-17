<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $user   = Auth::user();
        $status = $request->get('status', 'semua');

        $query = Peminjaman::where('user_id', $user->id)
            ->with('buku')
            ->latest();

        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        $peminjaman  = $query->paginate(10);
        $totalPending = Peminjaman::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        // Buku yang masih ada stoknya
        $bukus = Buku::where('stok', '>', 0)->orderBy('judul')->get();

        return view('anggota.peminjaman.index', compact('peminjaman', 'bukus', 'totalPending'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id'             => 'required|exists:buku,id',
            'tgl_kembali_rencana' => 'required|date|after:today',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis, tidak bisa dipinjam.');
        }

        // Cek apakah masih ada pinjaman aktif buku yang sama
        $sudahPinjam = Peminjaman::where('user_id', Auth::id())
            ->where('buku_id', $request->buku_id)
            ->whereIn('status', ['pending', 'diterima'])
            ->exists();

        if ($sudahPinjam) {
            return back()->with('error', 'Kamu masih meminjam buku ini.');
        }

        $jumlahAktif = Peminjaman::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'diterima'])
            ->count();

        if ($jumlahAktif >= 2) {
            return back()->with('error', 'Maksimal hanya boleh meminjam 2 buku.');
        }

        Peminjaman::create([
            'user_id'             => Auth::id(),
            'buku_id'             => $request->buku_id,
            'jumlah'              => 1,
            'tgl_pinjam'          => now(),
            'tgl_kembali_rencana' => $request->tgl_kembali_rencana,
            'tanggal_kembali'     => $request->tgl_kembali_rencana,
            'status'              => 'pending',
        ]);

        return back()->with('success', 'Peminjaman berhasil diajukan! Menunggu konfirmasi petugas.');
    }
}
