<?php

namespace Database\Seeders;

use App\Models\Insiden;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InsidenSeeder extends Seeder
{
    /**
     * Wilayah Kota Banjarmasin (5 kecamatan & 52 kelurahan).
     */
    protected array $wilayah = [
        'Banjarmasin Barat' => [
            'Basirih', 'Belitung Selatan', 'Belitung Utara', 'Kuin Cerucuk', 'Kuin Selatan',
            'Pelambuan', 'Telaga Biru', 'Telawang', 'Teluk Tiram',
        ],
        'Banjarmasin Selatan' => [
            'Basirih Selatan', 'Kelayan Barat', 'Kelayan Dalam', 'Kelayan Tengah', 'Kelayan Timur',
            'Kelayan Selatan', 'Mantuil', 'Murung Raya', 'Pekauman', 'Pemurus Baru', 'Pemurus Dalam', 'Tanjung Pagar',
        ],
        'Banjarmasin Tengah' => [
            'Antasan Besar', 'Gadang', 'Kertak Baru Ilir', 'Kertak Baru Ulu', 'Kelayan Luar',
            'Mawar', 'Melayu', 'Pasar Lama', 'Pekapuran Laut', 'Seberang Mesjid', 'Sungai Baru', 'Teluk Dalam',
        ],
        'Banjarmasin Timur' => [
            'Benua Anyar', 'Karang Mekar', 'Kebun Bunga', 'Kuripan', 'Pekapuran Raya',
            'Pemurus Luar', 'Pengambangan', 'Sungai Bilu', 'Sungai Lulut',
        ],
        'Banjarmasin Utara' => [
            'Alalak Utara', 'Alalak Tengah', 'Alalak Selatan', 'Antasan Kecil Timur', 'Kuin Utara',
            'Pangeran', 'Sungai Andai', 'Sungai Jingah', 'Sungai Miai', 'Surgi Mufti',
        ],
    ];

    protected array $namaJalan = [
        'Jl. A. Yani KM 1', 'Jl. A. Yani KM 4', 'Jl. Pangeran Antasari', 'Jl. Sultan Adam',
        'Jl. Lambung Mangkurat', 'Jl. Veteran', 'Jl. Hasan Basri', 'Jl. Belitung Darat',
        'Jl. Cempaka Besar', 'Jl. Cempaka Kecil', 'Jl. Kuripan', 'Jl. Gadang',
        'Jl. Pekauman', 'Jl. Kelayan', 'Jl. Pemurus', 'Jl. Alalak',
        'Jl. Kuin', 'Jl. Sungai Jingah', 'Jl. Teluk Tiram', 'Jl. Telawang',
        'Jl. Pelambuan', 'Jl. Sungai Andai', 'Jl. Surgi Mufti', 'Gang Perdamaian',
        'Gang Keluarga', 'Gang Makmur', 'Lorong Kenanga', 'Jl. Sari Bakti',
        'Jl. Anggrek', 'Jl. Flamboyan', 'Jl. Kamboja', 'Jl. Merpati',
    ];

    protected array $tempatUmum = [
        'Pasar Sudimampir', 'Pasar Antasari', 'Pasar Kuripan', 'Pasar Gubah', 'Terminal Kaca Piring',
        'Pelabuhan Trisakti', 'Kawasan Sungai Martapura', 'RSU Anshari Saleh', 'RSUD Ulin',
        'Universitas Lambung Mangkurat', 'Kampus UNISKA', 'Perumahan Griya Agung',
        'Perumahan Alalak Indah', 'Kawasan Bisnis Jl. A. Yani',
    ];

    protected array $namaWarga = [
        'Muhammad Arifin', 'Siti Fatimah', 'Hasanuddin', 'Norhalisah', 'Jamaluddin',
        'Rahmawati', 'Syamsul Bahri', 'Maimunah', 'Firdaus', 'Nurul Huda',
        'Budi Santoso', 'Ani Susanti', 'Agus Salim', 'Dewi Rahayu', 'Eko Prasetyo',
        'Fitriani', 'Guntur Wibowo', 'Hesti Purnama', 'Irfan Maulana', 'Jumiati',
        'H. M. Taufik', 'Norhayati binti H. Mursyid', 'Abdul Qodir', 'Rusdiansyah', 'Wahyuni Hartati',
        'Muhammad Ridwan', 'Laila Sari', 'Ahmad Fauzi', 'Khairunnisa', 'Zainal Abidin',
    ];

    public function run(): void
    {
        $petugasIds = User::where('role', 'petugas_lapangan')->pluck('id')->toArray();

        if (empty($petugasIds)) {
            $this->command->warn('Data Petugas Lapangan kosong! Pastikan UserSeeder dijalankan terlebih dahulu.');

            return;
        }

        // ===== 1. Insiden besar terjadwal (kejadian menonjol) =====
        foreach ($this->insidenBesar() as $data) {
            $this->buatInsiden($data, $petugasIds);
        }

        // ===== 2. Insiden rutin tersebar 18 bulan terakhir =====
        for ($i = 0; $i < 140; $i++) {
            $this->buatInsiden($this->generateInsidenAcak(), $petugasIds);
        }
    }

    private function buatInsiden(array $data, array $petugasIds): void
    {
        $totalKorban = $data['korban_meninggal'] + $data['korban_luka_berat'] + $data['korban_luka_ringan'];

        $insiden = Insiden::create(array_merge($data, [
            'jumlah_korban' => max($totalKorban, $data['jumlah_korban'] ?? 0),
            'kerugian' => $data['kerugian_material'] > 0
                ? 'Rp '.number_format($data['kerugian_material'], 0, ',', '.')
                : null,
            'nama_pelapor' => $this->namaWarga[array_rand($this->namaWarga)],
            'kontak_pelapor' => '08'.rand(1000000000, 9999999999),
            'dilaporkan_oleh' => collect($petugasIds)->random(),
            'status' => Carbon::parse($data['waktu_kejadian'])->diffInDays(now()) > 3
                ? 'Selesai'
                : collect(['Dilaporkan', 'Berangkat', 'Tiba di TKP', 'Selesai'])->random(),
        ]));

        $jumlahPetugas = rand(1, min(3, count($petugasIds)));
        $insiden->petugas()->sync(collect($petugasIds)->random($jumlahPetugas));
    }

    private function pilihWilayah(): array
    {
        $kecamatan = array_rand($this->wilayah);
        $kelurahan = $this->wilayah[$kecamatan][array_rand($this->wilayah[$kecamatan])];

        return [$kecamatan, $kelurahan];
    }

    private function generateInsidenAcak(): array
    {
        [$kecamatan, $kelurahan] = $this->pilihWilayah();
        $jenis = $this->pilihJenisInsiden();

        $lokasi = rand(1, 100) <= 75
            ? $this->namaJalan[array_rand($this->namaJalan)].", Kel. {$kelurahan}"
            : $this->tempatUmum[array_rand($this->tempatUmum)].", Kel. {$kelurahan}";

        return array_merge([
            'lokasi' => $lokasi,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'jenis_insiden' => $jenis,
            'waktu_kejadian' => Carbon::now()->subMonths(rand(0, 17))->subDays(rand(0, 27))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
            'catatan' => $this->catatanAcak($jenis),
            'latitude' => '-3.' . rand(290000, 340000),
            'longitude' => '114.'.rand(790000, 850000),
        ], $this->detailKejadian($jenis));
    }

    private function insidenBesar(): array
    {
        $besar = [];

        // Kebakaran pasar besar
        $besar[] = $this->susun('Kebakaran Pasar', 'Banjarmasin Tengah', 'Pasar Lama', 'Pasar Antasari', 8, 24);
        $besar[0]['rumah_terbakar'] = 0;
        $besar[0]['bangunan_lain_terdampak'] = 42;
        $besar[0]['luas_area_dampak'] = 1800;
        $besar[0]['kerugian_material'] = 2150000000;
        $besar[0]['korban_luka_ringan'] = 3;
        $besar[0]['catatan'] = 'Api membakar puluhan los pedagang. Diduga akibat korsleting instalasi listrik pada malam hari.';

        // Kebakaran permukiman padat (puluhan rumah)
        $besar[] = $this->susun('Kebakaran Permukiman Padat', 'Banjarmasin Utara', 'Sungai Jingah', 'Jl. Sungai Jingah', 14, 30);
        $besar[1]['rumah_terbakar'] = 27;
        $besar[1]['rumah_rusak'] = 9;
        $besar[1]['luas_area_dampak'] = 2600;
        $besar[1]['kerugian_material'] = 1850000000;
        $besar[1]['korban_meninggal'] = 1;
        $besar[1]['korban_luka_berat'] = 2;
        $besar[1]['korban_luka_ringan'] = 6;
        $besar[1]['korban_jiwa_terdampak'] = 118;
        $besar[1]['korban_mengungsi_kk'] = 34;
        $besar[1]['korban_mengungsi_jiwa'] = 112;
        $besar[1]['catatan'] = 'Api menjalar cepat di gang sempit permukiman panggung di tepi sungai. Warga dievakuasi ke balai desa.';

        // Kebakaran gudang
        $besar[] = $this->susun('Kebakaran Gudang', 'Banjarmasin Barat', 'Teluk Tiram', 'Kawasan Pelabuhan Trisakti', 20, 40);
        $besar[2]['bangunan_lain_terdampak'] = 3;
        $besar[2]['luas_area_dampak'] = 3200;
        $besar[2]['kendaraan_terbakar'] = 2;
        $besar[2]['kerugian_material'] = 4200000000;
        $besar[2]['catatan'] = 'Gudang penyimpanan barang impor terbakar. Kerugian mencapai miliaran rupiah.';

        return $besar;
    }

    private function susun(string $jenis, string $kecamatan, string $kelurahan, string $lokasi, int $minHari, int $maxHari): array
    {
        return array_merge([
            'jenis_insiden' => $jenis,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'lokasi' => $lokasi.', Kel. '.$kelurahan.', '.$kecamatan,
            'waktu_kejadian' => Carbon::now()->subDays(rand($minHari, $maxHari))->subHours(rand(0, 23)),
            'latitude' => '-3.'.rand(290000, 340000),
            'longitude' => '114.'.rand(790000, 850000),
            'catatan' => $this->catatanAcak($jenis),
            'korban_meninggal' => 0,
            'korban_luka_berat' => 0,
            'korban_luka_ringan' => 0,
            'korban_jiwa_terdampak' => 0,
            'korban_mengungsi_kk' => 0,
            'korban_mengungsi_jiwa' => 0,
            'rumah_terbakar' => 0,
            'rumah_rusak' => 0,
            'bangunan_lain_terdampak' => 0,
            'kendaraan_terbakar' => 0,
            'luas_area_dampak' => 0,
            'kerugian_material' => 0,
        ]);
    }

    private function pilihJenisInsiden(): string
    {
        $jenis = [
            'Kebakaran Rumah Tinggal' => 28,
            'Kebakaran Rumah Panggung' => 18,
            'Korsleting Listrik' => 12,
            'Tabung Gas Meledak' => 7,
            'Kebakaran Kendaraan' => 10,
            'Kebakaran Toko / Ruko' => 6,
            'Kebakaran Lahan Kosong' => 9,
            'Pohon Tumbang' => 6,
            'Kapal / Klotok Terbakar' => 4,
            'Ular Masuk Permukiman' => 4,
            'Rescue / Pertolongan Warga' => 4,
            'Kebocoran Gas' => 3,
        ];

        $total = array_sum($jenis);
        $rand = rand(1, $total);
        $current = 0;

        foreach ($jenis as $tipe => $bobot) {
            $current += $bobot;
            if ($rand <= $current) {
                return $tipe;
            }
        }

        return 'Kebakaran Rumah Tinggal';
    }

    /**
     * Detail korban & kerugian yang wajar sesuai jenis kejadian.
     */
    private function detailKejadian(string $jenis): array
    {
        $d = [
            'korban_meninggal' => 0, 'korban_luka_berat' => 0, 'korban_luka_ringan' => 0,
            'korban_jiwa_terdampak' => 0, 'korban_mengungsi_kk' => 0, 'korban_mengungsi_jiwa' => 0,
            'rumah_terbakar' => 0, 'rumah_rusak' => 0, 'bangunan_lain_terdampak' => 0,
            'kendaraan_terbakar' => 0, 'luas_area_dampak' => 0, 'kerugian_material' => 0,
        ];

        switch ($jenis) {
            case str_contains($jenis, 'Rumah'):
                $terbakar = rand(1, 3);
                $rusak = rand(0, 1);
                $jiwa = $terbakar * rand(3, 6);

                $d['rumah_terbakar'] = $terbakar;
                $d['rumah_rusak'] = $rusak;
                $d['korban_jiwa_terdampak'] = $jiwa + $rusak * rand(2, 4);

                if (rand(1, 100) <= 55) {
                    $kk = rand(1, $terbakar + 1);
                    $d['korban_mengungsi_kk'] = $kk;
                    $d['korban_mengungsi_jiwa'] = $kk * rand(3, 5);
                }
                if (rand(1, 100) <= 15) {
                    $d['korban_luka_ringan'] = rand(1, 2);
                }

                $d['luas_area_dampak'] = rand(60, 250) * ($terbakar + $rusak);
                $d['kerugian_material'] = rand(45, 350) * 1000000;
                break;

            case 'Tabung Gas Meledak':
                $d['rumah_terbakar'] = rand(0, 1);
                $d['rumah_rusak'] = rand(1, 2);
                $d['korban_luka_berat'] = rand(0, 1);
                $d['korban_luka_ringan'] = rand(0, 2);
                $d['korban_jiwa_terdampak'] = rand(2, 8);
                $d['kerugian_material'] = rand(10, 120) * 1000000;
                break;

            case 'Korsleting Listrik':
                if (rand(1, 100) <= 50) {
                    $d['rumah_terbakar'] = 1;
                    $d['korban_jiwa_terdampak'] = rand(1, 5);
                    $d['kerugian_material'] = rand(25, 180) * 1000000;
                } else {
                    $d['kerugian_material'] = rand(1, 20) * 1000000;
                }
                break;

            case 'Kebakaran Kendaraan':
                $d['kendaraan_terbakar'] = rand(1, 3);
                if (rand(1, 100) <= 20) {
                    $d['korban_luka_ringan'] = 1;
                }
                $d['kerugian_material'] = rand(8, 220) * 1000000;
                break;

            case 'Kebakaran Toko / Ruko':
                $d['bangunan_lain_terdampak'] = rand(1, 4);
                $d['korban_jiwa_terdampak'] = rand(1, 6);
                $d['kerugian_material'] = rand(80, 900) * 1000000;
                break;

            case 'Kebakaran Lahan Kosong':
                $d['luas_area_dampak'] = rand(500, 8000);
                $d['kerugian_material'] = rand(5, 60) * 1000000;
                break;

            case 'Pohon Tumbang':
                $d['kendaraan_terbakar'] = 0;
                if (rand(1, 100) <= 35) {
                    $d['rumah_rusak'] = rand(1, 2);
                }
                if (rand(1, 100) <= 15) {
                    $d['korban_luka_ringan'] = 1;
                }
                $d['kerugian_material'] = rand(3, 50) * 1000000;
                break;

            case 'Kapal / Klotok Terbakar':
                $d['bangunan_lain_terdampak'] = 1;
                $d['korban_jiwa_terdampak'] = rand(1, 5);
                if (rand(1, 100) <= 30) {
                    $d['korban_luka_ringan'] = rand(1, 2);
                }
                $d['kerugian_material'] = rand(60, 700) * 1000000;
                break;

            case 'Ular Masuk Permukiman':
            case 'Rescue / Pertolongan Warga':
            case 'Kebocoran Gas':
                $d['kerugian_material'] = 0;
                break;
        }

        return $d;
    }

    private function catatanAcak(string $jenis): string
    {
        $catatan = [
            'Kebakaran Rumah Tinggal' => [
                'Diduga akibat kompor gas yang ditinggal menyala saat memasak.',
                'Api menjalar cepat karena bangunan berdinding kayu dan papan.',
                'Korsleting listrik pada jalur kabel lama diduga jadi pemicu.',
                'Pemilik berhasil mengeluarkan sebagian barang berharga.',
                'Petugas menyelesaikan pendinginan area agar tidak ada api susulan.',
            ],
            'Kebakaran Rumah Panggung' => [
                'Rumah panggung di tepi sungai sulit dijangkau armada besar.',
                'Api membakar bagian dapur lalu menjalar ke seluruh rumah.',
                'Warga membantu pemadaman awal dengan ember air sungai.',
                'Material kayu ulin kering membuat api cepat membesar.',
            ],
            'Kebakaran Permukiman Padat' => [
                'Gang sempit menyulitkan akses mobil pemadam.',
                'Api menjalar ke rumah tetangga akibat angin kencang.',
                'Evakuasi warga dilakukan bersama petugas dan relawan.',
                'Dua unit mobil tangki ditambah dukungan air dari sungai.',
            ],
            'Korsleting Listrik' => [
                'Percikan api berasal dari panel listrik utama.',
                'Beban listrik berlebih diduga memicu percikan pada sambungan kabel.',
                'PLN telah memutus arus saat penanganan berlangsung.',
            ],
            'Tabung Gas Meledak' => [
                'Ledakan terjadi saat tabung gas 3 kg sedang dipindahkan.',
                'Selang gas bocor diduga menjadi penyebab kebakaran dapur.',
                'Kaca jendela pecah akibat ledakan, tidak ada api menjalar.',
            ],
            'Kebakaran Kendaraan' => [
                'Motor terbakar saat parkir, diduga karena kabel bodi terkelupas.',
                'Mobil terbakar dari bagian mesin di depan.',
                'Api berhasil dipadamkan sebelum menjalar ke kendaraan lain.',
            ],
            'Kebakaran Toko / Ruko' => [
                'Api mulai dari bagian gudang belakang toko.',
                'Barang elektronik cepat terbakar dan menghasilkan asap tebal.',
                'Petugas menyisakan satu unit untuk pengamanan lokasi.',
            ],
            'Kebakaran Lahan Kosong' => [
                'Api melanda semak belukar dan sampah di lahan kosong.',
                'Diduga akibat pembakaran sampah yang melebar.',
                'Asap mengganggu lalu lintas warga sekitar.',
            ],
            'Pohon Tumbang' => [
                'Pohon tumbang menerpa pagar rumah saat hujan deras.',
                'Tidak ada korban jiwa, petugas membersihkan ruas jalan.',
                'Batang pohon lapuk roboh menimpa kabel jala.',
            ],
            'Kapal / Klotok Terbakar' => [
                'Kebakaran berasal dari bagian mesin kapal klotok.',
                'Awak kapal berhasil dievakuasi tanpa cedera serius.',
                'Penanganan menggunakan foam karena bahan bakar solar.',
            ],
            'Ular Masuk Permukiman' => [
                'Ular sanca panjang sekitar 3 meter diamankan dari atap rumah.',
                'Warga melapor karena ular masuk pekarangan rumah.',
                'Ular dilepasliarkan ke habitat yang jauh dari permukiman.',
            ],
            'Rescue / Pertolongan Warga' => [
                'Petugas menolong warga yang terjebak lift rumah tinggal.',
                'Evakuasi kucing di tiang listrik atas permintaan warga.',
                'Pertolongan warga sakit yang tidak bisa diturunkan dari rumah panggung tinggi.',
            ],
            'Kebocoran Gas' => [
                'Warga melaporkan bau gas menyengat dari instalasi dapur.',
                'Petugas mengamankan tabung dan memberi sirkulasi udara.',
                'Tidak terjadi kebakaran, area dinyatakan aman.',
            ],
        ];

        $daftar = $catatan[$jenis] ?? ['Penanganan berlangsung lancar tanpa hambatan berarti.'];

        return $daftar[array_rand($daftar)];
    }
}
