<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Kalau belum login → ke login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Kalau login tapi bukan siswa → ke home
        if (Auth::user()->role !== 'siswa') {
            return redirect('/home');
        }

        // Kalau siswa → lanjut ke halaman
        return $next($request);
    }
}
