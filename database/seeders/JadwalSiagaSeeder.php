<?php

namespace Database\Seeders;

use App\Models\JadwalSiaga;
use App\Models\User;
use Illuminate\Database\Seeder;

class JadwalSiagaSeeder extends Seeder
{
    public function run(): void
    {
        $relawanIds = User::where('role', 'relawan')->pluck('id')->toArray();

        foreach (range(1, 14) as $i) {
            JadwalSiaga::create([
                'user_id' => collect($relawanIds)->random(),
                'tanggal' => now()->addDays($i),
                'status' => collect(['Siaga', 'Tugas', 'Istirahat'])->random(),
            ]);
        }
    }
}
