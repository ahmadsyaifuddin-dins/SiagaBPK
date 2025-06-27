<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Insiden;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InsidenSeeder extends Seeder
{
    public function run(): void
    {
        $relawanIds = User::role('relawan')->pluck('id')->toArray();
        $lokasiKalsel = $this->generateKalselLocations();
        $namaWarga = $this->generateKalselNames();

        for ($i = 1; $i <= 20; $i++) {
            $waktuKejadian = Carbon::now()
                ->subDays(rand(0, 30))
                ->subHours(rand(0, 23))
                ->subMinutes(rand(0, 59));

            $statusOptions = ['Dilaporkan', 'Berangkat', 'Tiba di TKP', 'Selesai'];
            $status = $statusOptions[array_rand($statusOptions)];

            $jenisInsiden = $this->generateIncidentType();
            $catatan = $this->generateIncidentNote($jenisInsiden);

            $insiden = Insiden::create([
                'lokasi' => $lokasiKalsel[array_rand($lokasiKalsel)],
                'waktu_kejadian' => $waktuKejadian,
                'status' => $status,
                'catatan' => $catatan,
                'jenis_insiden' => $jenisInsiden,
                'jumlah_korban' => $this->generateCasualties($jenisInsiden),
                'kerugian' => $this->generateDamageCost($jenisInsiden),
                'nama_pelapor' => $namaWarga[array_rand($namaWarga)],
                'kontak_pelapor' => '08' . rand(100000000, 999999999),
                'dilaporkan_oleh' => collect($relawanIds)->random(),
            ]);

            // Tambahkan petugas ke insiden
            $petugas = collect($relawanIds)->random(rand(1, 3));
            $insiden->petugas()->sync($petugas);
        }
    }

    protected function generateKalselLocations(): array
    {
        return [
            // Banjarmasin
            'Jl. A. Yani KM 6, Banjarmasin',
            'Jl. Pangeran Antasari No. 56, Banjarmasin',
            'Jl. Sultan Adam No. 45, Banjarmasin',
            'Jl. Ahmad Yani No. 98, Banjarmasin',
            'Jl. Lambung Mangkurat No. 12, Banjarmasin',
            'Jl. Veteran No. 33, Banjarmasin',
            'Jl. Hasan Basri No. 7, Banjarmasin',
            'Jl. Simpang Sungai Andai, Banjarmasin',
            'Jl. Belitung Darat No. 22, Banjarmasin',
            'Jl. Sungai Jingah No. 15, Banjarmasin',

            // Banjarbaru
            'Jl. A. Yani KM 36, Banjarbaru',
            'Jl. Ahmad Yani No. 1, Landasan Ulin, Banjarbaru',
            'Jl. Panglima Batur No. 5, Banjarbaru',
            'Jl. Trikora No. 8, Banjarbaru',
            'Jl. M.T. Haryono No. 10, Banjarbaru',

            // Kabupaten lainnya
            'Jl. Raya Martapura KM 12, Kab. Banjar',
            'Jl. Pangeran Hidayatullah, Martapura',
            'Jl. A. Syairani No. 45, Kandangan',
            'Jl. Jend. Sudirman No. 23, Barabai',
            'Jl. Panglima Batur No. 7, Tanjung',
            'Jl. Pangeran Samudera No. 3, Marabahan',
            'Jl. Raya Batulicin KM 5, Kab. Tanah Bumbu',
            'Jl. Raya Pelaihari No. 88, Kab. Tanah Laut',
            'Jl. Raya Kotabaru KM 10, Kab. Kotabaru',
            'Jl. Raya Amuntai No. 33, Kab. Hulu Sungai Utara',

            // Lokasi strategis
            'Pasar Terapung Lok Baintan, Kab. Banjar',
            'Pasar Sudimampir, Banjarmasin',
            'Mall Sabilal Muhtadin, Banjarmasin',
            'Bandara Syamsudin Noor, Banjarbaru',
            'Pelabuhan Trisakti, Banjarmasin',
        ];
    }

    protected function generateKalselNames(): array
    {
        return [
            // Nama khas Banjar
            'Muhammad Arifin',
            'Siti Fatimah',
            'Hasanuddin',
            'Norhalisah',
            'Jamaluddin',
            'Rahmawati',
            'Syamsul Bahri',
            'Maimunah',
            'Firdaus',
            'Nurul Huda',

            // Nama umum Kalsel
            'Budi Santoso',
            'Ani Susanti',
            'Agus Salim',
            'Dewi Rahayu',
            'Eko Prasetyo',
            'Fitriani',
            'Guntur Wibowo',
            'Hesti Purnama',
            'Irfan Maulana',
            'Jumiati',

            // Nama dengan marga Banjar
            'Muhammad Syarifuddin',
            'Norhayati binti H. Mursyid',
            'Abdul Qodir',
            'Siti Aisyah binti H. Zaini',
            'H. M. Taufik',

            // Nama Dayak Kalsel
            'Damang Anum',
            'Dambung',
            'Lambung',
            'Tingang',
            'Bungai',
        ];
    }

    protected function generateIncidentType(): string
    {
        $types = [
            'Kebakaran Rumah' => 30,
            'Kebakaran Lahan Gambut' => 25,  // Lebih sering di Kalsel
            'Kebakaran Pasar' => 15,
            'Kebakaran Kendaraan' => 10,
            'Kebakaran Gudang' => 10,
            'Kebakaran Tambang' => 5,        // Relevan dengan Kalsel
            'Kebakaran Kapal' => 5,          // Karena banyak sungai
            'Korsleting Listrik' => 10,
            'Tabung Gas Meledak' => 5,
            'Pohon Tumbang' => 10,
            'Ular Masuk Pemukiman' => 5,
            'Kebocoran Gas' => 5,
            'Kebakaran Hutan' => 15,         // Relevan dengan Kalsel
            'Kebakaran TPA' => 5,
            'Kebakaran SPBU' => 2,
        ];

        $total = array_sum($types);
        $rand = rand(1, $total);
        $current = 0;

        foreach ($types as $type => $weight) {
            $current += $weight;
            if ($rand <= $current) {
                return $type;
            }
        }

        return 'Kebakaran Rumah';
    }

    protected function generateIncidentNote(string $jenisInsiden): string
    {
        $notes = [
            'Kebakaran Rumah' => [
                'Api membakar rumah panggung khas Banjar',
                'Kebakaran terjadi di dapur saat memasak menggunakan kayu bakar',
                'Rumah terbakar akibat korsleting listrik',
                'Api menjalar cepat karena material kayu',
                'Kebakaran terjadi saat penghuni sedang tidak di rumah',
            ],
            'Kebakaran Lahan Gambut' => [
                'Kebakaran lahan gambut seluas 10 hektar',
                'Asap tebal mengganggu jarak pandang di jalan raya',
                'Petugas kesulitan memadamkan karena api di bawah permukaan',
                'Diduga akibat pembakaran lahan ilegal',
                'Kebakaran terjadi di area bekas tambang',
            ],
            'Kebakaran Pasar' => [
                'Kebakaran terjadi di Pasar Terapung Lok Baintan',
                'Api membakar los pedagang di Pasar Sudimampir',
                'Diduga akibat kompor pedagang yang tidak dimatikan',
                'Kerugian mencapai ratusan juta rupiah',
                'Pasar tradisional terbakar dini hari',
            ],
            'Kebakaran Kendaraan' => [
                'Truk terbakar di Jl. A. Yani KM 6',
                'Mobil terbakar setelah menabrak pembatas jalan',
                'Diduga akibat konsleting kabel listrik kendaraan',
                'Bus terbakar di terminal Banjarmasin',
                'Motor terbakar saat parkir di area pasar',
            ],
            'Kebakaran Gudang' => [
                'Gudang penyimpanan kayu terbakar hebat',
                'Api menyebar cepat karena material yang mudah terbakar',
                'Diduga akibat puntung rokok yang dibuang sembarangan',
                'Gudang makanan terbakar di kawasan industri',
                'Kerugian diperkirakan mencapai miliaran rupiah',
            ],
            'Kebakaran Tambang' => [
                'Kebakaran terjadi di area tambang batu bara',
                'Api menyala di tempat penyimpanan bahan bakar',
                'Pekerja berhasil dievakuasi semua',
                'Diduga akibat percikan api dari alat berat',
                'Kebakaran di area tambang emas ilegal',
            ],
            'Kebakaran Kapal' => [
                'Kapal klotok terbakar di Sungai Martapura',
                'Kebakaran terjadi di mesin kapal barang',
                'Penumpang berhasil dievakuasi ke tepian sungai',
                'Diduga akibat kebocoran bahan bakar',
                'Kapal kayu terbakar saat bersandar di pelabuhan',
            ],
            'Korsleting Listrik' => [
                'Korsleting terjadi di panel listrik utama',
                'Percikan api terlihat dari stop kontak yang rusak',
                'Listrik padam sebelum kebakaran terjadi',
                'Diduga akibat beban listrik berlebihan',
                'Kabel listrik terbakar di plafon rumah',
            ],
            'Tabung Gas Meledak' => [
                'Ledakan tabung gas 3 kg terdengar hingga radius 100m',
                'Diduga selang gas bocor dan terbakar api kompor',
                'Jendela rumah pecah akibat ledakan',
                'Pemilik luka bakar derajat dua',
                'Tabung gas meledak saat sedang memasak',
            ],
            'Pohon Tumbang' => [
                'Pohon tumbang menimpa 2 mobil yang parkir',
                'Batang pohon besar memblokir jalan utama',
                'Diduga akibat akar yang lapuk dan angin kencang',
                'Pohon tumbang mengenai kabel listrik',
                'Tidak ada korban jiwa, hanya kerusakan properti',
            ],
            'Ular Masuk Pemukiman' => [
                'Ular piton sepanjang 3 meter ditemukan di kamar mandi',
                'Warga panik melihat ular kobra di pekarangan',
                'Ular masuk melalui saluran air yang rusak',
                'Diduga ular keluar dari selokan saat hujan deras',
                'Petugas berhasil menangkap ular tanpa cedera',
            ],
            'Kebocoran Gas' => [
                'Kebocoran gas terdeteksi di kompleks perumahan',
                'Warga melaporkan bau gas yang menyengat',
                'Diduga akibat instalasi gas yang tidak benar',
                'Petugas berhasil mengamankan tabung gas bocor',
                'Tidak terjadi kebakaran, hanya kebocoran',
            ],
            'Kebakaran Hutan' => [
                'Kebakaran hutan di kawasan Pegunungan Meratus',
                'Api menyebar cepat karena musim kemarau',
                'Petugas kesulitan mencapai lokasi',
                'Diduga akibat pembukaan lahan dengan cara dibakar',
                'Asap mengganggu penerbangan di Bandara Syamsudin Noor',
            ],
            'Kebakaran TPA' => [
                'Kebakaran terjadi di Tempat Pembuangan Akhir',
                'Asap hitam pekat terlihat dari jarak jauh',
                'Diduga akibat gas metana yang terbakar',
                'Petugas menggunakan alat berat untuk memadamkan',
                'Kebakaran berlangsung selama 2 hari',
            ],
            'Kebakaran SPBU' => [
                'Kebakaran terjadi di SPBU Jl. A. Yani',
                'Petugas berhasil mengevakuasi semua orang',
                'Diduga akibat kesalahan pengisian bahan bakar',
                'Pompa bensin hancur terbakar',
                'Kerugian diperkirakan mencapai miliaran rupiah',
            ],
        ];

        return $notes[$jenisInsiden][array_rand($notes[$jenisInsiden])];
    }

    protected function generateCasualties(string $jenisInsiden): int
    {
        $casualtyRanges = [
            'Kebakaran Rumah' => [0, 3],
            'Kebakaran Lahan Gambut' => [0, 0],
            'Kebakaran Pasar' => [0, 5],
            'Kebakaran Kendaraan' => [0, 2],
            'Kebakaran Gudang' => [0, 1],
            'Kebakaran Tambang' => [0, 5],
            'Kebakaran Kapal' => [0, 3],
            'Korsleting Listrik' => [0, 1],
            'Tabung Gas Meledak' => [0, 2],
            'Pohon Tumbang' => [0, 1],
            'Ular Masuk Pemukiman' => [0, 0],
            'Kebocoran Gas' => [0, 2],
            'Kebakaran Hutan' => [0, 0],
            'Kebakaran TPA' => [0, 0],
            'Kebakaran SPBU' => [0, 3],
        ];

        $range = $casualtyRanges[$jenisInsiden];
        return rand($range[0], $range[1]);
    }

    protected function generateDamageCost(string $jenisInsiden): string
    {
        $costRanges = [
            'Kebakaran Rumah' => [50000000, 500000000],
            'Kebakaran Lahan Gambut' => [100000000, 1000000000],
            'Kebakaran Pasar' => [200000000, 2000000000],
            'Kebakaran Kendaraan' => [10000000, 500000000],
            'Kebakaran Gudang' => [100000000, 500000000],
            'Kebakaran Tambang' => [500000000, 5000000000],
            'Kebakaran Kapal' => [100000000, 1000000000],
            'Korsleting Listrik' => [1000000, 50000000],
            'Tabung Gas Meledak' => [5000000, 100000000],
            'Pohon Tumbang' => [1000000, 50000000],
            'Ular Masuk Pemukiman' => [0, 0],
            'Kebocoran Gas' => [1000000, 50000000],
            'Kebakaran Hutan' => [100000000, 500000000],
            'Kebakaran TPA' => [100000000, 500000000],
            'Kebakaran SPBU' => [1000000000, 5000000000],
        ];

        $range = $costRanges[$jenisInsiden];
        $amount = rand($range[0], $range[1]);

        return $amount > 0 ? 'Rp ' . number_format($amount, 0, ',', '.') : 'Tidak ada kerugian material';
    }
}
