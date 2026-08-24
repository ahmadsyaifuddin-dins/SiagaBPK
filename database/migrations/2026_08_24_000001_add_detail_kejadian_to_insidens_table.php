<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('insidens', function (Blueprint $table) {
            // Lingkup wilayah administratif Kota Banjarmasin
            $table->string('kecamatan', 100)->nullable()->index()->after('longitude');
            $table->string('kelurahan', 100)->nullable()->index()->after('kecamatan');

            // Detail Korban (jiwa)
            $table->unsignedInteger('korban_meninggal')->default(0)->after('jumlah_korban');
            $table->unsignedInteger('korban_luka_berat')->default(0)->after('korban_meninggal');
            $table->unsignedInteger('korban_luka_ringan')->default(0)->after('korban_luka_berat');
            $table->unsignedInteger('korban_jiwa_terdampak')->default(0)->after('korban_luka_ringan');
            $table->unsignedInteger('korban_mengungsi_kk')->default(0)->after('korban_jiwa_terdampak');
            $table->unsignedInteger('korban_mengungsi_jiwa')->default(0)->after('korban_mengungsi_kk');

            // Detail Kerugian / Kerusakan
            $table->unsignedInteger('rumah_terbakar')->default(0)->after('korban_mengungsi_jiwa');
            $table->unsignedInteger('rumah_rusak')->default(0)->after('rumah_terbakar');
            $table->unsignedInteger('bangunan_lain_terdampak')->default(0)->after('rumah_rusak');
            $table->unsignedInteger('kendaraan_terbakar')->default(0)->after('bangunan_lain_terdampak');
            $table->decimal('luas_area_dampak', 12, 2)->default(0)->comment('Meter persegi')->after('kendaraan_terbakar');
            $table->unsignedBigInteger('kerugian_material')->default(0)->comment('Rupiah')->after('luas_area_dampak');
        });

        // Backfill: konversi nilai teks kerugian lama ("Rp 15.000.000") menjadi angka
        DB::table('insidens')
            ->whereNotNull('kerugian')
            ->orderBy('id')
            ->chunkById(200, function ($insidens) {
                foreach ($insidens as $insiden) {
                    $angka = preg_replace('/[^0-9]/', '', (string) $insiden->kerugian);

                    if ($angka !== '') {
                        DB::table('insidens')
                            ->where('id', $insiden->id)
                            ->update(['kerugian_material' => (int) $angka]);
                    }
                }
            });
    }

    public function down(): void
    {
        Schema::table('insidens', function (Blueprint $table) {
            $table->dropIndex(['kecamatan']);
            $table->dropIndex(['kelurahan']);
            $table->dropColumn([
                'kecamatan',
                'kelurahan',
                'korban_meninggal',
                'korban_luka_berat',
                'korban_luka_ringan',
                'korban_jiwa_terdampak',
                'korban_mengungsi_kk',
                'korban_mengungsi_jiwa',
                'rumah_terbakar',
                'rumah_rusak',
                'bangunan_lain_terdampak',
                'kendaraan_terbakar',
                'luas_area_dampak',
                'kerugian_material',
            ]);
        });
    }
};
