@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4 class="mb-0">Data Peminjam Perpustakaan</h4>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="bi bi-plus-circle"></i> Tambah Peminjam
                    </button>
                </div>
               
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped table-hover mt-4 align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="60">No</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas</th>
                                <th>No HP</th>
                                <th>JK</th>
                                <th>Tanggal Ditambahkan</th>
                                <th width="200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjams as $peminjam)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $peminjam->nama }}</td>
                                    <td>{{ $peminjam->kelas }}</td>
                                    <td>{{ $peminjam->no_hp }}</td>
                                    <td>{{ $peminjam->jk ?? '-' }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($peminjam->created_at)
                                            ->timezone('Asia/Jakarta')
                                            ->translatedFormat('d F Y, H:i') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button 
                                                class="btn btn-warning btn-sm btnEdit" 
                                                data-id="{{ $peminjam->id }}"
                                                data-nama="{{ $peminjam->nama }}"
                                                data-kelas="{{ $peminjam->kelas }}"
                                                data-no_hp="{{ $peminjam->no_hp }}"
                                                data-jk="{{ $peminjam->jk }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                            
                                            <form action="{{ route('peminjam.destroy', $peminjam->id) }}" 
                                                method="POST" 
                                                onsubmit="return confirm('Yakin ingin menghapus peminjam {{ $peminjam->nama }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada data peminjam</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===================== MODAL TAMBAH ===================== --}}
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

{{-- ===================== MODAL EDIT ===================== --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" class="modal-content" id="editForm">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Peminjam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" id="editNama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kelas</label>
                    <input type="text" name="kelas" id="editKelas" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" id="editNoHp" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jk" id="editJk" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

{{-- ===================== SCRIPT JS ===================== --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.btnEdit');
        const editForm = document.getElementById('editForm');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                document.getElementById('editNama').value = this.dataset.nama;
                document.getElementById('editKelas').value = this.dataset.kelas;
                document.getElementById('editNoHp').value = this.dataset.no_hp;
                document.getElementById('editJk').value = this.dataset.jk;

                // Update action URL
                editForm.action = `/peminjam/${id}`;
            });
        });
    });
</script>
@endsection
