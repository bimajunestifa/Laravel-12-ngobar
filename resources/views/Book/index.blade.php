@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4 class="mb-0">Data Buku</h4>
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalTambahBuku">
                        <i class="bi bi-plus-circle"></i> Tambah Buku
                    </button>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Modal untuk Menambah Buku Baru -->
                    <div class="modal fade" id="modalTambahBuku" tabindex="-1" aria-labelledby="modalTambahBukuLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahBukuLabel">Tambah Buku Baru</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('book.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="judul_buku" class="form-label">Judul Buku</label>
                                            <input type="text" name="judul_buku" id="judul_buku"
                                                class="form-control @error('judul_buku') is-invalid @enderror" 
                                                placeholder="Masukkan judul buku" required>
                                            @error('judul_buku')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="penerbit" class="form-label">Penerbit</label>
                                            <input type="text" name="penerbit" id="penerbit"
                                                class="form-control @error('penerbit') is-invalid @enderror" 
                                                placeholder="Masukkan nama penerbit" required>
                                            @error('penerbit')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori_id" class="form-label">Kategori</label>
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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped table-hover mt-3">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="50px">No</th>
                                <th>Judul Buku</th>
                                <th>Penerbit</th>
                                <th>Kategori</th>
                                <th width="180px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $book->judul_buku }}</td>
                                <td>{{ $book->penerbit }}</td>
                                <td>
                                    @if($book->kategori_id && is_object($book->kategori))
                                        {{ $book->kategori->kategori }}
                                    @elseif(is_string($book->kategori))
                                        {{ $book->kategori }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-warning btn-sm" 
                                                data-bs-toggle="modal" data-bs-target="#modalEditBuku{{ $book->id }}">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" 
                                                data-bs-toggle="modal" data-bs-target="#modalHapusBuku{{ $book->id }}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal untuk Mengedit Data Buku -->
                            <div class="modal fade" id="modalEditBuku{{ $book->id }}" tabindex="-1" aria-labelledby="modalEditBukuLabel{{ $book->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditBukuLabel{{ $book->id }}">Edit Data Buku</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('book.update', $book->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="judul_buku_edit{{ $book->id }}" class="form-label">Judul Buku</label>
                                                    <input type="text" name="judul_buku" id="judul_buku_edit{{ $book->id }}"
                                                        class="form-control @error('judul_buku') is-invalid @enderror" 
                                                        value="{{ $book->judul_buku }}" required>
                                                    @error('judul_buku')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="penerbit_edit{{ $book->id }}" class="form-label">Penerbit</label>
                                                    <input type="text" name="penerbit" id="penerbit_edit{{ $book->id }}"
                                                        class="form-control @error('penerbit') is-invalid @enderror" 
                                                        value="{{ $book->penerbit }}" required>
                                                    @error('penerbit')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kategori_id_edit{{ $book->id }}" class="form-label">Kategori</label>
                                                    <select name="kategori_id" id="kategori_id_edit{{ $book->id }}" 
                                                        class="form-select @error('kategori_id') is-invalid @enderror" required>
                                                        <option value="">-- Pilih Kategori --</option>
                                                        @foreach ($kategoris as $kategori)
                                                            <option value="{{ $kategori->id }}" 
                                                                {{ $book->kategori_id == $kategori->id ? 'selected' : '' }}>
                                                                {{ $kategori->kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('kategori_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-warning">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal untuk Menghapus Data Buku -->
                            <div class="modal fade" id="modalHapusBuku{{ $book->id }}" tabindex="-1" aria-labelledby="modalHapusBukuLabel{{ $book->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalHapusBukuLabel{{ $book->id }}">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus buku <strong>"{{ $book->judul_buku }}"</strong>?</p>
                                            <p class="text-muted">Tindakan ini tidak dapat dibatalkan.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('book.destroy', $book->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
