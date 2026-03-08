@extends('pdf.layout')

@section('title', 'Laporan Kinerja Anggota')

@section('content')
    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="margin: 0; text-decoration: underline; text-transform: uppercase;">LAPORAN KINERJA & KEAKTIFAN ANGGOTA
        </h3>
        <p style="margin: 5px 0 0 0; font-size: 11px;">Berdasarkan Frekuensi Turun ke Lapangan | Dicetak pada:
            {{ now()->translatedFormat('l, d F Y H:i') }}</p>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Nama Anggota</th>
                <th style="width: 20%;">Jabatan</th>
                <th style="width: 20%;">No. HP / Kontak</th>
                <th style="width: 15%;">Total Turun</th>
                <th style="width: 10%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($relawans as $index => $relawan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $relawan->name }}</strong>
                        @if ($relawan->role === 'admin')
                            <br><span style="font-size: 9px; color: #dc2626;">(Admin)</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $relawan->jabatan ?? '-' }}</td>
                    <td class="text-center">{{ $relawan->no_hp }}</td>
                    <td class="text-center">
                        @if ($index === 0 && $relawan->insidens_count > 0)
                            <strong style="color: #059669; font-size: 14px;">{{ $relawan->insidens_count }} Kali</strong>
                            <br><span style="font-size: 9px;">(Paling Aktif)</span>
                        @else
                            <strong style="font-size: 12px;">{{ $relawan->insidens_count }} Kali</strong>
                        @endif
                    </td>
                    <td class="text-center">
                        <span style="color: {{ $relawan->status_aktif ? '#15803d' : '#dc2626' }}; font-weight: bold;">
                            {{ $relawan->status_aktif ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px;">Belum ada data relawan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
