<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::withCount(['anggota'])->latest()->paginate(10);

        $totalSiswa = \App\Models\User::where('role', 'anggota')->count();
        $totalKelas = Kelas::count();
        $rataRata   = $totalKelas > 0 ? round($totalSiswa / $totalKelas) : 0;

        return view('admin.kelas.index', compact('kelas', 'totalSiswa', 'totalKelas', 'rataRata'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas'   => 'required|unique:kelas,nama_kelas',
            'tingkat'      => 'required',
            'jurusan'      => 'nullable',
            'wali_kelas'   => 'nullable',
        ]);

        Kelas::create($request->all());

        return back()->with('success', 'Kelas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas'   => 'required|unique:kelas,nama_kelas,' . $id,
            'tingkat'      => 'required',
            'jurusan'      => 'nullable',
            'wali_kelas'   => 'nullable',
        ]);

        $kelas->update($request->all());

        return back()->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();

        return back()->with('success', 'Kelas berhasil dihapus');
    }
}
