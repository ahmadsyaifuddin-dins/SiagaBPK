<?php

namespace Database\Seeders;

use App\Models\Inventaris;
use Illuminate\Database\Seeder;

class InventarisSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_barang' => 'ARM-001',
                'nama_barang' => 'Mobil Pemadam Hino Dutro',
                'kategori' => 'Armada',
                'jumlah' => 1,
                'stok_minimum' => 1,
                'kondisi' => 'Baik',
                'tanggal_kadaluarsa' => null,
                'qr_code' => 'QR-ARM-001',
                'keterangan' => 'Unit Utama Tempur BPK KTC Fire. Kapasitas tangki air 4000 Liter. Kondisi mesin dan pompa PTO normal.',
                'foto' => 'uploads/inventaris/1772984058_mobil_pemadam.jpg', // FOTO ASLI KAMU
            ],
            [
                'kode_barang' => 'APR-001',
                'nama_barang' => 'APAR Dry Chemical Powder 6 Kg',
                'kategori' => 'Peralatan',
                'jumlah' => 12,
                'stok_minimum' => 5,
                'kondisi' => 'Baik',
                'tanggal_kadaluarsa' => '2028-12-31', // APAR ada masa kedaluwarsanya
                'qr_code' => 'QR-APR-001',
                'keterangan' => 'Ditempatkan di posko dan di dalam kabin armada. Tekanan tabung masih dalam zona hijau.',
                'foto' => 'uploads/inventaris/1778165164_APAR.png', // FOTO ASLI KAMU
            ],
            [
                'kode_barang' => 'SLG-001',
                'nama_barang' => 'Selang Pemadam Canvas 1.5 Inch',
                'kategori' => 'Perlengkapan',
                'jumlah' => 15,
                'stok_minimum' => 5,
                'kondisi' => 'Baik',
                'tanggal_kadaluarsa' => null,
                'qr_code' => 'QR-SLG-001',
                'keterangan' => 'Panjang 30 meter per roll. Disimpan di rak logistik posko.',
                'foto' => null,
            ],
            [
                'kode_barang' => 'PMP-001',
                'nama_barang' => 'Mesin Pompa Air Portabel Tohatsu',
                'kategori' => 'Peralatan',
                'jumlah' => 2,
                'stok_minimum' => 1,
                'kondisi' => 'Rusak Ringan',
                'tanggal_kadaluarsa' => null,
                'qr_code' => 'QR-PMP-001',
                'keterangan' => 'Satu unit mengalami masalah pada busi dan susah distarter. Perlu diservis bulan depan.',
                'foto' => null,
            ],
        ];

        foreach ($data as $item) {
            Inventaris::create($item);
        }
    }
}
