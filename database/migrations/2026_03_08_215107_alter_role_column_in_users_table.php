<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah enum untuk menambahkan 'masyarakat', jadikan 'masyarakat' sebagai default jika ada user baru register sendiri
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'relawan', 'masyarakat') NOT NULL DEFAULT 'masyarakat'");
    }

    public function down(): void
    {
        // Rollback ke versi sebelumnya jika di-rollback
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'relawan') NOT NULL DEFAULT 'relawan'");
    }
};
