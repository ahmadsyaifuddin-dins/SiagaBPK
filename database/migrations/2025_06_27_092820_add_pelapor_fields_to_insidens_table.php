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
        Schema::table('insidens', function (Blueprint $table) {
            $table->string('nama_pelapor')->nullable();
            $table->string('kontak_pelapor')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('insidens', function (Blueprint $table) {
            $table->dropColumn(['nama_pelapor', 'kontak_pelapor']);
        });
    }
};
