<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah kolom kategori_id jika belum ada
        if (!Schema::hasColumn('books', 'kategori_id')) {
            Schema::table('books', function (Blueprint $table) {
                $table->unsignedBigInteger('kategori_id')->nullable()->after('penerbit');
                $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('set null');
            });
        }
        
        // Update data yang ada - set kategori_id berdasarkan kategori string
        $books = DB::table('books')->whereNotNull('kategori')->get();
        foreach ($books as $book) {
            // Cari kategori berdasarkan nama
            $kategori = DB::table('kategoris')->where('kategori', $book->kategori)->first();
            if ($kategori) {
                DB::table('books')->where('id', $book->id)->update(['kategori_id' => $kategori->id]);
            } else {
                // Jika kategori tidak ditemukan, buat kategori baru
                $newKategoriId = DB::table('kategoris')->insertGetId(['kategori' => $book->kategori]);
                DB::table('books')->where('id', $book->id)->update(['kategori_id' => $newKategoriId]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }
};