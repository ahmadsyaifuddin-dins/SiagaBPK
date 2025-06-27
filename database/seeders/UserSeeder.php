<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat role jika belum ada
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'relawan']);

        // Admin
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@bpk.com',
            'password' => Hash::make('adminbpk123'),
            'role' => 'admin',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1985-07-10',
            'alamat' => 'Jl. Komando Raya No.1, Kota Siaga',
            'jabatan' => 'Komandan',
            'golongan_darah' => 'O',
            'status_aktif' => true,
        ]);
        $admin->assignRole('admin');

        // Data relawan manusiawi
        $relawans = [
            ['name' => 'Dewi Lestari', 'jenis_kelamin' => 'Perempuan', 'email' => 'dewi@bpk.com', 'jabatan' => 'Petugas Medis'],
            ['name' => 'Wiza Pramana Putra', 'jenis_kelamin' => 'Laki-laki', 'email' => 'wiza@bpk.com', 'jabatan' => 'Petugas Teknik'],
            ['name' => 'Siti Rahmawati', 'jenis_kelamin' => 'Perempuan', 'email' => 'siti@bpk.com', 'jabatan' => 'Petugas Lapangan'],
            ['name' => 'Andi Nugroho', 'jenis_kelamin' => 'Laki-laki', 'email' => 'andi@bpk.com', 'jabatan' => 'Petugas Senior'],
            ['name' => 'Aang Samudra', 'jenis_kelamin' => 'Laki-laki', 'email' => 'aang@bpk.com', 'jabatan' => 'Danton'],
            ['name' => 'Lina Marlina', 'jenis_kelamin' => 'Perempuan', 'email' => 'lina@bpk.com', 'jabatan' => 'Petugas Medis'],
        ];

        foreach ($relawans as $index => $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('relawanbpk123'),
                'jenis_kelamin' => $data['jenis_kelamin'],
                'no_hp' => '08' . rand(1000000000, 9999999999),
                'tanggal_lahir' => now()->subYears(rand(22, 35))->format('Y-m-d'),
                'alamat' => 'Jl. Relawan No.' . ($index + 1),
                'jabatan' => $data['jabatan'],
                // 'jabatan' => collect(['Komandan','Wakil Komandan','Petugas Senior','Petugas Junior','Anggota Regu','Petugas Medis','Petugas Teknis','Petugas Lapangan','Danton'])->random(),
                'golongan_darah' => collect(['A+','A-','B+','B-','AB+','AB-','O+','O-'])->random(),
                'status_aktif' => true,
            ]);
            $user->assignRole('relawan');
        }
    }
}
