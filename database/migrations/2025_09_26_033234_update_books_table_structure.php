<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Rename columns to match database structure
            $table->renameColumn('title', 'judul_buku');
            $table->renameColumn('author', 'penulis');
            $table->renameColumn('publisher', 'penerbit');
            $table->renameColumn('tanggal_terbit', 'tgl_terbit');
            
            // Add new columns
            $table->string('kategori')->nullable();
            $table->string('peminjam')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->renameColumn('judul_buku', 'title');
            $table->renameColumn('penulis', 'author');
            $table->renameColumn('penerbit', 'publisher');
            $table->renameColumn('tgl_terbit', 'tanggal_terbit');
            
            $table->dropColumn(['kategori', 'peminjam']);
        });
    }
};
