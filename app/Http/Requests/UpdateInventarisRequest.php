<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventarisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Ambil ID dari URL parameter (karena parameter default laravel resource = inventari)
        $id = $this->route('inventari')->id ?? $this->route('inventari');

        return [
            'kode_barang' => 'required|string|max:50|unique:inventaris,kode_barang,'.$id,
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|in:Armada,Peralatan,Perlengkapan,Lainnya',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ];
    }
}
