<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventaris_id',
        'tanggal_servis',
        'jenis_servis',
        'biaya',
        'keterangan',
        'nota_servis',
    ];

    /**
     * Relasi BelongsTo: 1 Riwayat Servis ini milik 1 Inventaris
     */
    public function inventaris()
    {
        return $this->belongsTo(Inventaris::class, 'inventaris_id');
    }
}
