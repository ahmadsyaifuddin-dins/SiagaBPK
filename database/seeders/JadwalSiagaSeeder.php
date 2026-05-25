<?php

namespace Database\Seeders;

use App\Models\JadwalSiaga;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JadwalSiagaSeeder extends Seeder
{
    public function run(): void
    {
        $petugasIds = User::where('role', 'petugas_lapangan')->pluck('id')->toArray();
        if (empty($petugasIds)) {
            return;
        }

        // Buat jadwal untuk 30 hari ke belakang dan 10 hari ke depan
        for ($i = -30; $i <= 10; $i++) {
            // Setiap hari ada 3 orang yang piket bergantian
            for ($j = 0; $j < 3; $j++) {
                JadwalSiaga::create([
                    'user_id' => collect($petugasIds)->random(),
                    'tanggal' => Carbon::now()->addDays($i)->format('Y-m-d'),
                    'status' => collect(['Siaga', 'Tugas', 'Istirahat'])->random(),
                ]);
            }
        }
    }
}
