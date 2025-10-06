@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Kategori</div>

                <div class="card-body">

                    <!-- Tombol kembali di kanan -->
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                    <form action="{{ route('kategoris.update', $kategori->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Input kategori -->
                        <div class="mb-3 row">
                            <label for="updatekategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control @error('kategori') is-invalid @enderror"
                                       name="kategori"
                                       id="updatekategori"
                                       value="{{ old('kategori', $kategori->kategori) }}"
                                       required>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol simpan -->
                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
