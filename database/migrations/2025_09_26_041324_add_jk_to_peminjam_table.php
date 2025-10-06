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
        Schema::table('peminjam', function (Blueprint $table) {
            if (!Schema::hasColumn('peminjam', 'jk')) {
                $table->enum('jk', ['L', 'P'])->nullable()->after('no_hp');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjam', function (Blueprint $table) {
            if (Schema::hasColumn('peminjam', 'jk')) {
                $table->dropColumn('jk');
            }
        });
    }
};
