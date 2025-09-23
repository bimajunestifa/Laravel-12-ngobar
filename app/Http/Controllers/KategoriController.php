<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\KategoriStoreRequest;
use App\Http\Requests\KategoriUpdateRequest;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(5);
        return view('kategoris.index', compact('kategoris'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategoris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriStoreRequest $request)
    {
        Kategori::create($request->validated());
        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        return view('kategoris.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategoris.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriUpdateRequest $request, Kategori $kategori)
    {
        $kategori->update($request->validated());
        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori deleted successfully.');
    }
}
