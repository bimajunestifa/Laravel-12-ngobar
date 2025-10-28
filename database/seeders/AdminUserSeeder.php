<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat atau update akun admin
        User::updateOrCreate(
            ['email' => 'admin@perpustakaan.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Buat atau update akun petugas
        User::updateOrCreate(
            ['email' => 'petugas@perpustakaan.com'],
            [
                'name' => 'Petugas Perpustakaan',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
            ]
        );

        // Buat atau update akun siswa
        User::updateOrCreate(
            ['email' => 'siswa@perpustakaan.com'],
            [
                'name' => 'Siswa Test',
                'password' => Hash::make('123456'),
                'role' => 'siswa',
            ]
        );
    }
}