@extends('pdf.layout')

@section('title', 'Laporan Jadwal Siaga')

@section('content')
    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="margin: 0; text-decoration: underline; text-transform: uppercase;">DAFTAR JADWAL PIKET & SIAGA ANGGOTA
        </h3>
        <p style="margin: 5px 0 0 0; font-size: 11px;">Dicetak pada: {{ now()->translatedFormat('l, d F Y H:i') }}</p>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Tanggal / Hari</th>
                <th style="width: 30%;">Nama Petugas</th>
                <th style="width: 20%;">Kontak (No. HP)</th>
                <th style="width: 20%;">Status Kesiapan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwals as $index => $jadwal)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}</strong>
                    </td>
                    <td>
                        {{ $jadwal->user->name ?? 'NN' }}
                        @if ($jadwal->user && $jadwal->user->jabatan)
                            <br><span style="font-size: 9px; color: #4b5563;">({{ $jadwal->user->jabatan }})</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $jadwal->user->no_hp ?? '-' }}</td>
                    <td class="text-center">
                        @php
                            $color = match ($jadwal->status) {
                                'Siaga' => '#15803d', // Hijau
                                'Tugas' => '#b91c1c', // Merah
                                'Istirahat' => '#d97706', // Oranye
                                default => '#000',
                            };
                        @endphp
                        <span style="color: {{ $color }}; font-weight: bold;">
                            {{ strtoupper($jadwal->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">Belum ada jadwal piket yang ditambahkan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px; font-size: 11px; font-style: italic;">
        * Jadwal di atas dapat berubah sewaktu-waktu sesuai dengan instruksi Komandan Regu. Anggota yang berstatus
        <strong>SIAGA</strong> wajib stand-by di Mako atau dapat dihubungi kapan saja.
    </div>
@endsection
