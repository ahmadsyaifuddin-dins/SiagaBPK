@extends('pdf.layout')

@section('title', 'Laporan Rekapitulasi Insiden')

@section('content')
    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="margin: 0; text-decoration: underline; text-transform: uppercase;">LAPORAN REKAPITULASI INSIDEN KEBAKARAN
        </h3>
        <p style="margin: 5px 0 0 0; font-size: 11px;">Dicetak pada: {{ now()->translatedFormat('l, d F Y H:i') }}</p>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Waktu Kejadian</th>
                <th style="width: 30%;">Lokasi Kejadian</th>
                <th style="width: 15%;">Jenis Insiden</th>
                <th style="width: 15%;">Pelapor</th>
                <th style="width: 15%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($insidens as $index => $insiden)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->translatedFormat('d M Y H:i') }}</td>
                    <td>{{ $insiden->lokasi }}</td>
                    <td>{{ $insiden->jenis_insiden ?? '-' }}</td>
                    <td>{{ $insiden->nama_pelapor ?? 'NN' }}</td>
                    <td class="text-center">
                        <span style="{{ $insiden->status === 'Selesai' ? 'font-weight: bold; color: #15803d;' : '' }}">
                            {{ $insiden->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px;">Belum ada data insiden yang tercatat dalam
                        sistem.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px; font-size: 11px;">
        <p style="margin: 2px 0;"><strong>Total Insiden Tercatat:</strong> {{ $insidens->count() }} Kejadian</p>
        <p style="margin: 2px 0;"><strong>Insiden Berhasil Selesai:</strong>
            {{ $insidens->where('status', 'Selesai')->count() }} Kejadian</p>
    </div>
@endsection
