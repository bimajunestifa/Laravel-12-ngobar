<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'pinjam';
    protected $fillable = ['nama_pinjam', 'tgl_pinjam', 'tgl_kembali', 'judul_buku', 'petugas'];
}
