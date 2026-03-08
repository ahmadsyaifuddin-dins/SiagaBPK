<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Validasi Default
    |--------------------------------------------------------------------------
    */

    'required' => 'Kolom :attribute wajib diisi.',
    'required_without' => 'Kolom :attribute wajib diisi jika Anda tidak sedang login.',
    'string' => 'Kolom :attribute harus berupa teks.',
    'max' => [
        'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
        'file' => 'Ukuran :attribute tidak boleh lebih besar dari :max kilobyte (KB).',
    ],
    'min' => [
        'numeric' => 'Nilai :attribute minimal harus :min.',
    ],
    'integer' => 'Kolom :attribute harus berupa angka.',
    'date' => 'Kolom :attribute bukan format tanggal/waktu yang valid.',
    'in' => 'Pilihan pada :attribute tidak valid.',
    'exists' => 'Pilihan :attribute tidak ditemukan dalam sistem.',
    'image' => 'Kolom :attribute harus berupa file gambar.',
    'mimes' => 'Kolom :attribute harus berupa file dengan format: :values.',
    'unique' => ':attribute ini sudah digunakan, silakan gunakan yang lain.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',

    /*
    |--------------------------------------------------------------------------
    | Atribut Kustom (Mengubah Nama Kolom Database Jadi Bahasa Manusia)
    |--------------------------------------------------------------------------
    |
    | Di sini kita mengubah nama field seperti 'lokasi' menjadi 'Lokasi Kejadian'
    | sehingga error yang keluar adalah "Kolom Lokasi Kejadian wajib diisi."
    | bukan "Kolom lokasi wajib diisi."
    |
    */

    'attributes' => [
        // Untuk Modul Insiden
        'nama_pelapor' => 'Nama Pelapor',
        'kontak_pelapor' => 'Nomor HP Pelapor',
        'lokasi' => 'Lokasi Kejadian',
        'waktu_kejadian' => 'Waktu Kejadian',
        'jenis_insiden' => 'Jenis Insiden',
        'jumlah_korban' => 'Jumlah Korban',
        'kerugian' => 'Estimasi Kerugian',
        'catatan' => 'Catatan Tambahan',
        'status' => 'Status Laporan',
        'petugas' => 'Petugas yang Ditugaskan',
        'foto' => 'Foto Dokumentasi',

        // Untuk Modul User (Sebagai persiapan nanti)
        'name' => 'Nama Lengkap',
        'email' => 'Alamat Email',
        'password' => 'Kata Sandi',
        'role' => 'Role Akses',
        'jenis_kelamin' => 'Jenis Kelamin',
        'no_hp' => 'Nomor Handphone',
    ],

];
