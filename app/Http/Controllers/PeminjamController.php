<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjams = Peminjam::all();
        return view('Peminjam.index', compact('peminjams'));
    }

    public function create()
    {
        return view('Peminjam.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'no_hp' => 'required',
            'jk' => 'nullable|in:L,P',
        ]);

        Peminjam::create($validated);

        return redirect()->route('peminjam.index');
    }

    public function edit($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        return view('Peminjam.edit', compact('peminjam'));
    }

    public function update(Request $request, $id)
    {
        $peminjam = Peminjam::findOrFail($id);

        $validated = $request->validate([
            'nisn' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'no_hp' => 'required',
            'jk' => 'nullable|in:L,P',
        ]);

        $peminjam->update($validated);

        return redirect()->route('peminjam.index');
    }

    public function destroy($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->delete();

        return redirect()->route('peminjam.index');
    }
}
