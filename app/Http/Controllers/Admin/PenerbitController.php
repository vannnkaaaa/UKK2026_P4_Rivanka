<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbit = Penerbit::latest()->get();
        return view('admin.penerbit.index', compact('penerbit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Penerbit::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('admin.penerbit.index')
            ->with('success', 'Data penerbit berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $penerbit = Penerbit::findOrFail($id);

        $penerbit->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('admin.penerbit.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();

        return redirect()->route('admin.penerbit.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
