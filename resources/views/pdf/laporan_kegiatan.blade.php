@extends('pdf.layout')

@section('title', 'Laporan Kegiatan Operasional')

@section('content')
    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="margin: 0; text-decoration: underline; text-transform: uppercase;">LAPORAN DOKUMENTASI KEGIATAN &
            OPERASIONAL</h3>
        <p style="margin: 5px 0 0 0; font-size: 11px;">Sosialisasi, Latihan Gabungan, dan Giat Rutin | Dicetak pada:
            {{ now()->translatedFormat('l, d F Y H:i') }}</p>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Waktu Pelaksanaan</th>
                <th style="width: 25%;">Nama Kegiatan</th>
                <th style="width: 20%;">Lokasi</th>
                <th style="width: 25%;">Deskripsi Singkat</th>
                <th style="width: 10%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatans as $index => $kegiatan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y H:i') }}</td>
                    <td><strong>{{ $kegiatan->judul_kegiatan }}</strong></td>
                    <td>{{ $kegiatan->lokasi }}</td>
                    <td style="font-size: 10px;">{{ \Illuminate\Support\Str::limit($kegiatan->deskripsi, 80) }}</td>
                    <td class="text-center">
                        @php
                            $statusColor = match ($kegiatan->status) {
                                'Selesai' => '#15803d', // Hijau
                                'Akan Datang' => '#2563eb', // Biru
                                'Batal' => '#dc2626', // Merah
                                default => '#000',
                            };
                        @endphp
                        <span style="color: {{ $statusColor }}; font-weight: bold;">
                            {{ $kegiatan->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px;">Belum ada dokumentasi kegiatan yang
                        tercatat di sistem.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
