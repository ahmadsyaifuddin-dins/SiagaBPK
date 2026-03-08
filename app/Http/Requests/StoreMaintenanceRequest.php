<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaintenanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'inventaris_id' => 'required|exists:inventaris,id',
            'tanggal_servis' => 'required|date',
            'jenis_servis' => 'required|string|max:255',
            'biaya' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
            'nota_servis' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ];
    }
}
