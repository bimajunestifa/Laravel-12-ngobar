@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Data Kategori Buku</h4>
                </div>
               
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                        <a href="{{ route('kategoris.create') }}" class="btn btn-primary">
                            Tambah Kategori
                        </a>
                    </div>


                    <!-- Modal Create -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('kategoris.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="inputKategori" class="form-label"><strong>Kategori:</strong></label>
                                        <input type="text" name="kategori" id="inputKategori"
                                            class="form-control @error('kategori') is-invalid @enderror" required>
                                        @error('kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped table-hover mt-4">
                        <thead class="table-light">
                            <tr>
                                <th width="80px" class="text-center">No</th>
                                <th>Nama Kategori</th>
                                <th width="250px" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- Variabel i untuk nomor --}}

                            @forelse ($kategoris as $kategori)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $kategori->kategori }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('kategoris.show', $kategori->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('kategoris.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori {{ $kategori->kategori }}?')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada data kategori</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $kategoris->links() }}

                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    {{ $kategoris->withQueryString()->links() }} 
</div>
@endsection
