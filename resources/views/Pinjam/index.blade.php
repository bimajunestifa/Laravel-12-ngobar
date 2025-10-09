@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4 class="mb-0">Data Peminjaman Buku</h4>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addPinjamModal">
                        <i class="bi bi-plus-circle"></i> Tambah Peminjaman
                    </button>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered table-striped table-hover mt-3">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="50px">No</th>
                                <th>Nama Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Judul Buku</th>
                                <th>Petugas</th>
                                <th width="180px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pinjams as $pinjam)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $pinjam->nama_pinjam }}</td>
                                    <td>{{ $pinjam->tgl_pinjam }}</td>
                                    <td>{{ $pinjam->tgl_kembali }}</td>
                                    <td>{{ $pinjam->judul_buku }}</td>
                                    <td>{{ $pinjam->petugas }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- Tombol Edit --}}
                                            <button class="btn btn-warning btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editPinjamModal{{ $pinjam->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('pinjam.destroy', $pinjam->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus peminjaman {{ $pinjam->nama_pinjam }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editPinjamModal{{ $pinjam->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('pinjam.update', $pinjam->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data Peminjaman</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Nama Peminjam</label>
                                                        <input type="text" name="nama_pinjam" class="form-control" value="{{ $pinjam->nama_pinjam }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Tanggal Pinjam</label>
                                                        <input type="date" name="tgl_pinjam" class="form-control" value="{{ $pinjam->tgl_pinjam }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Tanggal Kembali</label>
                                                        <input type="date" name="tgl_kembali" class="form-control" value="{{ $pinjam->tgl_kembali }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Judul Buku</label>
                                                        <select name="buku_id" class="form-control" required>
                                                            @foreach ($buku as $b)
                                                                <option value="{{ $b->id }}" {{ $pinjam->buku_id == $b->id ? 'selected' : '' }}>
                                                                    {{ $b->judul_buku }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Petugas</label>
                                                        <select name="petugas_id" class="form-control" required>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}" {{ $pinjam->petugas_id == $user->id ? 'selected' : '' }}>
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada data peminjaman</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Peminjaman --}}
<div class="modal fade" id="addPinjamModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('pinjam.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Peminjam</label>
                        <input type="text" name="nama_pinjam" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Pinjam</label>
                        <input type="date" name="tgl_pinjam" class="form-control"
                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Kembali</label>
                        <input type="date" name="tgl_kembali" class="form-control"
                               value="{{ \Carbon\Carbon::now()->addDays(7)->format('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Judul Buku</label>
                        <select name="buku_id" class="form-control" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach ($buku as $b)
                                <option value="{{ $b->id }}">{{ $b->judul_buku }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Petugas</label>
                        <select name="petugas_id" class="form-control" required>
                            <option value="">-- Pilih Petugas/Admin --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
