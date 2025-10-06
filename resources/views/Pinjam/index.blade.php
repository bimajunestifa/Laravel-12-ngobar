@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Pinjam Buku</h4>
                </div>
               
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                        <a href="{{ route('pinjam.create') }}" class="btn btn-primary">
                            Tambah Peminjam
                        </a>
                    </div>

                    <table class="table table-bordered table-striped table-hover mt-4">
                        <thead class="table-light">
                            <tr>
                                <th width="80px" class="text-center">No</th>
                                <th>Nama Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Judul Buku</th>
                                <th>Petugas</th>
                                <th width="250px" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pinjams as $pinjam)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pinjam->nama_pinjam }}</td>
                                    <td>{{ $pinjam->tgl_pinjam }}</td>
                                    <td>{{ $pinjam->tgl_kembali }}</td>
                                    <td>{{ $pinjam->judul_buku }}</td>
                                    <td>{{ $pinjam->petugas }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('pinjam.show', $pinjam->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('pinjam.edit', $pinjam->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('pinjam.destroy', $pinjam->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data peminjaman {{ $pinjam->nama_pinjam }}?')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
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
@endsection
