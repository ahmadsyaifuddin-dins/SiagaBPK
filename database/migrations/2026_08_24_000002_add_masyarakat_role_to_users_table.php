<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan role 'masyarakat' pada kolom users.role.
     * Role ini dipakai oleh registrasi publik (RegisteredUserController)
     * dan menu Manajemen Masyarakat (MasyarakatController).
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'petugas_lapangan', 'kepala_bpk', 'masyarakat'])
                ->default('petugas_lapangan')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'petugas_lapangan', 'kepala_bpk'])
                ->default('petugas_lapangan')
                ->change();
        });
    }
};
