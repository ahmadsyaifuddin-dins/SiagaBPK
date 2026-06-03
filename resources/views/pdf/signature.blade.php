<table style="width: 100%; margin-top: 50px; font-family: sans-serif;">
    <tr>
        <td style="width: 60%;"></td>

        <td style="width: 40%; text-align: center; font-size: 12px;">
            <p style="margin: 0;">Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 0;">Mengetahui,</p>
            <p style="margin: 0; font-weight: bold;">Kepala Regu SiagaBPK KTC FIRE Banjarmasin</p>

            <div style="margin: 10px 0; text-align: center;">
                <img src="{{ public_path('ttd/ttd.png') }}" style="height: 65px; width: auto; display: inline-block;"
                    alt="Tanda Tangan H. Eza">
            </div>

            <p style="margin: 0; font-weight: bold; text-decoration: underline;">H. Eza</p>
            <p style="margin: 0;">ID: {{ $kepalaReguId ?? 'KTC-001' }}</p>
        </td>
    </tr>
</table>
