<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Insiden</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Insiden Kebakaran - SiagaBPK</h2>
    <p>Tanggal Cetak: {{ now()->format('d M Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Lokasi</th>
                <th>Waktu Kejadian</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $insiden)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $insiden->lokasi }}</td>
                <td>{{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->format('d M Y H:i') }}</td>
                <td>{{ $insiden->status }}</td>
                <td>{{ $insiden->catatan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
