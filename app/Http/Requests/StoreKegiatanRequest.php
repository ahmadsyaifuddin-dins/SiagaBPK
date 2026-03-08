<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKegiatanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Maks 5MB
            'status' => 'required|in:Akan Datang,Selesai,Batal',
        ];
    }
}
