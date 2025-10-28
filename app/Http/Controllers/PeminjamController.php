<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjams = Peminjam::latest()->get();
        return view('peminjam.index', compact('peminjams'));
    }

    public function show($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        return view('peminjam.show', compact('peminjam'));
    }

    public function create()
    {
        return view('peminjam.create');
    }

    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'jk' => 'required|string|max:20',
        ]);

        // simpan data
        Peminjam::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'no_hp' => $request->no_hp,
            'jk' => $request->jk,
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Data peminjam berhasil disimpan!');
    }

    public function edit($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        return view('peminjam.edit', compact('peminjam'));
    }

    public function update(Request $request, $id)
    {
        $peminjam = Peminjam::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'jk' => 'required|string|max:20',
        ]);

        $peminjam->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'no_hp' => $request->no_hp,
            'jk' => $request->jk,
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Data peminjam berhasil diupdate!');
    }

    public function destroy($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->delete();
        
        return redirect()->route('peminjam.index')->with('success', 'Data peminjam berhasil dihapus!');
    }
}