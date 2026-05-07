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
        'stok_minimum',
        'kondisi',
        'tanggal_kadaluarsa',
        'qr_code',
        'keterangan',
        'foto',
    ];

    protected $casts = [
        'tanggal_kadaluarsa' => 'date',
    ];

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'inventaris_id')->orderBy('tanggal_servis', 'desc');
    }
}
