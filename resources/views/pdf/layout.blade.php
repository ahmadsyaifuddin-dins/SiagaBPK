<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dokumen Laporan')</title>
    <style>
        /* CSS Reset Dasar untuk DomPDF */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #000;
        }

        /* CSS Khusus Tabel Konten Data Laporan */
        table.table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        table.table-data th,
        table.table-data td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }

        table.table-data th {
            background-color: #e5e7eb;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            font-size: 10px;
        }

        table.table-data td {
            font-size: 11px;
        }

        table.table-data tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        .font-bold {
            font-weight: bold !important;
        }
    </style>
</head>

<body>

    @include('pdf.header')

    <main>
        @yield('content')
    </main>

    @include('pdf.signature')

</body>

</html>
