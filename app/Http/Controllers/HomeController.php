<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Pinjam;
use App\Models\Peminjam;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Membuat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan dashboard aplikasi.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        
        // Redirect siswa ke dashboard khusus
        if ($user->role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }
        
        // Mendapatkan statistik
        $totalBooks = Book::count();
        $totalBorrowers = Peminjam::count();
        
        // Mendapatkan peminjaman aktif (belum dikembalikan)
        $activeLoans = Pinjam::whereNull('tgl_kembali')->count();
        
        // Mendapatkan peminjaman terlambat (melewati tanggal kembali)
        $overdueLoans = Pinjam::whereNull('tgl_kembali')
            ->where('tgl_kembali', '<', Carbon::now())
            ->count();
        
        // Mendapatkan buku yang sedang dipinjam (peminjaman aktif)
        $borrowedBooks = Pinjam::whereNull('tgl_kembali')
            ->orderBy('tgl_pinjam', 'desc')
            ->get();
        
        return view('home', compact(
            'totalBooks',
            'totalBorrowers', 
            'activeLoans',
            'overdueLoans',
            'borrowedBooks'
        ));
    }
    
    /**
     * Menampilkan dashboard siswa
     */
    public function siswaDashboard()
    {
        $user = auth()->user();
        
        // Mendapatkan peminjaman siswa
        $myLoans = Pinjam::where('nama_pinjam', $user->name)
            ->orderBy('tgl_pinjam', 'desc')
            ->get();
        
        // Mendapatkan peminjaman aktif
        $activeLoans = Pinjam::where('nama_pinjam', $user->name)
            ->whereNull('tgl_kembali')
            ->get();
        
        // Mendapatkan peminjaman terlambat
        $overdueLoans = Pinjam::where('nama_pinjam', $user->name)
            ->whereNull('tgl_kembali')
            ->where('tgl_kembali', '<', Carbon::now())
            ->get();
        
        return view('siswa.dashboard', compact('myLoans', 'activeLoans', 'overdueLoans'));
    }
}
