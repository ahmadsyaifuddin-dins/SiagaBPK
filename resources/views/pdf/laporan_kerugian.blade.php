@extends('pdf.layout')

@section('title', 'Laporan Statistik Kerugian')

@section('content')
    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="margin: 0; text-decoration: underline; text-transform: uppercase;">LAPORAN STATISTIK KERUGIAN MATERIAL &
            KORBAN</h3>
        <p style="margin: 5px 0 0 0; font-size: 11px;">Periode: Semua Data | Dicetak pada:
            {{ now()->translatedFormat('l, d F Y H:i') }}</p>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tgl Kejadian</th>
                <th style="width: 25%;">Lokasi</th>
                <th style="width: 20%;">Jenis Kejadian</th>
                <th style="width: 10%;">Jml Korban</th>
                <th style="width: 25%;">Taksiran Kerugian</th>
            </tr>
        </thead>
        <tbody>
            @forelse($insidens as $index => $insiden)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->translatedFormat('d M Y') }}</td>
                    <td>{{ $insiden->lokasi }}</td>
                    <td>{{ $insiden->jenis_insiden ?? '-' }}</td>
                    <td class="text-center">{{ $insiden->jumlah_korban ?? 0 }} Jiwa</td>
                    <td class="text-right">{{ $insiden->kerugian ?: 'Rp 0' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px;">Belum ada data kejadian untuk dihitung.
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr style="background-color: #fca5a5;">
                <td colspan="4" class="text-right font-bold" style="padding: 10px;">GRAND TOTAL KESELURUHAN:</td>
                <td class="text-center font-bold">{{ $totalKorban }} Jiwa</td>
                <td class="text-right font-bold" style="font-size: 14px;">
                    Rp {{ number_format($totalKerugian, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>
@endsection
