<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_buku',
        'penerbit',
        'kategori_id',
    ];

    /**
     * Relasi ke Kategori - Satu buku belongs to satu kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relasi ke Pinjam - Satu buku bisa dipinjam berkali-kali
     */
    public function pinjams()
    {
        return $this->hasMany(Pinjam::class, 'buku_id');
    }
}
