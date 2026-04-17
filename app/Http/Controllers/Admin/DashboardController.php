<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Denda;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Rak;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku        = Buku::count();
        $totalAnggota     = User::where('role', 'anggota')->count();
        $totalPeminjaman  = Peminjaman::where('status', 'diterima')->count();
        $totalDenda = Denda::where('status_lunas', 0)->count();
        $totalRak         = Rak::count();
        $totalPenerbit    = Penerbit::count();
        $totalPengarang   = Pengarang::count();
        $totalPetugas     = User::where('role', 'petugas')->count();

        $peminjamanterbaru = Peminjaman::with(['user', 'buku'])
            ->latest()
            ->take(5)
            ->get();

        $dendaBelumLunas = Denda::with(['pengembalian.peminjaman.anggota'])
            ->where('status_lunas', 0)
            ->get();


        return view('admin.dashboard.index', compact(
            'totalBuku',
            'totalAnggota',
            'totalPeminjaman',
            'totalDenda',
            'totalRak',
            'totalPenerbit',
            'totalPengarang',
            'totalPetugas',
            'peminjamanterbaru',
            'dendaBelumLunas'
        ));
    }
}
