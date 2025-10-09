@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Peminjaman Baru</h4>
                </div>

                <div class="card-body">

                 <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                    <a href="{{ route('pinjam.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                 </div>

                 <form action="{{ route('pinjam.store') }}" method="POST">
                 @csrf

                 <div class="mb-3">
                    <label for="nama_pinjam" class="form-label"><strong>Nama Peminjam:</strong></label>
                    <input type="text" name="nama_pinjam"
                           class="form-control @error('nama_pinjam') is-invalid @enderror"
                           id="nama_pinjam" placeholder="Masukkan nama peminjam" required>
                    @error('nama_pinjam')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                 </div>

                 <div class="row g-3">
                    <div class="col-md-6">
                        <label for="tgl_pinjam" class="form-label"><strong>Tanggal Pinjam:</strong></label>
                        <input type="date" name="tgl_pinjam"
                               class="form-control @error('tgl_pinjam') is-invalid @enderror"
                               id="tgl_pinjam" required>
                        @error('tgl_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tgl_kembali" class="form-label"><strong>Tanggal Kembali:</strong></label>
                        <input type="date" name="tgl_kembali"
                               class="form-control @error('tgl_kembali') is-invalid @enderror"
                               id="tgl_kembali" required>
                        @error('tgl_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                 </div>

                 <div class="mt-3">
                    <label for="judul_buku" class="form-label"><strong>Judul Buku:</strong></label>
                    <input type="text" name="judul_buku"
                           class="form-control @error('judul_buku') is-invalid @enderror"
                           id="judul_buku" placeholder="Masukkan judul buku" required>
                    @error('judul_buku')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                 </div>

                 <div class="mt-3">
                    <label for="petugas" class="form-label"><strong>Petugas:</strong></label>
                    <input type="text" name="petugas"
                           class="form-control @error('petugas') is-invalid @enderror"
                           id="petugas" placeholder="Masukkan nama petugas" required>
                    @error('petugas')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                 </div>

                 <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('pinjam.index') }}" class="btn btn-secondary">Batal</a>
                 </div>

                 </form>
                </div>
                  
            </div>
        </div>
    </div>
</div>
@endsection
