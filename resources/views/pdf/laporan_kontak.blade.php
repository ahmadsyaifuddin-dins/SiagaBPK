@extends('pdf.layout')

@section('title', 'Buku Kontak Anggota BPK')

@section('content')
    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="margin: 0; text-decoration: underline; text-transform: uppercase;">BUKU KONTAK & DATA MEDIS ANGGOTA AKTIF
        </h3>
        <p style="margin: 5px 0 0 0; font-size: 11px;">Nomor Darurat & Golongan Darah | Dicetak pada:
            {{ now()->translatedFormat('l, d F Y H:i') }}</p>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Lengkap</th>
                <th style="width: 15%;">Jabatan</th>
                <th style="width: 20%;">No. HP / WA</th>
                <th style="width: 10%;">Gol. Darah</th>
                <th style="width: 25%;">Alamat Domisili</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anggotas as $index => $anggota)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $anggota->name }}</strong>
                        @if ($anggota->role === 'admin')
                            <br><span style="font-size: 9px; color: #dc2626; font-weight: bold;">(Admin)</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $anggota->jabatan ?? '-' }}</td>
                    <td class="text-center font-bold">{{ $anggota->no_hp }}</td>
                    <td class="text-center">
                        @if ($anggota->golongan_darah)
                            <span
                                style="color: #dc2626; font-weight: bold; font-size: 14px;">{{ $anggota->golongan_darah }}</span>
                        @else
                            -
                        @endif
                    </td>
                    <td style="font-size: 10px;">{{ $anggota->alamat ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px;">Belum ada data anggota yang aktif.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px; font-size: 11px;">
        <p style="margin: 2px 0;"><strong>Total Personel Aktif:</strong> {{ $anggotas->count() }} Orang</p>
        <p style="margin: 2px 0; font-style: italic; color: #4b5563;">* Dokumen ini bersifat <strong>RAHASIA /
                INTERNAL</strong> dan hanya digunakan untuk keperluan koordinasi atau kondisi darurat medis antar anggota
            BPK.</p>
    </div>
@endsection
