<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->enum('kategori', ['Armada', 'Peralatan', 'Perlengkapan', 'Lainnya']);

            $table->integer('jumlah');
            $table->integer('stok_minimum')->default(0);

            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            $table->date('tanggal_kadaluarsa')->nullable();

            $table->string('qr_code')->nullable();

            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
