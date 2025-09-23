@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Kategori') }}</div>
               
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid gap-2 d-md-flex justify-content-md-end mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            +
                        </button>
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

                    <table class="table table-bordered table-striped mt-4">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Kategori</th>
                                <th width="250px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kategoris as $kategori)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $kategori->kategori }}</td>
                                    <td>
                                        <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST">
                                            <a href="{{ route('kategoris.show', $kategori->id) }}" class="btn btn-info btn-sm">Show</a>
                                            <a href="{{ route('kategoris.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">There are no data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $kategoris->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
