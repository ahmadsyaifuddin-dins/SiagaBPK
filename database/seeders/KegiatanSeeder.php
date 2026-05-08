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
            [
                'judul_kegiatan' => 'Latihan Gabungan BPK se-Banjarmasin Utara',
                'tanggal_kegiatan' => Carbon::now()->subDays(5)->format('Y-m-d 09:00:00'),
                'lokasi' => 'Lapangan Kayutangi, Banjarmasin',
                'deskripsi' => 'Latihan gabungan penyemprotan air dan simulasi evakuasi korban kebakaran bersama beberapa unit BPK swasta lainnya. Fokus pada kecepatan penggelaran selang.',
                'foto' => null,
                'status' => 'Selesai',
            ],
            [
                'judul_kegiatan' => 'Sosialisasi Pencegahan Kebakaran Pemukiman Padat',
                'tanggal_kegiatan' => Carbon::now()->subMonth()->format('Y-m-d 14:00:00'),
                'lokasi' => 'Kelurahan Alalak Utara',
                'deskripsi' => 'Penyuluhan kepada warga tentang penggunaan APAR sederhana dan langkah awal yang harus dilakukan jika terjadi korsleting listrik di rumah kayu.',
                'foto' => null,
                'status' => 'Selesai',
            ],
            [
                'judul_kegiatan' => 'Kerja Bakti Pembersihan Mako dan Pengecekan Mesin',
                'tanggal_kegiatan' => Carbon::now()->addDays(2)->format('Y-m-d 08:30:00'),
                'lokasi' => 'Mako BPK KTC Fire',
                'deskripsi' => 'Agenda rutin mingguan untuk pemanasan mesin armada, pengecekan tekanan kompresor pompa air portabel, dan pembersihan area posko.',
                'foto' => null,
                'status' => 'Terjadwal',
            ],
        ];

        foreach ($data as $item) {
            Kegiatan::create($item);
        }
    }
}
