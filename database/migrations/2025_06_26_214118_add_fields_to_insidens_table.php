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
            $table->foreignId('dilaporkan_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->string('jenis_insiden')->nullable();
            $table->unsignedInteger('jumlah_korban')->nullable();
            $table->string('kerugian')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('insidens', function (Blueprint $table) {
            $table->dropForeign(['dilaporkan_oleh']);
            $table->dropColumn(['dilaporkan_oleh', 'jenis_insiden', 'jumlah_korban', 'kerugian']);
        });
    }
};
