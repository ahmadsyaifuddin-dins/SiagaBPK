<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalSiaga;
use App\Models\User;

class JadwalSiagaSeeder extends Seeder
{
    public function run(): void
    {
        $relawanIds = User::role('relawan')->pluck('id')->toArray();

        foreach (range(1, 14) as $i) {
            JadwalSiaga::create([
                'user_id' => collect($relawanIds)->random(),
                'tanggal' => now()->addDays($i),
                'status' => collect(['Siaga', 'Tugas', 'Istirahat'])->random(),
            ]);
        }
    }
}
