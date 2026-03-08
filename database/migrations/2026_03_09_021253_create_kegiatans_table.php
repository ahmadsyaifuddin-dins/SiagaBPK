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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('judul_kegiatan');
            $table->dateTime('tanggal_kegiatan'); // Pakai dateTime agar tahu jam kumpulnya
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->enum('status', ['Akan Datang', 'Selesai', 'Batal'])->default('Akan Datang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
