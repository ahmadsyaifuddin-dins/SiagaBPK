<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insiden extends Model
{
    protected $fillable = [
        'lokasi',
        'waktu_kejadian',
        'status',
        'foto',
        'catatan',
    ];
    
    protected $casts = [
        'waktu_kejadian' => 'datetime',
    ];
}
