<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Cetak Rekap Laporan Parkir
    </title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #000;
            background: #fff;
        }

        .actions {
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            margin-right: 5px;

            border: 1px solid #000;

            background: #fff;

            color: #000;

            text-decoration: none;

            cursor: pointer;

            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0 0 5px 0;
            font-size: 30px;
        }

        .header h2 {
            margin: 0 0 8px 0;
            font-size: 22px;
        }

        .header p {
            margin: 3px 0;
            font-size: 14px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info table {
            width: auto;
            border-collapse: collapse;
        }

        .info td {
            padding: 4px 20px 4px 0;
            font-size: 14px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 13px;
        }

        table.data th {
            background: #eee;
            font-weight: bold;
            text-align: left;
        }

        table.data td {
            vertical-align: middle;
        }

        .summary {
            margin-top: 25px;
        }

        .summary table {
            border-collapse: collapse;
        }

        .summary td {
            padding: 5px 30px 5px 0;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 15px;
        }

        @media print {

            body {
                margin: 15mm;
            }

            .actions {
                display: none;
            }

            table.data {
                page-break-inside: auto;
            }

            table.data tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

        }

    </style>

</head>


<body>


    {{-- Tombol Aksi --}}
    <div class="actions">

        <button
            class="btn"
            onclick="window.print()"
        >
            Cetak Laporan
        </button>

        <a
            href="{{ route('owner.rekap') }}"
            class="btn"
        >
            Kembali
        </a>

    </div>


    {{-- Header Laporan --}}
    <div class="header">

        <h1>
            EZPark
        </h1>

        <h2>
            REKAP LAPORAN PARKIR
        </h2>

        <p>
            Sistem Informasi Manajemen Parkir Mandiri
        </p>

    </div>


    {{-- Informasi Periode --}}
    <div class="info">

        <table>

            <tr>

                <td>
                    Periode
                </td>

                <td>
                    :

                    @if ($tanggalMulai && $tanggalSelesai)

                        {{ date(
                            'd-m-Y',
                            strtotime($tanggalMulai)
                        ) }}

                        @if ($tanggalMulai !== $tanggalSelesai)

                            s/d

                            {{ date(
                                'd-m-Y',
                                strtotime($tanggalSelesai)
                            ) }}

                        @endif

                    @elseif ($tanggalMulai)

                        {{ date(
                            'd-m-Y',
                            strtotime($tanggalMulai)
                        ) }}

                    @elseif ($tanggalSelesai)

                        s/d

                        {{ date(
                            'd-m-Y',
                            strtotime($tanggalSelesai)
                        ) }}

                    @else

                        Semua Periode

                    @endif

                </td>

            </tr>

        </table>

    </div>


    {{-- Tabel Data Transaksi --}}
    <table class="data">

        <thead>

            <tr>

                <th width="50">
                    No
                </th>

                <th>
                    Plat Nomor
                </th>

                <th>
                    Jenis Kendaraan
                </th>

                <th>
                    Area
                </th>

                <th>
                    Waktu Masuk
                </th>

                <th>
                    Waktu Keluar
                </th>

                <th>
                    Durasi
                </th>

                <th>
                    Biaya
                </th>

            </tr>

        </thead>


        <tbody>

            <?php $no = 1; ?>

            @forelse ($transaksi as $item)

                <tr>

                    {{-- Nomor --}}
                    <td>
                        {{ $no++ }}
                    </td>


                    {{-- Plat Nomor --}}
                    <td>
                        {{ $item->plat_nomor ?? '-' }}
                    </td>


                    {{-- Jenis Kendaraan --}}
                    <td>
                        {{ $item->tarif->jenis_kendaraan ?? '-' }}
                    </td>


                    {{-- Area --}}
                    <td>
                        {{ $item->area->nama_area ?? '-' }}
                    </td>


                    {{-- Waktu Masuk --}}
                    <td>
                        {{ $item->waktu_masuk ?? '-' }}
                    </td>


                    {{-- Waktu Keluar --}}
                    <td>
                        {{ $item->waktu_keluar ?? '-' }}
                    </td>


                    {{-- Durasi --}}
                    <td>
                        {{ $item->durasi_jam ?? 0 }} jam
                    </td>


                    {{-- Biaya --}}
                    <td>
                        Rp
                        {{ number_format(
                            $item->biaya_total ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="8"
                        class="empty"
                    >
                        Tidak ada transaksi
                        pada periode yang dipilih.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- Ringkasan --}}
    <div class="summary">

        <table>

            <tr>

                <td>
                    Total Transaksi
                </td>

                <td>
                    : {{ $totalTransaksi }}
                </td>

            </tr>

            <tr>

                <td>
                    Total Pendapatan
                </td>

                <td>
                    : Rp
                    {{ number_format(
                        $totalPendapatan,
                        0,
                        ',',
                        '.'
                    ) }}
                </td>

            </tr>

        </table>

    </div>


</body>

</html>