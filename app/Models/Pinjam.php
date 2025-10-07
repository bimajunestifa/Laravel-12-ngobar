<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'pinjam';
    protected $fillable = ['nama_pinjam', 'tgl_pinjam', 'tgl_kembali', 'judul_buku', 'petugas'];
    
    /**
     * Mendapatkan daftar peminjaman untuk dropdown
     *
     * @return array
     */
    public static function pluck()
    {
        return self::orderBy('nama_pinjam')->pluck('nama_pinjam', 'id')->toArray();
    }
}
