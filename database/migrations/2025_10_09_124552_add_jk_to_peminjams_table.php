<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjams', function (Blueprint $table) {
            $table->enum('jk', ['Laki-laki', 'Perempuan'])->after('no_hp')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('peminjams', function (Blueprint $table) {
            $table->dropColumn('jk');
        });
    }
};
