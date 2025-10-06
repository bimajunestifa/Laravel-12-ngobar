@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Kategori Baru</h4>
                </div>

                <div class="card-body">

                 <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                    <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                 </div>

                 <form action="{{ route('kategoris.store') }}" method="POST">
                 @csrf

                 <div class="mb-3">
                    <label for="inputKategori" class="form-label"><strong>Nama Kategori:</strong></label>
                    <input type="text" name="kategori" 
                           class="form-control @error('kategori') is-invalid @enderror" 
                           id="inputKategori" placeholder="Masukkan nama kategori buku" required>

                    @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                 </div>

                 <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Batal</a>
                 </div>

                 </form>
                </div>
                  
            </div>
        </div>
    </div>
</div>
@endsection
