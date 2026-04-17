<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $items = User::where('role', 'petugas')->latest()->paginate(10);
        return view('admin.petugas.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'petugas',
        ]);

        return back()->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $petugas = User::where('role', 'petugas')->findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8']);
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return back()->with('success', 'Data petugas berhasil diupdate.');
    }

    public function destroy($id)
    {
        $petugas = User::where('role', 'petugas')->findOrFail($id);
        $petugas->delete();

        return back()->with('success', 'Petugas berhasil dihapus.');
    }
}
