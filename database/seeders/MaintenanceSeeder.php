<?php

namespace Database\Seeders;

use App\Models\Inventaris;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    public function run(): void
    {
        $inventarisIds = Inventaris::pluck('id')->toArray();
        if (empty($inventarisIds)) {
            return;
        }

        for ($i = 1; $i <= 10; $i++) {
            // Trik Ninja: Mengacak nilai true/false (Peluang 60% ada nota)
            $adaNota = rand(1, 10) > 4;

            Maintenance::create([
                'inventaris_id' => collect($inventarisIds)->random(),
                'tanggal_servis' => Carbon::now()->subDays(rand(1, 60))->format('Y-m-d'),
                'jenis_servis' => collect(['Ganti Oli Armada', 'Servis Karburator Pompa', 'Ganti Kampas Rem', 'Perbaikan Kelistrikan HT', 'Inspeksi APAR'])->random(),
                'keterangan' => 'Tindakan perbaikan dan pemeliharaan untuk menjaga unit tetap prima (Sesi '.$i.').',
                'biaya' => rand(1, 20) * 50000,
                'status' => collect(['Terjadwal', 'Proses', 'Selesai', 'Batal'])->random(),

                // Jika $adaNota bernilai true, maka isi dengan nama file dummy. Jika false, kosongkan (null).
                'nota_servis' => $adaNota ? 'uploads/maintenance/nota_servis_dummy_'.$i.'.jpg' : null,
            ]);
        }
    }
}
