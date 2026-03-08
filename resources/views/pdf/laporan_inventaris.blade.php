@extends('pdf.layout')

@section('title', 'Laporan Data Aset & Armada')

@section('content')
    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="margin: 0; text-decoration: underline; text-transform: uppercase;">LAPORAN DATA ASET & INVENTARIS ARMADA
        </h3>
        <p style="margin: 5px 0 0 0; font-size: 11px;">Status Kelayakan & Ketersediaan | Dicetak pada:
            {{ now()->translatedFormat('l, d F Y H:i') }}</p>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Kode Barang</th>
                <th style="width: 30%;">Nama Barang / Armada</th>
                <th style="width: 15%;">Kategori</th>
                <th style="width: 10%;">Jumlah</th>
                <th style="width: 20%;">Kondisi Fisik</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventaris as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td style="font-family: monospace; font-size: 10px;">{{ $item->kode_barang }}</td>
                    <td><strong>{{ $item->nama_barang }}</strong></td>
                    <td class="text-center">{{ $item->kategori }}</td>
                    <td class="text-center"><strong>{{ $item->jumlah }}</strong> Unit</td>
                    <td class="text-center">
                        @php
                            $kondisiColor = match ($item->kondisi) {
                                'Baik' => '#15803d', // Hijau
                                'Rusak Ringan' => '#b45309', // Kuning/Oranye kecoklatan agar terbaca di kertas putih
                                'Rusak Berat' => '#dc2626', // Merah
                                default => '#000',
                            };
                        @endphp
                        <span style="color: {{ $kondisiColor }}; font-weight: bold;">
                            {{ $item->kondisi }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px;">Belum ada data aset atau armada yang
                        tercatat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px; font-size: 11px;">
        <p style="margin: 2px 0;"><strong>Total Item Berbeda:</strong> {{ $inventaris->count() }} Macam Aset</p>
        <p style="margin: 2px 0;"><strong>Aset Kondisi Baik:</strong> <span
                style="color: #15803d; font-weight:bold;">{{ $inventaris->where('kondisi', 'Baik')->sum('jumlah') }} Unit
                Keseluruhan</span></p>
        <p style="margin: 2px 0;"><strong>Aset Perlu Perbaikan (Rusak):</strong> <span
                style="color: #dc2626; font-weight:bold;">{{ $inventaris->whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])->sum('jumlah') }}
                Unit Keseluruhan</span></p>
    </div>
@endsection
