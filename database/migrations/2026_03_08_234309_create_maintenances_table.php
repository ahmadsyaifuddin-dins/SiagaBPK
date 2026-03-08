<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel inventaris (Jika aset dihapus, riwayat servisnya ikut terhapus)
            $table->foreignId('inventaris_id')->constrained('inventaris')->cascadeOnDelete();
            $table->date('tanggal_servis');
            $table->string('jenis_servis'); // Misal: 'Ganti Oli', 'Ganti Ban', 'Perbaikan Pompa'
            $table->integer('biaya')->default(0); // Biaya perbaikan
            $table->text('keterangan')->nullable(); // Detail yang diperbaiki
            $table->string('nota_servis')->nullable(); // Foto nota/kuitansi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
