<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
   protected $fillable =[
    'kategori'
   ];
   
   /**
    * Mendapatkan daftar kategori untuk dropdown
    *
    * @return array
    */
   public static function pluck()
   {
       return self::orderBy('kategori')->pluck('kategori', 'id')->toArray();
   }
}
