<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kepala BPK
        User::create([
            'name' => 'Bapak Kepala BPK',
            'email' => 'kepala@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'kepala_bpk',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '6281111111111',
            'tanggal_lahir' => '1970-01-01',
            'alamat' => 'Jl. Pangeran Antasari, Banjarmasin',
            'jabatan' => 'Kepala BPK',
            'golongan_darah' => 'O',
            'status_aktif' => true,
        ]);

        // 2. Admin Inventaris
        User::create([
            'name' => 'Admin Inventaris Utama',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '6282222222222',
            'tanggal_lahir' => '1985-07-10',
            'alamat' => 'Jl. Brigadir Jenderal Hasan Basri No. 3',
            'jabatan' => 'Kepala Logistik',
            'golongan_darah' => 'A+',
            'status_aktif' => true,
        ]);

        // 3. Petugas Lapangan
        $petugas = [
            [
                'name' => 'Ahmad Syaifuddin',
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'ahmadsyai598@gmail.com',
                'jabatan' => 'Petugas Lapangan',
                'no_hp' => '6285849910396', // NOMOR ASLI MU
            ],
            [
                'name' => 'Muhammad Riza Maulana Ibsan (Eza)',
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'eza@gmail.com',
                'jabatan' => 'Petugas Teknik',
                'no_hp' => '6285389115562',
            ],
            // [
            //     'name' => 'Siti Rahmawati',
            //     'jenis_kelamin' => 'Perempuan',
            //     'email' => 'siti@gmail.com',
            //     'jabatan' => 'Petugas Lapangan',
            //     'no_hp' => '62813'.rand(10000000, 99999999), // Dummy Acak
            // ],
            // [
            //     'name' => 'Aang Samudra',
            //     'jenis_kelamin' => 'Laki-laki',
            //     'email' => 'aang@gmail.com',
            //     'jabatan' => 'Komandan Regu',
            //     'no_hp' => '62841'.rand(10000000, 99999999), // Dummy Acak
            // ],
        ];

        foreach ($petugas as $index => $data) {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'petugas_lapangan',
                'jenis_kelamin' => $data['jenis_kelamin'],
                'no_hp' => $data['no_hp'],
                'tanggal_lahir' => now()->subYears(rand(22, 35))->format('Y-m-d'),
                'alamat' => 'Jl. Kayutangi No.'.($index + 1).', Banjarmasin',
                'jabatan' => $data['jabatan'],
                'golongan_darah' => collect(['A+', 'B+', 'O+', 'AB+'])->random(),
                'status_aktif' => true,
            ]);
        }
    }
}
