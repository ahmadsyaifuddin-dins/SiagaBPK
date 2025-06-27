<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insiden extends Model
{
    protected $fillable = [
        'lokasi', 'waktu_kejadian', 'status', 'foto', 'catatan',
        'dilaporkan_oleh', 'nama_pelapor', 'kontak_pelapor',
        'jenis_insiden', 'jumlah_korban', 'kerugian'
    ];
    
    protected $casts = [
        'waktu_kejadian' => 'datetime',
    ];
    
    public function pelapor()
    {
        return $this->belongsTo(User::class, 'dilaporkan_oleh');
    }

    public function petugas()
    {
        return $this->belongsToMany(User::class, 'insiden_user');
    }
}
