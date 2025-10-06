@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Data Peminjam Perpustakaan</h4>
                </div>
               
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                        <a href="{{ route('peminjam.create') }}" class="btn btn-primary">
                            Tambah Peminjam
                        </a>
                    </div>

                    <table class="table table-bordered table-striped table-hover mt-4">
                        <thead class="table-light">
                            <tr>
                                <th width="80px" class="text-center">No</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas</th>
                                <th>No HP</th>
                                <th>JK</th>
                                <th width="250px" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjams as $peminjam)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $peminjam->nama }}</td>
                                    <td>{{ $peminjam->kelas }}</td>
                                    <td>{{ $peminjam->no_hp }}</td>
                                    <td>{{ $peminjam->jk ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('peminjam.edit', $peminjam->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('peminjam.destroy', $peminjam->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data peminjam {{ $peminjam->nama }}?')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Belum ada data peminjam</td>
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
