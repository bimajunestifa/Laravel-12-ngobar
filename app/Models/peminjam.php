<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    use HasFactory;

    protected $table = 'peminjam';
    protected $fillable = ['nisn', 'nama', 'kelas', 'no_hp', 'jk'];
    
    /**
     * Mendapatkan daftar peminjam untuk dropdown
     *
     * @return array
     */
    public static function pluck()
    {
        return self::orderBy('nama')->pluck('nama', 'id')->toArray();
    }
}
