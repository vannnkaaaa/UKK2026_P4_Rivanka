<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = User::where('role', 'anggota')->latest()->paginate(5);
        $kelas    = \App\Models\Kelas::all();
        return view('admin.anggota.index', compact('anggotas', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'nis'      => 'nullable|unique:users,nis',
            'no_kartu' => 'required|unique:users,no_kartu',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'nis'         => $request->nis,
            'no_kartu'    => $request->no_kartu,
            'alamat'      => $request->alamat,
            'kelas_id' => $request->kelas_id,
            'status_aktif' => 1,
            'password'    => Hash::make($request->password),
            'role'        => 'anggota',
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $anggota = User::findOrFail($id);

        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $id,
            'nis'      => 'nullable|unique:users,nis,' . $id,
            'no_kartu' => 'required|unique:users,no_kartu,' . $id,
        ]);

        $data = $request->only(['name', 'email', 'nis', 'no_kartu', 'alamat', 'status_aktif', 'kelas_id']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $anggota->update($data);

        return redirect()->back()->with('success', 'Anggota berhasil diupdate');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Anggota berhasil dihapus');
    }
}
