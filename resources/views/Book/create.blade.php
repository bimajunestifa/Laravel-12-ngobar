@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Buku Baru</h4>
                </div>

                <div class="card-body">

                 <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                    <a href="{{ route('book.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                 </div>

                 <form action="{{ route('book.store') }}" method="POST">
                 @csrf

                 <div class="mb-3">
                    <label for="judul_buku" class="form-label"><strong>Judul Buku:</strong></label>
                    <input type="text" name="judul_buku" 
                           class="form-control @error('judul_buku') is-invalid @enderror" 
                           id="judul_buku" placeholder="Masukkan judul buku" required>

                    @error('judul_buku')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                 </div>

                 {{-- <div class="mb-3">
                    <label for="penulis" class="form-label"><strong>Penulis:</strong></label>
                    <input type="text" name="penulis" 
                           class="form-control @error('penulis') is-invalid @enderror" 
                           id="penulis" placeholder="Masukkan nama penulis" required>

                    {{-- @error('penulis')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                 </div> --}} 

                 <div class="mb-3">
                    <label for="penerbit" class="form-label"><strong>Penerbit:</strong></label>
                    <input type="text" name="penerbit" 
                           class="form-control @error('penerbit') is-invalid @enderror" 
                           id="penerbit" placeholder="Masukkan nama penerbit" required>

                    @error('penerbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                 </div>

                 {{-- <div class="mb-3">
                    <label for="tgl_terbit" class="form-label"><strong>Tanggal Terbit:</strong></label>
                    <input type="date" name="tgl_terbit" 
                           class="form-control @error('tgl_terbit') is-invalid @enderror" 
                           id="tgl_terbit" required>

                    @error('tgl_terbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                 </div> --}}

                 <div class="mb-3">
                  <label for="kategori_id" class="form-label"><strong>Kategori:</strong></label>
                  <select name="kategori_id" id="kategori_id" 
                           class="form-select @error('kategori_id') is-invalid @enderror" required>
                     <option value="">-- Pilih Kategori --</option>
                     @foreach ($kategoris as $kategori)
                           <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                     @endforeach
                  </select>

                    @error('kategori_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
               </div>


                 {{-- <div class="mb-3">
                    <label for="peminjam" class="form-label"><strong>Peminjam:</strong></label>
                    <input type="text" name="peminjam" 
                           class="form-control @error('peminjam') is-invalid @enderror" 
                           id="peminjam" placeholder="Masukkan nama peminjam">

                    @error('peminjam')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                 </div> --}}

                 <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('book.index') }}" class="btn btn-secondary">Batal</a>
                 </div>

                 </form>
                </div>
                  
            </div>
        </div>
    </div>
</div>
@endsection