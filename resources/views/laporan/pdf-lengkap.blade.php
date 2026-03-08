<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Lengkap Insiden</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #e3342f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 6px 10px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f87171;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #fdf2f2;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 10px;
            background-color: #facc15;
            color: #000;
            border-radius: 3px;
            font-weight: bold;
        }
    </style>

</head>

<body>
    <h1>Laporan Lengkap Insiden</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Waktu</th>
                <th>Lokasi</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Jumlah Korban</th>
                <th>Kerugian</th>
                <th>Pelapor</th>
                <th>Kontak</th>
                <th>Dilaporkan Oleh</th>
                <th>Petugas Bertugas</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $insiden)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->format('d/m/Y H:i') }}</td>
                <td>{{ $insiden->lokasi }}</td>
                <td>{{ $insiden->jenis_insiden ?? '-' }}</td>
                <td>
                    <span class="badge">{{ $insiden->status }}</span>
                </td>
                <td>{{ $insiden->jumlah_korban ?? 0 }}</td>
                <td>{{ $insiden->kerugian ?? '-' }}</td>
                <td>{{ $insiden->nama_pelapor ?? '-' }}</td>
                <td>{{ $insiden->kontak_pelapor ?? '-' }}</td>
                <td>{{ $insiden->pelapor->name ?? '-' }}</td>
                <td>
                    @foreach($insiden->petugas as $petugas)
                    {{ $petugas->name }}{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </td>
                <td>{{ $insiden->catatan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>