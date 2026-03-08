<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Mengambil ID user yang sedang diupdate dari parameter route
        $userId = $this->route('user')->id;

        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,'.$userId,
            'password' => 'nullable|string|min:8', // Nullable karena password tidak wajib diubah
            'role' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp' => 'required|numeric',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'jabatan' => 'nullable|in:Komandan,Petugas Lapangan,Danton,Wakil Komandan,Petugas Senior,Petugas Junior,Anggota Regu,Petugas Medis,Petugas Teknis',
            'golongan_darah' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'status_aktif' => 'required|boolean',
        ];
    }
}
