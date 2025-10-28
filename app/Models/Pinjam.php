<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'pinjam';
    protected $fillable = ['nama_pinjam', 'tgl_pinjam', 'tgl_kembali', 'judul_buku', 'petugas', 'buku_id', 'petugas_id'];

    /**
     * Relasi ke Book - Satu peminjaman belongs to satu buku
     */
    public function buku()
    {
        return $this->belongsTo(Book::class, 'buku_id');
    }

    /**
     * Relasi ke User - Satu peminjaman belongs to satu petugas/admin
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
