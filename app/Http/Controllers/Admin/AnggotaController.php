<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // kita pakai user sebagai anggota
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = User::where('role', 'anggota')
            ->latest()
            ->paginate(5);
        return view('admin.anggota.index', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'no_kartu' => 'required|unique:users,no_kartu',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_kartu' => $request->no_kartu,
            'alamat' => $request->alamat,
            'status_aktif' => 1,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $anggota = User::findOrFail($id);

        $data = $request->only(['name', 'email', 'no_kartu', 'alamat', 'status_aktif']);

        if ($request->password) {
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
