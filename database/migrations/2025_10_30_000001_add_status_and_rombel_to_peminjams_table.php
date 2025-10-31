<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjams', function (Blueprint $table) {
            $table->string('rombel')->nullable()->after('kelas');
            $table->string('status')->default('aktif')->after('jk');
        });
    }

    public function down(): void
    {
        Schema::table('peminjams', function (Blueprint $table) {
            $table->dropColumn(['rombel', 'status']);
        });
    }
};


