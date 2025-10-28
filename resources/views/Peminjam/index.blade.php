@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4 class="mb-0">Data Peminjam Perpustakaan</h4>
                    @if(Auth::user()->role !== 'siswa')
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#tambahModal">
                            Tambah Peminjam
                        </button>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(Auth::user()->role !== 'siswa')
                    <!-- Modal Tambah -->
                    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('peminjam.store') }}" method="POST" class="modal-content">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahModalLabel">Tambah Peminjam</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Kelas</label>
                                        <input type="text" name="kelas" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>No HP</label>
                                        <input type="text" name="no_hp" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jenis Kelamin</label>
                                        <select name="jk" class="form-select" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                    <table class="table table-bordered table-striped table-hover mt-3">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="50px">No</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas</th>
                                <th>No HP</th>
                                <th>Jenis Kelamin</th>
                                <th width="180px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjams as $peminjam)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $peminjam->nama }}</td>
                                <td>{{ $peminjam->kelas }}</td>
                                <td>{{ $peminjam->no_hp }}</td>
                                <td>{{ $peminjam->jk }}</td>
                                <td class="text-center">
                                    @if(Auth::user()->role !== 'siswa')
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-warning btn-sm" 
                                                    data-bs-toggle="modal" data-bs-target="#modalEditPeminjam{{ $peminjam->id }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" 
                                                    data-bs-toggle="modal" data-bs-target="#modalHapusPeminjam{{ $peminjam->id }}">
                                                Hapus
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>

                            @if(Auth::user()->role !== 'siswa')
                            <!-- Modal Edit Peminjam -->
                            <div class="modal fade" id="modalEditPeminjam{{ $peminjam->id }}" tabindex="-1" aria-labelledby="modalEditPeminjamLabel{{ $peminjam->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditPeminjamLabel{{ $peminjam->id }}">Edit Data Peminjam</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('peminjam.update', $peminjam->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama_edit{{ $peminjam->id }}" class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="nama" id="nama_edit{{ $peminjam->id }}"
                                                        class="form-control @error('nama') is-invalid @enderror" 
                                                        value="{{ old('nama', $peminjam->nama) }}" required>
                                                    @error('nama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kelas_edit{{ $peminjam->id }}" class="form-label">Kelas</label>
                                                    <input type="text" name="kelas" id="kelas_edit{{ $peminjam->id }}"
                                                        class="form-control @error('kelas') is-invalid @enderror" 
                                                        value="{{ old('kelas', $peminjam->kelas) }}" required>
                                                    @error('kelas')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_hp_edit{{ $peminjam->id }}" class="form-label">No HP</label>
                                                    <input type="text" name="no_hp" id="no_hp_edit{{ $peminjam->id }}"
                                                        class="form-control @error('no_hp') is-invalid @enderror" 
                                                        value="{{ old('no_hp', $peminjam->no_hp) }}" required>
                                                    @error('no_hp')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jk_edit{{ $peminjam->id }}" class="form-label">Jenis Kelamin</label>
                                                    <select name="jk" id="jk_edit{{ $peminjam->id }}" 
                                                        class="form-select @error('jk') is-invalid @enderror" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Laki-laki" {{ old('jk', $peminjam->jk) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                        <option value="Perempuan" {{ old('jk', $peminjam->jk) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                    @error('jk')
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

                            <!-- Modal Hapus Peminjam -->
                            <div class="modal fade" id="modalHapusPeminjam{{ $peminjam->id }}" tabindex="-1" aria-labelledby="modalHapusPeminjamLabel{{ $peminjam->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalHapusPeminjamLabel{{ $peminjam->id }}">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus peminjam <strong>"{{ $peminjam->nama }}"</strong>?</p>
                                            <p class="text-muted">Tindakan ini tidak dapat dibatalkan.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('peminjam.destroy', $peminjam->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
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
