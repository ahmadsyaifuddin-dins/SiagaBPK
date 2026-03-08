<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Insiden</title>
    <style>
        /* Reset CSS standar untuk PDF */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
        }

        .title {
            text-align: center;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Styling Tabel Data */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.data-table th,
        table.data-table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        table.data-table th {
            background-color: #e5e7eb;
            text-align: center;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .m-0 {
            margin: 0;
        }

        .pl-3 {
            padding-left: 15px;
        }
    </style>
</head>

<body>

    @include('pdf.header')

    <div class="title">
        LAPORAN REKAPITULASI INSIDEN KEBAKARAN
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Waktu Kejadian</th>
                <th style="width: 25%;">Lokasi</th>
                <th style="width: 15%;">Jenis Insiden</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 20%;">Petugas Terlibat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $insiden)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->translatedFormat('l, d F Y') }}<br>
                        Pukul: {{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->format('H:i') }} WITA
                    </td>
                    <td>{{ $insiden->lokasi }}</td>
                    <td class="text-center">{{ $insiden->jenis_insiden ?? '-' }}</td>
                    <td class="text-center">{{ $insiden->status }}</td>
                    <td>
                        @if ($insiden->petugas->count() > 0)
                            <ul class="m-0 pl-3">
                                @foreach ($insiden->petugas as $p)
                                    <li>{{ $p->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span style="color: #666;">Tidak ada data</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data insiden yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @include('pdf.signature')

</body>

</html>
