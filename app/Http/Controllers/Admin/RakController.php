<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index()
    {
        $rak = Rak::latest()->paginate(10);
        return view('admin.rak.index', compact('rak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rak' => 'required|unique:rak,nama_rak',
            'keterangan' => 'nullable',
        ]);

        Rak::create($request->all());

        return back()->with('success', 'Rak berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $rak = Rak::findOrFail($id);

        $request->validate([
            'nama_rak' => 'required|unique:rak,nama_rak,' . $id,
            'keterangan' => 'nullable',
        ]);

        $rak->update($request->all());

        return back()->with('success', 'Rak berhasil diupdate');
    }

    public function destroy($id)
    {
        Rak::findOrFail($id)->delete();

        return back()->with('success', 'Rak berhasil dihapus');
    }
}
