@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create') }}</div>

                <div class="card-body">

                 <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('kategoris.index') }}"
                     class="btn btn-primary btn-sm">Back</a>
                 </div>

                 <form action="{{ route('kategoris.store') }}" method="POST">
                 @csrf

                 <div class="mb-3">
                    <label for="inputKategori" class="form-label">Kategori</label>
                    <input type="text" name="kategori" 
                           class="form-control @error('kategori') is-invalid @enderror" 
                           id="inputKategori" placeholder="Kategori Apa Ya">

                    @error('kategori')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                 </div>

                 <button type="submit" class="btn btn-success">Submit</button>

                 </form>
                </div>
                  
            </div>
        </div>
    </div>
</div>
@endsection
