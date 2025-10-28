<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            'Fiksi',
            'Non-Fiksi',
            'Pendidikan',
            'Teknologi',
            'Sejarah',
            'Biografi',
            'Agama',
            'Kesehatan',
            'Bisnis',
            'Seni & Budaya'
        ];

        foreach ($kategoris as $kategori) {
            Kategori::updateOrCreate(
                ['kategori' => $kategori],
                ['kategori' => $kategori]
            );
        }
    }
}