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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
        $table->string('no_hp');
        $table->date('tanggal_lahir')->nullable();
        $table->text('alamat')->nullable();
        $table->string('foto')->nullable();
        $table->string('jabatan')->nullable(); // contoh: Komandan, Relawan, Danton
        $table->string('golongan_darah')->nullable(); // opsional
        $table->boolean('status_aktif')->default(true);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_kelamin',
                'no_hp',
                'tanggal_lahir',
                'alamat',
                'foto',
                'jabatan',
                'golongan_darah',
                'status_aktif',
            ]);
        });
    }
};
