<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Struk Pembayaran #{{ $transaksi->id_parkir }}</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Courier New", Courier, monospace;
            width: 300px;
            margin: 0 auto;
            padding: 12px;
            font-size: 13px;
            color: #000;
            background: #fff;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .line {
            border-bottom: 1px dashed #000;
            margin: 10px 0;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin: 0;
            letter-spacing: 1px;
        }

        .subtitle {
            margin: 3px 0 0;
            font-size: 12px;
        }

        .ticket-number {
            font-size: 18px;
            font-weight: bold;
            margin: 8px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 3px 0;
            vertical-align: top;
        }

        td:first-child {
            width: 42%;
        }

        .total-box {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 10px;
        }

        .total-label {
            font-size: 13px;
            font-weight: bold;
        }

        .total-price {
            font-size: 20px;
            font-weight: bold;
        }

        .thank-you {
            margin-top: 12px;
            text-align: center;
        }

        .btn-print {
            display: block;
            width: 100%;
            padding: 9px;
            background: #0d6efd;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 15px;
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        .btn-back {
            display: block;
            width: 100%;
            padding: 9px;
            background: #6c757d;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 7px;
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        .no-print {
            margin-top: 15px;
        }

        @media print {

            body {
                width: 300px;
                margin: 0;
                padding: 8px;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <!-- HEADER -->
    <div class="text-center">

        <h1 class="title">EZPARK</h1>

        <p class="subtitle">
            STRUK PEMBAYARAN PARKIR
        </p>

        <p class="ticket-number">
            #{{ $transaksi->id_parkir }}
        </p>

    </div>

    <div class="line"></div>

    <!-- INFORMASI KENDARAAN -->
    <table>

        <tr>
            <td>Member</td>
            <td>
                : {{ $transaksi->member?->nama ?? 'Non-Member' }}
            </td>
        </tr>

        @if($transaksi->member)

            <tr>
                <td>Kode Member</td>
                <td>
                    : {{ $transaksi->member->kode_member }}
                </td>
            </tr>

        @endif

        <tr>
            <td>Plat Nomor</td>
            <td>
                : {{ $transaksi->plat_nomor ?? '-' }}
            </td>
        </tr>

        @if($transaksi->member)

            <tr>
                <td>Kendaraan</td>
                <td>
                    : {{ ucfirst($transaksi->member->jenis_kendaraan) }}
                </td>
            </tr>

        @endif

        <tr>
            <td>Area</td>
            <td>
                : {{ $transaksi->area?->nama_area ?? '-' }}
            </td>
        </tr>

    </table>

    <div class="line"></div>

    <!-- DETAIL PARKIR -->
    <table>

        <tr>
            <td>Waktu Masuk</td>
            <td>
                : {{ $transaksi->waktu_masuk }}
            </td>
        </tr>

        <tr>
            <td>Waktu Keluar</td>
            <td>
                : {{ $transaksi->waktu_keluar ?? '-' }}
            </td>
        </tr>

        <tr>
            <td>Durasi</td>
            <td>
                : {{ $transaksi->durasi_jam }} Jam
            </td>
        </tr>

        <tr>
            <td>Tarif / Jam</td>
            <td>
                :
                Rp
                {{ number_format(
                    $transaksi->durasi_jam > 0
                        ? ($transaksi->biaya_total / $transaksi->durasi_jam)
                        : 0,
                    0,
                    ',',
                    '.'
                ) }}
            </td>
        </tr>

    </table>

    <div class="line"></div>

    <!-- TOTAL -->
    <div class="total-box">

        <table>

            <tr>
                <td class="total-label">
                    TOTAL BAYAR
                </td>

                <td class="text-right total-price">
                    Rp
                    {{ number_format(
                        $transaksi->biaya_total ?? 0,
                        0,
                        ',',
                        '.'
                    ) }}
                </td>
            </tr>

        </table>

    </div>

    <!-- UCAPAN -->
    <div class="thank-you">

        <p style="margin: 0;">
            Terima Kasih
        </p>

        <p style="margin: 4px 0 0;">
            Selamat Sampai Tujuan
        </p>

    </div>

    <!-- BUTTON -->
    <div class="no-print">

        <a
            href="javascript:window.print()"
            class="btn-print">
            Cetak Struk
        </a>

        <a
            href="{{ route('petugas.transaksi.index') }}"
            class="btn-back">
            Kembali ke Transaksi
        </a>

    </div>

</body>
</html>