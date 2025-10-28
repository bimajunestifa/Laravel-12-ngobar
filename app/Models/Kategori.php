<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'kategori'
    ];

    /**
     * Relasi ke Book - Satu kategori memiliki banyak buku
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'kategori_id');
    }
}
