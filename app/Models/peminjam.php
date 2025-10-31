<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    use HasFactory;

    protected $table = 'peminjams'; // pastikan nama tabel sama

    protected $fillable = [
        'nama',
        'kelas',
        // 'rombel',
        'no_hp',
        'jk',
        'status',
    ];
}
