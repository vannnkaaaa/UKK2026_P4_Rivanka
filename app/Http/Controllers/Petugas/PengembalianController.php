<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Denda;
use App\Models\Buku;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.buku'])
            ->latest()
            ->paginate(10);

        return view('petugas.pengembalian.index', compact('pengembalians'));
    }

    // Terima pengembalian → tambah stok, hitung denda jika terlambat
    public function terima($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.buku')->findOrFail($id);

        if ($pengembalian->status !== 'pending') {
            return back()->with('error', 'Pengembalian sudah diproses sebelumnya.');
        }

        $peminjaman = $pengembalian->peminjaman;

        // Hitung denda jika terlambat (Rp 1.000 per hari)
        $tglKembaliRencana = Carbon::parse($peminjaman->tgl_kembali_rencana);
        $tglKembaliAktual = Carbon::parse($pengembalian->tanggal_kembali);
        $selisihHari       = $tglKembaliAktual->diffInDays($tglKembaliRencana, false);

        // selisihHari negatif = terlambat
        if ($selisihHari < 0) {
            $jumlahDenda = abs($selisihHari) * 1000;
            Denda::create([
                'pengembalian_id' => $pengembalian->id,
                'jumlah'          => $jumlahDenda,
                'hari_terlambat'  => abs($selisihHari),
                'status_lunas'    => false,
            ]);
        }

        // Update status pengembalian & peminjaman
        $pengembalian->update(['status' => 'diterima']);
        $peminjaman->update(['status' => 'selesai']);

        // Kembalikan stok buku
        $peminjaman->buku->increment('stok');

        return back()->with('success', 'Pengembalian diterima.' . ($selisihHari < 0 ? ' Denda: Rp ' . number_format(abs($selisihHari) * 1000, 0, ',', '.') : ''));
    }

    // Tolak pengembalian
    public function tolak($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        if ($pengembalian->status !== 'pending') {
            return back()->with('error', 'Pengembalian sudah diproses sebelumnya.');
        }

        $pengembalian->update(['status' => 'ditolak']);

        return back()->with('success', 'Pengembalian ditolak.');
    }
}
