<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1985-07-10',
            'alamat' => 'Jl. Komando Raya No.1, Kota Siaga',
            'jabatan' => 'Komandan',
            'golongan_darah' => 'O',
            'status_aktif' => true,
        ]);

        // Data relawan
        $relawans = [
            ['name' => 'Dewi Lestari', 'jenis_kelamin' => 'Perempuan', 'email' => 'dewi@gmail.com', 'jabatan' => 'Petugas Medis'],
            ['name' => 'Wiza Pramana Putra', 'jenis_kelamin' => 'Laki-laki', 'email' => 'wiza@gmail.com', 'jabatan' => 'Petugas Teknik'],
            ['name' => 'Siti Rahmawati', 'jenis_kelamin' => 'Perempuan', 'email' => 'siti@gmail.com', 'jabatan' => 'Petugas Lapangan'],
            ['name' => 'Andi Nugroho', 'jenis_kelamin' => 'Laki-laki', 'email' => 'andi@gmail.com', 'jabatan' => 'Petugas Senior'],
            ['name' => 'Aang Samudra', 'jenis_kelamin' => 'Laki-laki', 'email' => 'aang@gmail.com', 'jabatan' => 'Danton'],
            ['name' => 'Lina Marlina', 'jenis_kelamin' => 'Perempuan', 'email' => 'lina@gmail.com', 'jabatan' => 'Petugas Medis'],
        ];

        foreach ($relawans as $index => $data) {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'relawan',
                'jenis_kelamin' => $data['jenis_kelamin'],
                'no_hp' => '08'.rand(1000000000, 9999999999),
                'tanggal_lahir' => now()->subYears(rand(22, 35))->format('Y-m-d'),
                'alamat' => 'Jl. Relawan No.'.($index + 1),
                'jabatan' => $data['jabatan'],
                'golongan_darah' => collect(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->random(),
                'status_aktif' => true,
            ]);
        }
    }
}
