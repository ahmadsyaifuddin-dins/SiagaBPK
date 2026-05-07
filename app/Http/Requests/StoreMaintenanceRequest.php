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
            'status' => 'required|in:Terjadwal,Proses,Selesai,Batal',
            // Biaya tidak lagi required, karena jadwal servis belum tentu ada biaya
            'biaya' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
            'nota_servis' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ];
    }
}
