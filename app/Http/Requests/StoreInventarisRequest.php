<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Akses sudah dibatasi oleh Middleware di web.php
    }

    public function rules(): array
    {
        return [
            'kode_barang' => 'required|string|max:50|unique:inventaris,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|in:Armada,Peralatan,Perlengkapan,Lainnya',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ];
    }
}
