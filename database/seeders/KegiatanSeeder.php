<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul_kegiatan' => 'Latihan Gabungan Penyemprotan', 'tanggal_kegiatan' => Carbon::now()->subDays(2)->format('Y-m-d 09:00:00'), 'lokasi' => 'Lapangan Kayutangi', 'deskripsi' => 'Fokus kecepatan gelar selang.', 'status' => 'Selesai'],
            ['judul_kegiatan' => 'Sosialisasi Bahaya Korsleting', 'tanggal_kegiatan' => Carbon::now()->subDays(5)->format('Y-m-d 14:00:00'), 'lokasi' => 'Kelurahan Alalak Utara', 'deskripsi' => 'Penyuluhan warga.', 'status' => 'Selesai'],
            ['judul_kegiatan' => 'Pembersihan Mako & Cek Mesin', 'tanggal_kegiatan' => Carbon::now()->subDays(10)->format('Y-m-d 08:30:00'), 'lokasi' => 'Mako KTC Fire', 'deskripsi' => 'Giat rutin mingguan.', 'status' => 'Selesai'],
            ['judul_kegiatan' => 'Edukasi Damkar Cilik', 'tanggal_kegiatan' => Carbon::now()->subDays(15)->format('Y-m-d 09:00:00'), 'lokasi' => 'TK Bhayangkari', 'deskripsi' => 'Pengenalan profesi pemadam ke anak TK.', 'status' => 'Selesai'],
            ['judul_kegiatan' => 'Pengecekan Hydrant Kota', 'tanggal_kegiatan' => Carbon::now()->subDays(20)->format('Y-m-d 10:00:00'), 'lokasi' => 'Sepanjang Jl. Hasan Basri', 'deskripsi' => 'Cek tekanan air hydrant kota.', 'status' => 'Selesai'],
            ['judul_kegiatan' => 'Rapat Koordinasi Balakar', 'tanggal_kegiatan' => Carbon::now()->subDays(25)->format('Y-m-d 20:00:00'), 'lokasi' => 'Balaikota Banjarmasin', 'deskripsi' => 'Rapat zonasi wilayah pemadaman.', 'status' => 'Selesai'],
            ['judul_kegiatan' => 'Pelatihan P3K & Evakuasi Medis', 'tanggal_kegiatan' => Carbon::now()->subMonth()->format('Y-m-d 09:00:00'), 'lokasi' => 'Mako KTC Fire', 'deskripsi' => 'Pemateri dari PMI Banjarmasin.', 'status' => 'Selesai'],
            ['judul_kegiatan' => 'Kerja Bakti Susur Sungai', 'tanggal_kegiatan' => Carbon::now()->subDays(35)->format('Y-m-d 08:00:00'), 'lokasi' => 'Sungai Awang', 'deskripsi' => 'Pembersihan eceng gondok untuk sumber air.', 'status' => 'Selesai'],
            ['judul_kegiatan' => 'Ujian Fisik Anggota Baru', 'tanggal_kegiatan' => Carbon::now()->addDays(3)->format('Y-m-d 07:00:00'), 'lokasi' => 'Stadion Lambung Mangkurat', 'deskripsi' => 'Tes lari dan ketahanan.', 'status' => 'Akan Datang'],
            ['judul_kegiatan' => 'Inspeksi APAR Instansi', 'tanggal_kegiatan' => Carbon::now()->addDays(7)->format('Y-m-d 10:00:00'), 'lokasi' => 'Kantor Kelurahan', 'deskripsi' => 'Bantuan teknis pengecekan APAR.', 'status' => 'Akan Datang'],
        ];

        foreach ($data as $item) {
            Kegiatan::create($item);
        }
    }
}
