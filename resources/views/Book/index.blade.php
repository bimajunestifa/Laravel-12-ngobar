@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Data Buku Perpustakaan</h4>
                </div>

                <div class="card-body">
                    {{-- Notifikasi sukses --}}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tombol tambah buku (buka modal) --}}
                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#bookCreateModal">
                            Tambah Buku
                        </button>
                    </div>

                    {{-- Modal Create Buku (inline di halaman ini) --}}
                    <div class="modal fade" id="bookCreateModal" tabindex="-1" aria-labelledby="bookCreateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="bookCreateModalLabel">Tambah Buku</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('book.store') }}" method="POST">
                                    @csrf

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="judul_buku" class="form-label"><strong>Judul Buku:</strong></label>
                                            <input type="text" name="judul_buku" class="form-control @error('judul_buku') is-invalid @enderror" id="judul_buku" placeholder="Masukkan judul buku" required>
                                            @error('judul_buku')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label for="penulis" class="form-label"><strong>Penulis:</strong></label>
                                            <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror" id="penulis" placeholder="Masukkan nama penulis" required>
                                            @error('penulis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> --}}

                                        <div class="mb-3">
                                            <label for="penerbit" class="form-label"><strong>Penerbit:</strong></label>
                                            <input type="text" name="penerbit" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" placeholder="Masukkan nama penerbit" required>
                                            @error('penerbit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label for="tgl_terbit" class="form-label"><strong>Tanggal Terbit:</strong></label>
                                            <input type="date" name="tgl_terbit" class="form-control @error('tgl_terbit') is-invalid @enderror" id="tgl_terbit" required>
                                            @error('tgl_terbit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> --}}

                                        <div class="mb-3">
                                            <label for="kategori" class="form-label"><strong>Kategori:</strong></label>
                                            <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" id="kategori" placeholder="Masukkan nama kategori">
                                            @error('kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label for="peminjam" class="form-label"><strong>Peminjam:</strong></label>
                                            <input type="text" name="peminjam" class="form-control @error('peminjam') is-invalid @enderror" id="peminjam" placeholder="Masukkan nama peminjam">
                                            @error('peminjam')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> --}}
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-outline-secondary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Bungkus tabel dengan table-responsive --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle mb-0">
                            <thead class="table-light text-center">
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th style="min-width: 150px;">Judul Buku</th>
                                    <th style="min-width: 120px;">Penerbit</th>
                                    <th style="min-width: 100px;">Kategori</th>
                                    {{-- <th style="min-width: 120px;">Peminjam</th> --}}
                                    <th style="min-width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-truncate" style="max-width: 200px;">{{ $book->judul_buku }}</td>
                                        <td>{{ $book->penerbit }}</td>
                                        <td>{{ $book->kategori }}</td>
                                        {{-- <td>{{ $book->peminjam }}</td> --}}
                                        <td class="text-center">
                                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                                <a href="{{ route('book.show', $book->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                                <a href="{{ route('book.edit', $book->id) }}" class="btn btn-warning btn-sm"> Edit</a>
                                                <form action="{{ route('book.destroy', $book->id) }}" method="POST" 
                                                      onsubmit="return confirm('Yakin ingin menghapus buku {{ $book->judul_buku }}?')" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"> Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Belum ada data buku</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> {{-- end table-responsive --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
