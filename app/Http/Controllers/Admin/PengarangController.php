<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    public function index()
    {
        $pengarang = Pengarang::latest()->get();
        return view('admin.pengarang.index', compact('pengarang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Pengarang::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('admin.pengarang.index')
            ->with('success', 'Data pengarang berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $pengarang = Pengarang::findOrFail($id);

        $pengarang->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('admin.pengarang.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        $pengarang->delete();

        return redirect()->route('admin.pengarang.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
