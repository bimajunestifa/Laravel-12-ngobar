@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <!-- Bagian Selamat Datang -->
    <div class="row mb-4">
        <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h2 class="mb-2 text-primary fw-bold">
                        Dashboard Siswa
                    </h2>
                                    <p class="mb-0 text-muted">
                                        Selamat datang, <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                                        <span class="badge bg-primary-subtle text-primary ms-2">Siswa</span>
                                    </p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div class="text-muted">
                                        <div class="mb-1 fw-medium">
                                            <span id="current-date"></span>
                                        </div>
                                        <div class="fs-5 fw-semibold text-dark">
                                            <span id="current-time"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Berhasil!</strong> {{ session('status') }}
        </div>
    @endif

            <!-- Kartu Statistik -->
            <div class="row g-3 mb-4">
                <div class="col-lg-4 col-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary-subtle rounded-3 p-3">
                                        <div class="text-primary fs-4 fw-bold">{{ $myLoans->count() }}</div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="text-muted small">Total Peminjaman</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-success-subtle rounded-3 p-3">
                                        <div class="text-success fs-4 fw-bold">{{ $activeLoans->count() }}</div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="text-muted small">Sedang Dipinjam</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning-subtle rounded-3 p-3">
                                        <div class="text-warning fs-4 fw-bold">{{ $overdueLoans->count() }}</div>
            </div>
        </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="text-muted small">Buku Terlambat</div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- Aksi Cepat -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-transparent border-0 p-4 pb-0">
                            <h3 class="card-title text-primary fw-bold mb-0">Aksi Cepat</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6 col-12">
                                    <a href="{{ route('pinjam.index') }}" class="btn btn-outline-primary btn-lg w-100 py-3">
                                        Pinjam Buku
                                    </a>
                                </div>
                                <div class="col-md-6 col-12">
                                    <a href="{{ route('pinjam.index') }}" class="btn btn-outline-success btn-lg w-100 py-3">
                                        Lihat Riwayat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten Utama -->
            <div class="row g-4">
                <!-- Bagian Peminjaman Aktif -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-transparent border-0 p-4 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title text-primary fw-bold mb-0">Buku yang Sedang Saya Pinjam</h3>
                                <a href="{{ route('pinjam.index') }}" class="btn btn-primary">
                                    Pinjam Buku
                                </a>
        </div>
    </div>
                        <div class="card-body p-4">
                    @if($activeLoans->count() > 0)
                        <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                <thead>
                                            <tr class="border-0">
                                                <th class="text-muted small fw-semibold text-uppercase">Judul Buku</th>
                                                <th class="text-muted small fw-semibold text-uppercase">Tanggal Pinjam</th>
                                                <th class="text-muted small fw-semibold text-uppercase">Tanggal Kembali</th>
                                                <th class="text-muted small fw-semibold text-uppercase">Petugas</th>
                                                <th class="text-muted small fw-semibold text-uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activeLoans as $loan)
                                                <tr class="border-0">
                                                    <td class="text-dark">{{ $loan->judul_buku }}</td>
                                                    <td class="text-muted">{{ \Carbon\Carbon::parse($loan->tgl_pinjam)->format('d/m/Y') }}</td>
                                                    <td class="text-muted">{{ \Carbon\Carbon::parse($loan->tgl_kembali)->format('d/m/Y') }}</td>
                                                    <td class="text-muted">{{ $loan->petugas }}</td>
                                            <td>
                                                @if(\Carbon\Carbon::parse($loan->tgl_kembali)->isPast())
                                                            <span class="badge bg-danger-subtle text-danger">Terlambat</span>
                                                @else
                                                            <span class="badge bg-success-subtle text-success">Aktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                                <div class="text-center py-5">
                                    <p class="text-muted mb-3">Anda belum meminjam buku</p>
                                    <a href="{{ route('pinjam.index') }}" class="btn btn-primary">
                                        Pinjam Buku Sekarang
                                    </a>
                        </div>
                    @endif
                        </div>
                </div>
            </div>
        </div>

            <!-- Riwayat Peminjaman -->
            @if($myLoans->count() > 0)
            <div class="row g-4 mt-2">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-transparent border-0 p-4 pb-0">
                            <h3 class="card-title text-primary fw-bold mb-0">Riwayat Peminjaman</h3>
                </div>
                        <div class="card-body p-4">
                            <div class="d-flex flex-column gap-3">
                            @foreach($myLoans->take(5) as $loan)
                                    <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary-subtle rounded-circle p-2">
                                                <div class="text-primary small fw-bold">P</div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold text-dark mb-1">{{ $loan->judul_buku }}</div>
                                            <div class="text-muted small mb-1">
                                            {{ \Carbon\Carbon::parse($loan->tgl_pinjam)->format('d/m/Y') }}
                                                @if($loan->tgl_kembali)
                                                    - {{ \Carbon\Carbon::parse($loan->tgl_kembali)->format('d/m/Y') }}
                                                @endif
                                            </div>
                                            <div class="text-muted small">
                                        @if($loan->tgl_kembali)
                                                    <span class="badge bg-success-subtle text-success">Sudah dikembalikan</span>
                                        @else
                                                    <span class="badge bg-warning-subtle text-warning">Masih dipinjam</span>
                                        @endif
                                            </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        @if($myLoans->count() > 5)
                        <div class="card-footer bg-transparent border-0 p-4 pt-0 text-center">
                            <a href="{{ route('pinjam.index') }}" class="btn btn-outline-primary">
                                Lihat Semua Riwayat
                            </a>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Gaya untuk konten tengah */
.content {
    padding: 20px 15px;
}

.container-fluid {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.row.justify-content-center {
    margin: 0;
    width: 100%;
}

.col-12.col-lg-10.col-xl-8 {
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
    padding: 0;
}

/* Layout bersih */
body {
    margin: 0;
    padding: 0;
}

#app {
    width: 100%;
}

/* Penyesuaian responsif */
@media (max-width: 768px) {
    .btn-block {
        height: 40px;
        font-size: 14px;
    }
}
</style>

<script>
// Jam dan tanggal real-time
function updateDateTime() {
    const now = new Date();
    
    // Format tanggal
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    };
    const dateString = now.toLocaleDateString('id-ID', options);
    
    // Format waktu
    const timeString = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    
    document.getElementById('current-date').textContent = dateString;
    document.getElementById('current-time').textContent = timeString;
}

// Update setiap detik
setInterval(updateDateTime, 1000);
updateDateTime(); // Panggilan awal
</script>
@endsection