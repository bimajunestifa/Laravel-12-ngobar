<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        
        $kategori = Kategori::pluck('kategori','id');
        
        return view('book.index', compact('books', 'kategori'));

    }

    public function create()
    {
        return view('book.create');
    }

    public function edit($id)
    {
        $books = Book::find($id);
        return view('book.edit', compact('books'));
    }

    public function update(Request $request, $id)
    {
        $books = Book::find($id);
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            // 'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            // 'tgl_terbit' => 'required|date',
            'kategori' => 'nullable|string|max:255',
            // 'peminjam' => 'nullable|string|max:255',
        ]);

        $books->update($validated);
        return redirect()->route('book.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy($id)
    {
        $books = Book::find($id);
        $books->delete();
        return redirect()->route('book.index');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            // 'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            // 'tgl_terbit' => 'required|date',
            'kategori' => 'nullable|string|max:255',
            // 'peminjam' => 'nullable|string|max:255',
        ]);
        Book::create($validated);
        return redirect()->route('book.index')->with('success', 'Buku berhasil ditambahkan');
    }
    
}
