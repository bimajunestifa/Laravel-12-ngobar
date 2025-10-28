@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Detail Peminjam</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">Nama Lengkap</h6>
                            <p class="fw-semibold">{{ $peminjam->nama }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Kelas</h6>
                            <p class="fw-semibold">{{ $peminjam->kelas }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">No HP</h6>
                            <p class="fw-semibold">{{ $peminjam->no_hp }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Jenis Kelamin</h6>
                            <p class="fw-semibold">{{ $peminjam->jk }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">Tanggal Daftar</h6>
                            <p class="fw-semibold">{{ \Carbon\Carbon::parse($peminjam->created_at)->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Terakhir Diupdate</h6>
                            <p class="fw-semibold">{{ \Carbon\Carbon::parse($peminjam->updated_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">
                            Kembali ke Daftar
                        </a>
                        @if(Auth::user()->role !== 'siswa')
                            <div>
                                <a href="{{ route('peminjam.edit', $peminjam->id) }}" class="btn btn-warning">
                                    Edit Data
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    Hapus Data
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->role !== 'siswa')
<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data peminjam <strong>"{{ $peminjam->nama }}"</strong>?</p>
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
@endsection
