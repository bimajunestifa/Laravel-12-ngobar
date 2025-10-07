<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dashboard()
    {
        return view('siswa.dashboard');
    }

    public function peminjam()
    {
        return view('siswa.peminjam');
    }

    public function pinjam()
    {
        return view('siswa.pinjam');
    }
}
