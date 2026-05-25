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
            'no_hp' => '081111111111',
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
            'no_hp' => '082222222222',
            'tanggal_lahir' => '1985-07-10',
            'alamat' => 'Jl. Brigadir Jenderal Hasan Basri No. 3',
            'jabatan' => 'Kepala Logistik',
            'golongan_darah' => 'A+',
            'status_aktif' => true,
        ]);

        // 3. Petugas Lapangan (10 Data)
        $petugas = [
            [
                'name' => 'Budi Santoso', // NAMA SAMARAN UNTUK NOMORMU
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'budi@gmail.com', // Email disamarkan
                'jabatan' => 'Petugas Lapangan',
                'no_hp' => '085849910396', // NOMOR ASLI (Ahmad Syaifuddin)
            ],
            [
                'name' => 'Muhammad Riza Maulana Ibsan (Eza)', // NAMA ASLI EZA
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'eza@gmail.com',
                'jabatan' => 'Petugas Teknik',
                'no_hp' => '085389115562', // NOMOR ASLI EZA
            ],
            ['name' => 'Siti Rahmawati', 'jenis_kelamin' => 'Perempuan', 'email' => 'siti@gmail.com', 'jabatan' => 'Petugas Medis', 'no_hp' => '081312345678'],
            ['name' => 'Hendra Gunawan', 'jenis_kelamin' => 'Laki-laki', 'email' => 'hendra@gmail.com', 'jabatan' => 'Komandan Regu 1', 'no_hp' => '081298765432'],
            ['name' => 'Rina Amelia', 'jenis_kelamin' => 'Perempuan', 'email' => 'rina@gmail.com', 'jabatan' => 'Operator Radio', 'no_hp' => '085711223344'],
            ['name' => 'Faisal Rahman', 'jenis_kelamin' => 'Laki-laki', 'email' => 'faisal@gmail.com', 'jabatan' => 'Driver Armada', 'no_hp' => '081988776655'],
            ['name' => 'Dwi Cahyo', 'jenis_kelamin' => 'Laki-laki', 'email' => 'dwi@gmail.com', 'jabatan' => 'Petugas Lapangan', 'no_hp' => '082155443322'],
            ['name' => 'Ahmad Fauzi', 'jenis_kelamin' => 'Laki-laki', 'email' => 'fauzi@gmail.com', 'jabatan' => 'Petugas Lapangan', 'no_hp' => '085244556677'],
            ['name' => 'Yusuf Maulana', 'jenis_kelamin' => 'Laki-laki', 'email' => 'yusuf@gmail.com', 'jabatan' => 'Petugas Lapangan', 'no_hp' => '081399887766'],
            ['name' => 'Kurniawan', 'jenis_kelamin' => 'Laki-laki', 'email' => 'kurniawan@gmail.com', 'jabatan' => 'Komandan Regu 2', 'no_hp' => '081233445566'],
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
                'alamat' => 'Jl. Kayutangi Blok '.chr(65 + $index).' No. '.rand(1, 50),
                'jabatan' => $data['jabatan'],
                'golongan_darah' => collect(['A+', 'B+', 'O+', 'AB+'])->random(),
                'status_aktif' => true,
            ]);
        }
    }
}
