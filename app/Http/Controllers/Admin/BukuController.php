<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with(['penerbit', 'pengarang', 'rak'])
            ->latest()
            ->paginate(10);

        $penerbits  = Penerbit::all();
        $pengarangs = Pengarang::all();
        $raks       = Rak::all();

        return view('admin.buku.index', compact(
            'bukus',
            'penerbits',
            'pengarangs',
            'raks'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required',
            'pengarang_id' => 'required',
            'penerbit_id'  => 'required',
            'stok'         => 'required|numeric',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('buku', 'public');
        }

        Buku::create($data);

        return back()->with('success', 'Buku berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'judul'        => 'required',
            'pengarang_id' => 'required',
            'penerbit_id'  => 'required',
            'stok'         => 'required|numeric',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // hapus foto lama kalau ada
            if ($buku->foto) {
                Storage::disk('public')->delete($buku->foto);
            }
            $data['foto'] = $request->file('foto')->store('buku', 'public');
        }

        $buku->update($data);

        return back()->with('success', 'Buku berhasil diupdate');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->foto) {
            Storage::disk('public')->delete($buku->foto);
        }

        $buku->delete();

        return back()->with('success', 'Buku berhasil dihapus');
    }
}
