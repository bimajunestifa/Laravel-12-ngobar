<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PerBim - Perpustakaan Digital</title>

    <!-- Google Font: Inter -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @auth
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">PerBim</a>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Sisi Kiri Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @php $role = Auth::user()->role ?? null; @endphp

                            {{-- Untuk siswa: tampilkan Pinjam dan Peminjam --}}
                            @if($role === 'siswa')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('pinjam.*') ? 'active' : '' }}" href="{{ route('pinjam.index') }}">
                                        Pinjam Buku
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('peminjam.*') ? 'active' : '' }}" href="{{ route('peminjam.index') }}">
                                        Peminjam
                                    </a>
                                </li>

                            {{-- Untuk petugas: tampilkan semua kecuali Pengguna Sistem --}}
                            @elseif($role === 'petugas')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('kategoris.*') ? 'active' : '' }}" href="{{ route('kategoris.index') }}">
                                        Kategoris
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('book.*') ? 'active' : '' }}" href="{{ route('book.index') }}">
                                        Buku
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('peminjam.*') ? 'active' : '' }}" href="{{ route('peminjam.index') }}">
                                        Peminjam
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('pinjam.*') ? 'active' : '' }}" href="{{ route('pinjam.index') }}">
                                        Pinjam
                                    </a>
                                </li>

                            {{-- Untuk admin: tampilkan semua link --}}
                            @else
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('kategoris.*') ? 'active' : '' }}" href="{{ route('kategoris.index') }}">
                                        Kategoris
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('book.*') ? 'active' : '' }}" href="{{ route('book.index') }}">
                                        Buku
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('peminjam.*') ? 'active' : '' }}" href="{{ route('peminjam.index') }}">
                                        Peminjam
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('pinjam.*') ? 'active' : '' }}" href="{{ route('pinjam.index') }}">
                                        Pinjam
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                        Pengguna Sistem
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Sisi Kanan Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Link Autentikasi -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        {{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                       data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"
                                       aria-labelledby="navbarDropdown" tabindex="0">
                                        {{ ucfirst(Auth::user()->role) }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endauth

        <!-- Konten Utama -->
        <main class="py-4">
            @yield('content')
        </main>

    </div>
</body>
</html>
