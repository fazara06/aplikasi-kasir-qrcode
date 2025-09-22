<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->enum('tipemenu', ['makanan', 'minuman'])
                  ->default('makanan')
                  ->after('nama');
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropColumn('tipemenu');
        });
    }
};
