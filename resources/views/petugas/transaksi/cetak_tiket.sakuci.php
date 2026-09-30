<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran Parkir #{{ $transaksi->id_parkir }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 280px;
            margin: 0 auto;
            padding: 10px;
            font-size: 12px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .line {
            border-bottom: 1px dashed #000;
            margin: 8px 0;
        }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 2px 0; }
        .btn-print {
            display: block;
            width: 100%;
            padding: 8px;
            background-color: #0d6efd;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 15px;
            font-family: sans-serif;
            font-size: 13px;
        }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="text-center">
        <h3 style="margin:0;">EZPARK</h3>
        <p style="margin:2px 0;">Struk Pembayaran Parkir</p>
    </div>

    <div class="line"></div>

    <table>
        <tr>
            <td>No. Tiket</td>
            <td>: #{{ $transaksi->id_parkir }}</td>
        </tr>
        <tr>
            <td>Status Member</td>
            <td>: {{ $transaksi->id_member ? 'Member' : 'Non-Member' }}</td>
        </tr>
        <tr>
            <td>Masuk</td>
            <td>: {{ $transaksi->waktu_masuk }}</td>
        </tr>
        <tr>
            <td>Keluar</td>
            <td>: {{ $transaksi->waktu_keluar }}</td>
        </tr>
        <tr>
            <td>Durasi</td>
            <td>: {{ $transaksi->durasi_jam }} Jam</td>
        </tr>
    </table>

    <div class="line"></div>

    <table>
        <tr style="font-weight: bold;">
            <td>TOTAL BIAYA</td>
            <td class="text-right">Rp {{ number_format($transaksi->biaya_total ?? 0, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="text-center" style="margin-top: 10px;">
        <p style="margin: 0;">Terima Kasih</p>
        <p style="margin: 2px 0;">Selamat Sampai Tujuan</p>
    </div>

    <div class="no-print">
        <a href="javascript:window.print()" class="btn-print">Cetak Struk</a>
    </div>

</body>
</html>