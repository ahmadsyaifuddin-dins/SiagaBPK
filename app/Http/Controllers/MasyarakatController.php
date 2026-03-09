<?php

namespace App\Http\Controllers;

use App\Models\User;

class MasyarakatController extends Controller
{
    /**
     * Menampilkan daftar pengguna dengan role 'masyarakat'.
     */
    public function index()
    {
        // Hanya ambil user dengan role masyarakat, urutkan dari yang terbaru mendaftar
        $masyarakat = User::where('role', 'masyarakat')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('masyarakat.index', compact('masyarakat'));
    }

    /**
     * Menghapus akun masyarakat (jika spam/fiktif).
     */
    public function destroy(User $masyarakat)
    {
        // Keamanan ekstra: Pastikan yang dihapus benar-benar role masyarakat
        if ($masyarakat->role !== 'masyarakat') {
            return back()->with('error', 'Hanya dapat menghapus data masyarakat melalui menu ini.');
        }

        $masyarakat->delete();

        return back()->with('success', 'Akun masyarakat berhasil dihapus dari sistem.');
    }
}
