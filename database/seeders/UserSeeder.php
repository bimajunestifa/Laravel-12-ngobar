<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama_lengkap' => 'Admin Perpustakaan',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'level' => 'Admin',
        ]);

        User::create([
            'nama_lengkap' => 'Petugas Perpustakaan',
            'username' => 'petugas',
            'password' => Hash::make('petugas123'),
            'level' => 'User',
        ]);

        User::create([
            'nama_lengkap' => 'Siswa Anggota',
            'nis' => '2023001',
            'password' => Hash::make('12345'),
            'level' => 'Pengguna',
        ]);
    }
}
