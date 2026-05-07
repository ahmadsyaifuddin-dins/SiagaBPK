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
            // Kita buat nullable() agar data insiden lama tidak error
            // dan berjaga-jaga jika perangkat pelapor gagal mendeteksi GPS
            $table->string('latitude')->nullable()->after('lokasi');
            $table->string('longitude')->nullable()->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insidens', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};
