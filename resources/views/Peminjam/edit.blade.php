@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Data Peminjam</h4>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                        <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                    <form action="{{ route('peminjam.update', $peminjam->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nisn" class="form-label"><strong>NISN:</strong></label>
                            <input type="text" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" 
                                   value="{{ old('nisn', $peminjam->nisn) }}" placeholder="Masukkan NISN siswa" required>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label"><strong>Nama Lengkap:</strong></label>
                                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                                       value="{{ old('nama', $peminjam->nama) }}" placeholder="Masukkan nama lengkap siswa" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="kelas" class="form-label"><strong>Kelas:</strong></label>
                                <input type="text" name="kelas" id="kelas" class="form-control @error('kelas') is-invalid @enderror" 
                                       value="{{ old('kelas', $peminjam->kelas) }}" placeholder="Masukkan kelas siswa" required>
                                @error('kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label for="no_hp" class="form-label"><strong>No HP:</strong></label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                                       value="{{ old('no_hp', $peminjam->no_hp) }}" placeholder="Masukkan nomor HP siswa" required>
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jk" class="form-label"><strong>JK:</strong></label>
                                <select name="jk" id="jk" class="form-select @error('jk') is-invalid @enderror">
                                    <option value="" disabled {{ old('jk', $peminjam->jk ?? '') === '' ? 'selected' : '' }}>Pilih JK</option>
                                    <option value="L" {{ old('jk', $peminjam->jk ?? '') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jk', $peminjam->jk ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection