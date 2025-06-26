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
        Schema::create('insidens', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi');
            $table->dateTime('waktu_kejadian');
            $table->enum('status', ['Dilaporkan', 'Berangkat', 'Tiba di TKP', 'Selesai'])->default('Dilaporkan');
            $table->string('foto')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insidens');
    }
};
