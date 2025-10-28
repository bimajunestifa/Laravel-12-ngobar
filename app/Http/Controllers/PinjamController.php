<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\Book;
use App\Models\User;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function index()
    {
        $pinjams = Pinjam::all();
        $buku = Book::all();
        $users = User::where('role', 'admin')->orWhere('role', 'petugas')->get();
        return view('Pinjam.index', compact('pinjams', 'buku', 'users'));
    }

    public function create()
    {
        $buku = Book::all();
        $users = User::where('role', 'admin')->orWhere('role', 'petugas')->get();
        return view('Pinjam.create', compact('buku', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pinjam' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date',
            'buku_id' => 'required|exists:books,id',
            'petugas_id' => 'required|exists:users,id',
            'kelas' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'jk' => 'nullable|string|max:20',
        ]);
        
        // Cek apakah peminjam sudah ada di database
        $peminjam = Peminjam::where('nama', $validated['nama_pinjam'])->first();
        
        // Jika belum ada, buat data peminjam baru
        if (!$peminjam) {
            $peminjam = Peminjam::create([
                'nama' => $validated['nama_pinjam'],
                'kelas' => $validated['kelas'] ?? 'Belum Diketahui',
                'no_hp' => $validated['no_hp'] ?? '-',
                'jk' => $validated['jk'] ?? 'Belum Diketahui',
            ]);
        }
        
        // Ambil data buku dan petugas
        $buku = Book::findOrFail($request->buku_id);
        $petugas = User::findOrFail($request->petugas_id);
        
        // Buat data pinjam dengan judul_buku dan petugas
        Pinjam::create([
            'nama_pinjam' => $validated['nama_pinjam'],
            'tgl_pinjam' => $validated['tgl_pinjam'],
            'tgl_kembali' => $validated['tgl_kembali'],
            'judul_buku' => $buku->judul_buku,
            'petugas' => $petugas->name,
            'buku_id' => $validated['buku_id'],
            'petugas_id' => $validated['petugas_id'],
        ]);

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
        $buku = Book::all();
        $users = User::where('role', 'admin')->orWhere('role', 'petugas')->get();
        return view('Pinjam.edit', compact('pinjam', 'buku', 'users'));
    }

    public function update(Request $request, $id)
    {
        $pinjam = Pinjam::findOrFail($id);

        $validated = $request->validate([
            'nama_pinjam' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date',
            'buku_id' => 'required|exists:books,id',
            'petugas_id' => 'required|exists:users,id',
            'kelas' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'jk' => 'nullable|string|max:20',
        ]);

        // Cek apakah peminjam sudah ada di database
        $peminjam = Peminjam::where('nama', $validated['nama_pinjam'])->first();
        
        // Jika belum ada, buat data peminjam baru
        if (!$peminjam) {
            $peminjam = Peminjam::create([
                'nama' => $validated['nama_pinjam'],
                'kelas' => $validated['kelas'] ?? 'Belum Diketahui',
                'no_hp' => $validated['no_hp'] ?? '-',
                'jk' => $validated['jk'] ?? 'Belum Diketahui',
            ]);
        }

        // Ambil data buku dan petugas
        $buku = Book::findOrFail($request->buku_id);
        $petugas = User::findOrFail($request->petugas_id);
        
        // Update data pinjam dengan judul_buku dan petugas
        $pinjam->update([
            'nama_pinjam' => $validated['nama_pinjam'],
            'tgl_pinjam' => $validated['tgl_pinjam'],
            'tgl_kembali' => $validated['tgl_kembali'],
            'judul_buku' => $buku->judul_buku,
            'petugas' => $petugas->name,
            'buku_id' => $validated['buku_id'],
            'petugas_id' => $validated['petugas_id'],
        ]);

        return redirect()->route('pinjam.index')->with('success', 'Data pinjam berhasil diupdate');
    }

    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->delete();

        return redirect()->route('pinjam.index')->with('success', 'Data pinjam berhasil dihapus');
    }
}
