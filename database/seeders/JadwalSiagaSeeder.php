<?php

namespace Database\Seeders;

use App\Models\JadwalSiaga;
use App\Models\User;
use Illuminate\Database\Seeder;

class JadwalSiagaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Sesuaikan pencarian dengan role baru: 'petugas_lapangan'
        $petugasIds = User::where('role', 'petugas_lapangan')->pluck('id')->toArray();

        // 2. Pasang pelindung anti-error jika data petugas belum ada
        if (empty($petugasIds)) {
            $this->command->warn('Data Petugas Lapangan kosong! Skip Seeder Jadwal Siaga.');

            return;
        }

        foreach (range(1, 14) as $i) {
            JadwalSiaga::create([
                // 3. Gunakan array $petugasIds yang sudah divalidasi
                'user_id' => collect($petugasIds)->random(),
                // Format tanggal dipertegas agar masuk ke MySQL dengan aman
                'tanggal' => now()->addDays($i)->format('Y-m-d'),
                'status' => collect(['Siaga', 'Tugas', 'Istirahat'])->random(),
            ]);
        }
    }
}
