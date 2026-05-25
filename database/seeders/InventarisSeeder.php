<?php

namespace Database\Seeders;

use App\Models\Inventaris;
use Illuminate\Database\Seeder;

class InventarisSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // 4 Data Lama Milikmu (Tetap Dipertahankan)
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
                'foto' => 'uploads/inventaris/1772984058_mobil_pemadam.jpg', // FOTO ASLI
            ],
            [
                'kode_barang' => 'APR-001',
                'nama_barang' => 'APAR Dry Chemical Powder 6 Kg',
                'kategori' => 'Peralatan',
                'jumlah' => 12,
                'stok_minimum' => 5,
                'kondisi' => 'Baik',
                'tanggal_kadaluarsa' => '2028-12-31',
                'qr_code' => 'QR-APR-001',
                'keterangan' => 'Ditempatkan di posko dan di dalam kabin armada. Tekanan tabung masih dalam zona hijau.',
                'foto' => 'uploads/inventaris/1778165164_APAR.png', // FOTO ASLI
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

            // 6 Data Tambahan Baru
            [
                'kode_barang' => 'HLM-001',
                'nama_barang' => 'Helm Safety Pemadam Bullard',
                'kategori' => 'Perlengkapan',
                'jumlah' => 20,
                'stok_minimum' => 10,
                'kondisi' => 'Baik',
                'tanggal_kadaluarsa' => null,
                'qr_code' => 'QR-HLM-001',
                'keterangan' => 'Tahan panas standar NFPA. Disimpan di loker petugas.',
                'foto' => null,
            ],
            [
                'kode_barang' => 'BTS-001',
                'nama_barang' => 'Sepatu Boots Harvik',
                'kategori' => 'Perlengkapan',
                'jumlah' => 20,
                'stok_minimum' => 10,
                'kondisi' => 'Baik',
                'tanggal_kadaluarsa' => null,
                'qr_code' => 'QR-BTS-001',
                'keterangan' => 'Anti paku dan tahan panas radiasi.',
                'foto' => null,
            ],
            [
                'kode_barang' => 'RAD-001',
                'nama_barang' => 'Radio HT Motorola',
                'kategori' => 'Peralatan',
                'jumlah' => 8,
                'stok_minimum' => 4,
                'kondisi' => 'Rusak Berat',
                'tanggal_kadaluarsa' => null,
                'qr_code' => 'QR-RAD-001',
                'keterangan' => '3 Unit mati total butuh ganti baterai dan antena.',
                'foto' => null,
            ],
            [
                'kode_barang' => 'NZL-001',
                'nama_barang' => 'Nozzle Jet/Spray 1.5 Inch',
                'kategori' => 'Peralatan',
                'jumlah' => 6,
                'stok_minimum' => 2,
                'kondisi' => 'Baik',
                'tanggal_kadaluarsa' => null,
                'qr_code' => 'QR-NZL-001',
                'keterangan' => 'Kondisi ulir drat masih sangat baik, tidak bocor.',
                'foto' => null,
            ],
            [
                'kode_barang' => 'JKT-001',
                'nama_barang' => 'Jaket Tahan Panas (Fire Suit)',
                'kategori' => 'Perlengkapan',
                'jumlah' => 15,
                'stok_minimum' => 5,
                'kondisi' => 'Baik',
                'tanggal_kadaluarsa' => null,
                'qr_code' => 'QR-JKT-001',
                'keterangan' => 'Disimpan rapi di loker Mako. Kondisi resleting aman.',
                'foto' => null,
            ],
            [
                'kode_barang' => 'TNG-001',
                'nama_barang' => 'Tangga Lipat Aluminium 5M',
                'kategori' => 'Peralatan',
                'jumlah' => 2,
                'stok_minimum' => 1,
                'kondisi' => 'Rusak Ringan',
                'tanggal_kadaluarsa' => null,
                'qr_code' => 'QR-TNG-001',
                'keterangan' => 'Karet pijakan bawah hilang satu, agak licin jika dipakai di keramik.',
                'foto' => null,
            ],
        ];

        foreach ($data as $item) {
            Inventaris::create($item);
        }
    }
}
