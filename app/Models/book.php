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
        'kategori',
    ];
    
    /**
     * Mendapatkan daftar buku untuk dropdown
     *
     * @return array
     */
    public static function pluck()
    {
        return self::orderBy('judul_buku')->pluck('judul_buku', 'id')->toArray();
    }
}
