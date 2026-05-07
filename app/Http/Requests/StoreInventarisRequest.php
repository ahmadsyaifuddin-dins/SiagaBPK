<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_barang' => 'required|string|max:50|unique:inventaris,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|in:Armada,Peralatan,Perlengkapan,Lainnya',
            'jumlah' => 'required|integer|min:0',
            'stok_minimum' => 'nullable|integer|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'tanggal_kadaluarsa' => 'nullable|date',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ];
    }
}
