<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function index()
    {
        $pinjams = Pinjam::all();
        return view('Pinjam.index', compact('pinjams'));
    }

    public function create()
    {
        return view('Pinjam.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pinjam' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date',
            'judul_buku' => 'required',
            'petugas' => 'required',
        ]);

        Pinjam::create($validated);

        return redirect()->route('pinjam.index')->with('success', 'Data pinjam berhasil ditambahkan');
    }

    public function show($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        return view('Pinjam.show', compact('pinjam'));
    }

    public function edit($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        return view('Pinjam.edit', compact('pinjam'));
    }

    public function update(Request $request, $id)
    {
        $pinjam = Pinjam::findOrFail($id);

        $validated = $request->validate([
            'nama_pinjam' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date',
            'judul_buku' => 'required',
            'petugas' => 'required',
        ]);

        $pinjam->update($validated);

        return redirect()->route('pinjam.index')->with('success', 'Data pinjam berhasil diupdate');
    }

    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->delete();

        return redirect()->route('pinjam.index')->with('success', 'Data pinjam berhasil dihapus');
    }
}
