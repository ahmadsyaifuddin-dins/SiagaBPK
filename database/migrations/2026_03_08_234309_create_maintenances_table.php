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
            // Relasi ke tabel inventaris
            $table->foreignId('inventaris_id')->constrained('inventaris')->cascadeOnDelete();

            $table->date('tanggal_servis'); // Tanggal dijadwalkan / dilakukan servis
            $table->string('jenis_servis'); // Misal: 'Isi Ulang APAR', 'Ganti Oli', dll

            $table->enum('status', ['Terjadwal', 'Proses', 'Selesai', 'Batal'])->default('Terjadwal');

            $table->integer('biaya')->nullable()->default(0); // Nullable karena kalau baru dijadwalkan belum ada biaya
            $table->text('keterangan')->nullable();
            $table->string('nota_servis')->nullable(); // Upload nota saat status diubah menjadi Selesai

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
