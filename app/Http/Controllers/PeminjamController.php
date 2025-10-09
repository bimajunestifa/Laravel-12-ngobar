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
}
