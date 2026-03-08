<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'jumlah',
        'kondisi',
        'keterangan',
        'foto',
    ];

    /**
     * Relasi One-to-Many: 1 Inventaris memiliki banyak Riwayat Servis (Maintenance)
     */
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'inventaris_id')->orderBy('tanggal_servis', 'desc');
    }
}
