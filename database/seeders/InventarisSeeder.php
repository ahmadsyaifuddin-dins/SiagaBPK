<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inventaris')->insert([
            [
                'id' => 1,
                'kode_barang' => 'BPK-AST-0001',
                'nama_barang' => 'Mobil Pemadam Hino 500',
                'kategori' => 'Armada',
                'jumlah' => 1,
                'kondisi' => 'Baik',
                'keterangan' => 'oke spec',
                'foto' => 'uploads/inventaris/1772984058_mobil_pemadam.jpg',
                'created_at' => '2026-03-08 15:34:18',
                'updated_at' => '2026-03-08 15:34:18',
            ],
        ]);
    }
}
