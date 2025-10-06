@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Data Buku</h4>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                        <a href="{{ route('book.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                    <form action="{{ route('book.update', $books->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="judul_buku" class="form-label"><strong>Judul Buku:</strong></label>
                            <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="{{ $books->judul_buku }}" required>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="penulis" class="form-label"><strong>Penulis:</strong></label>
                            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $books->penulis }}" required>
                        </div> --}}

                        <div class="mb-3">
                            <label for="penerbit" class="form-label"><strong>Penerbit:</strong></label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $books->penerbit }}" required>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="tgl_terbit" class="form-label"><strong>Tanggal Terbit:</strong></label>
                            <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $books->tgl_terbit }}" required>
                        </div> --}}

                        <div class="mb-3">
                            <label for="kategori" class="form-label"><strong>Kategori:</strong></label>
                            <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $books->kategori }}">
                        </div>

                        {{-- <div class="mb-3">
                            <label for="peminjam" class="form-label"><strong>Peminjam:</strong></label>
                            <input type="text" class="form-control" id="peminjam" name="peminjam" value="{{ $books->peminjam }}">
                        </div> --}}

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('book.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
