<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peminjam;

class PeminjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peminjams = [
            [
                'nama' => 'Ahmad Rizki',
                'kelas' => 'XII PPLG A',
                'no_hp' => '081234567890',
                'jk' => 'Laki-laki',
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'kelas' => 'XII PPLG B',
                'no_hp' => '081234567891',
                'jk' => 'Perempuan',
            ],
            [
                'nama' => 'Budi Santoso',
                'kelas' => 'XI TKJ A',
                'no_hp' => '081234567892',
                'jk' => 'Laki-laki',
            ],
            [
                'nama' => 'Dewi Kartika',
                'kelas' => 'XI TKJ B',
                'no_hp' => '081234567893',
                'jk' => 'Perempuan',
            ],
            [
                'nama' => 'Rizki Pratama',
                'kelas' => 'X PPLG A',
                'no_hp' => '081234567894',
                'jk' => 'Laki-laki',
            ],
            [
                'nama' => 'Maya Sari',
                'kelas' => 'X PPLG B',
                'no_hp' => '081234567895',
                'jk' => 'Perempuan',
            ],
        ];

        foreach ($peminjams as $peminjam) {
            Peminjam::create($peminjam);
        }
    }
}