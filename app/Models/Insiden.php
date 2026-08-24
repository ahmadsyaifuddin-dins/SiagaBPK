<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insiden extends Model
{
    // Daftar kecamatan Kota Banjarmasin (ruang lingkup monitoring)
    public const KECAMATAN_BANJARMASIN = [
        'Banjarmasin Barat',
        'Banjarmasin Selatan',
        'Banjarmasin Tengah',
        'Banjarmasin Timur',
        'Banjarmasin Utara',
    ];

    protected $fillable = [
        'lokasi', 'waktu_kejadian', 'status', 'foto', 'catatan',
        'dilaporkan_oleh', 'nama_pelapor', 'kontak_pelapor',
        'jenis_insiden', 'jumlah_korban', 'kerugian',
        'latitude', 'longitude',
        'kecamatan', 'kelurahan',
        'korban_meninggal', 'korban_luka_berat', 'korban_luka_ringan',
        'korban_jiwa_terdampak', 'korban_mengungsi_kk', 'korban_mengungsi_jiwa',
        'rumah_terbakar', 'rumah_rusak', 'bangunan_lain_terdampak',
        'kendaraan_terbakar', 'luas_area_dampak', 'kerugian_material',
    ];

    protected $casts = [
        'waktu_kejadian' => 'datetime',
        'korban_meninggal' => 'integer',
        'korban_luka_berat' => 'integer',
        'korban_luka_ringan' => 'integer',
        'korban_jiwa_terdampak' => 'integer',
        'korban_mengungsi_kk' => 'integer',
        'korban_mengungsi_jiwa' => 'integer',
        'rumah_terbakar' => 'integer',
        'rumah_rusak' => 'integer',
        'bangunan_lain_terdampak' => 'integer',
        'kendaraan_terbakar' => 'integer',
        'luas_area_dampak' => 'float',
        'kerugian_material' => 'integer',
    ];

    public function pelapor()
    {
        return $this->belongsTo(User::class, 'dilaporkan_oleh');
    }

    public function petugas()
    {
        return $this->belongsToMany(User::class, 'insiden_user');
    }

    /**
     * Total korban jiwa (meninggal + luka berat + luka ringan),
     * dengan fallback ke kolom legacy jumlah_korban bila detail belum diisi.
     */
    public function getTotalKorbanJiwaAttribute(): int
    {
        $totalDetail = $this->korban_meninggal + $this->korban_luka_berat + $this->korban_luka_ringan;

        return max($totalDetail, (int) ($this->jumlah_korban ?? 0));
    }

    /**
     * Format taksiran kerugian material menjadi Rupiah.
     */
    public function getKerugianMaterialFormatAttribute(): string
    {
        if ((int) $this->kerugian_material > 0) {
            return 'Rp '.number_format($this->kerugian_material, 0, ',', '.');
        }

        return '-';
    }
}
