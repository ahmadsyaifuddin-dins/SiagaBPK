<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInsidenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lokasi' => 'required|string|max:255',
            'waktu_kejadian' => 'required|date',
            'status' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'catatan' => 'nullable|string',
            'nama_pelapor' => 'nullable|string',
            'kontak_pelapor' => 'nullable|string',
            'jenis_insiden' => 'required|string',
            'jumlah_korban' => 'nullable|integer|min:0',
            'kerugian' => 'nullable|string',

            // Lingkup wilayah Kota Banjarmasin
            'kecamatan' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',

            // Detail korban (jiwa)
            'korban_meninggal' => 'nullable|integer|min:0',
            'korban_luka_berat' => 'nullable|integer|min:0',
            'korban_luka_ringan' => 'nullable|integer|min:0',
            'korban_jiwa_terdampak' => 'nullable|integer|min:0',
            'korban_mengungsi_kk' => 'nullable|integer|min:0',
            'korban_mengungsi_jiwa' => 'nullable|integer|min:0',

            // Detail kerugian / kerusakan
            'rumah_terbakar' => 'nullable|integer|min:0',
            'rumah_rusak' => 'nullable|integer|min:0',
            'bangunan_lain_terdampak' => 'nullable|integer|min:0',
            'kendaraan_terbakar' => 'nullable|integer|min:0',
            'luas_area_dampak' => 'nullable|numeric|min:0|max:999999999.99',
            'kerugian_material' => 'nullable|numeric|min:0',
            'petugas' => 'nullable|array',
            'petugas.*' => 'exists:users,id',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
        ];
    }
}
