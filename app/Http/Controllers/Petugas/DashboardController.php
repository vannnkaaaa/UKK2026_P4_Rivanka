<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Denda;
use App\Models\Buku;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPending = Peminjaman::where('status', 'pending')->count();

        $totalDipinjam = Peminjaman::where('status', 'diterima')->count();

        $totalKembaliPending = Pengembalian::where('status', 'pending')->count();

        $totalDendaBelumLunas = Denda::where('status_lunas', false)->count();

        // 5 peminjaman pending terbaru untuk ditampilkan di dashboard
        $peminjamanPending = Peminjaman::where('status', 'pending')
            ->with(['user', 'buku'])
            ->latest()
            ->take(5)
            ->get();

        // Buku dengan stok <= 3
        $bukuStokRendah = Buku::where('stok', '<=', 3)
            ->orderBy('stok')
            ->take(5)
            ->get();

        return view('petugas.dashboard.index', compact(
            'totalPending',
            'totalDipinjam',
            'totalKembaliPending',
            'totalDendaBelumLunas',
            'peminjamanPending',
            'bukuStokRendah'
        ));
    }
}
