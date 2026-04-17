<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalDipinjam = Peminjaman::where('user_id', $user->id)
            ->where('status', 'diterima')
            ->count();

        $totalPending = Peminjaman::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        $totalSelesai = Peminjaman::where('user_id', $user->id)
            ->where('status', 'selesai')
            ->count();

        // Hitung total denda belum lunas milik anggota ini
        $totalDenda = \App\Models\Denda::whereHas('pengembalian.peminjaman', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status_lunas', false)->sum('jumlah');

        // Peminjaman aktif (pending + diterima) untuk ditampilkan di tabel
        $peminjamantAktif = Peminjaman::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'diterima'])
            ->with('buku')
            ->latest()
            ->take(5)
            ->get();

        return view('anggota.dashboard.index', compact(
            'totalDipinjam',
            'totalPending',
            'totalSelesai',
            'totalDenda',
            'peminjamantAktif'
        ));
    }
}
