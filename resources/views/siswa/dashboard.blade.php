@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Siswa') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Selamat Datang, {{ Auth::user()->name }}!</h4>
                    <p>Anda login sebagai Siswa.</p>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Data Peminjaman</h5>
                                    <p class="card-text">Lihat data peminjaman buku perpustakaan.</p>
                                    <a href="{{ route('siswa.pinjam') }}" class="btn btn-primary">Lihat Peminjaman</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Data Peminjam</h5>
                                    <p class="card-text">Lihat data peminjam buku perpustakaan.</p>
                                    <a href="{{ route('siswa.peminjam') }}" class="btn btn-primary">Lihat Peminjam</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection