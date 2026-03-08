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
            'lokasi' => 'required|string',
            'waktu_kejadian' => 'required|date',
            'status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
            'nama_pelapor' => 'nullable|string',
            'kontak_pelapor' => 'nullable|string',
            'jenis_insiden' => 'nullable|string',
            'jumlah_korban' => 'nullable|integer',
            'kerugian' => 'nullable|string',
            'petugas' => 'nullable|array',
            'petugas.*' => 'exists:users,id',
        ];
    }
}
