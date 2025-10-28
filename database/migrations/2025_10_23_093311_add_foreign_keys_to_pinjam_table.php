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
        Schema::table('pinjam', function (Blueprint $table) {
            $table->unsignedBigInteger('buku_id')->nullable()->after('petugas');
            $table->unsignedBigInteger('petugas_id')->nullable()->after('buku_id');
            
            $table->foreign('buku_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pinjam', function (Blueprint $table) {
            $table->dropForeign(['buku_id']);
            $table->dropForeign(['petugas_id']);
            $table->dropColumn(['buku_id', 'petugas_id']);
        });
    }
};
