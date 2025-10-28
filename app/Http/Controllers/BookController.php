<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Konstruktor untuk mengatur middleware
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!in_array(auth()->user()->role, ['admin', 'petugas'])) {
                abort(403, 'Akses tidak diizinkan.');
            }
            return $next($request);
        });
    }

    /**
     * Menampilkan daftar semua buku
     */
    public function index()
    {
        $books = Book::with('kategori')->get();
        
        $kategoris = Kategori::all();
        
        return view('book.index', compact('books', 'kategoris'));
    }

    /**
     * Menampilkan form untuk membuat buku baru
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('book.create', compact('kategoris'));
    }

    /**
     * Menampilkan form untuk mengedit buku
     */
    public function edit($id)
    {
        $books = Book::find($id);
        $kategoris = Kategori::all();
        return view('book.edit', compact('books', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $books = Book::find($id);
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
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
            'penerbit' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);
        Book::create($validated);
        return redirect()->route('book.index')->with('success', 'Buku berhasil ditambahkan');
    }
    
}
