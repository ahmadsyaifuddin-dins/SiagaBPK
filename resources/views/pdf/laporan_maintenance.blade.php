@extends('pdf.layout')

@section('title', 'Laporan Biaya Pemeliharaan Aset')

@section('content')
    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="margin: 0; text-decoration: underline; text-transform: uppercase;">LAPORAN BIAYA PEMELIHARAAN & SERVIS
            ARMADA</h3>
        <p style="margin: 5px 0 0 0; font-size: 11px;">Rekapitulasi Pengeluaran Bengkel | Dicetak pada:
            {{ now()->translatedFormat('l, d F Y H:i') }}</p>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal Servis</th>
                <th style="width: 25%;">Nama Aset / Armada</th>
                <th style="width: 30%;">Jenis Perbaikan / Servis</th>
                <th style="width: 25%;">Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($maintenances as $index => $main)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($main->tanggal_servis)->translatedFormat('d M Y') }}
                    </td>
                    <td>
                        <strong>{{ $main->inventaris->nama_barang ?? 'Aset Dihapus' }}</strong>
                        <br><span style="font-size: 9px; color: #4b5563;">{{ $main->inventaris->kode_barang ?? '-' }}</span>
                    </td>
                    <td>
                        {{ $main->jenis_servis }}
                        @if ($main->keterangan)
                            <br><span style="font-size: 9px; font-style: italic; color: #6b7280;">Ket:
                                {{ $main->keterangan }}</span>
                        @endif
                    </td>
                    <td class="text-right font-bold" style="color: #047857;">
                        Rp {{ number_format($main->biaya, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">Belum ada catatan biaya pemeliharaan atau
                        servis.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr style="background-color: #d1fae5;">
                <td colspan="4" class="text-right font-bold" style="padding: 10px; color: #065f46;">GRAND TOTAL
                    PENGELUARAN SERVIS:</td>
                <td class="text-right font-bold" style="font-size: 14px; color: #065f46;">
                    Rp {{ number_format($totalBiaya, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>
@endsection
