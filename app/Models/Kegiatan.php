<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_kegiatan',
        'tanggal_kegiatan',
        'lokasi',
        'deskripsi',
        'foto',
        'status',
    ];

    // Opsional: Casting tanggal agar otomatis menjadi objek Carbon saat dipanggil di Blade
    protected $casts = [
        'tanggal_kegiatan' => 'datetime',
    ];
}
