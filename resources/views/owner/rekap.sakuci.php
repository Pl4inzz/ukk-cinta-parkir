@extends('layouts.app')

@section('title', 'Rekap Parkir')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Rekap Parkir
            </h1>

            <p class="text-muted mb-0">
                Laporan transaksi parkir yang telah selesai.
            </p>
        </div>

    </div>


    {{-- Filter Periode --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body p-4">

            <h2 class="h6 mb-3">
                Filter Periode
            </h2>

            <form
                method="GET"
                action="{{ route('owner.rekap') }}"
            >

                <div class="row g-3 align-items-end">

                    {{-- Tanggal Mulai --}}
                    <div class="col-md-5">

                        <label
                            for="tanggal_mulai"
                            class="form-label"
                        >
                            Tanggal Mulai
                        </label>

                        <input
                            type="date"
                            id="tanggal_mulai"
                            name="tanggal_mulai"
                            value="{{ $tanggalMulai ?? '' }}"
                            class="form-control"
                        >

                    </div>


                    {{-- Tanggal Selesai --}}
                    <div class="col-md-5">

                        <label
                            for="tanggal_selesai"
                            class="form-label"
                        >
                            Tanggal Selesai
                        </label>

                        <input
                            type="date"
                            id="tanggal_selesai"
                            name="tanggal_selesai"
                            value="{{ $tanggalSelesai ?? '' }}"
                            class="form-control"
                        >

                    </div>


                    {{-- Tombol --}}
                    <div class="col-md-2">

                        <button
                            type="submit"
                            class="btn btn-brand w-100 mb-2"
                        >
                            Filter
                        </button>

                        <a
                            href="{{ route('owner.rekap') }}"
                            class="btn btn-outline-secondary w-100"
                        >
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


        {{-- Tombol Cetak --}}
        <div class="mb-4">

            @if ($tanggalMulai && $tanggalSelesai)

                <form
                    method="GET"
                    action="{{ route('owner.rekap.cetak') }}"
                    target="_blank"
                    style="display: inline;"
                >

                    <input
                        type="hidden"
                        name="tanggal_mulai"
                        value="{{ $tanggalMulai }}"
                    >

                    <input
                        type="hidden"
                        name="tanggal_selesai"
                        value="{{ $tanggalSelesai }}"
                    >

                    <button
                        type="submit"
                        class="btn btn-brand"
                    >
                        Cetak Laporan
                    </button>

                </form>

            @else

                <button
                    type="button"
                    class="btn btn-secondary"
                    disabled
                >
                    Cetak Laporan
                </button>

                <small class="text-muted ms-2">
                    Pilih periode terlebih dahulu untuk mencetak laporan.
                </small>

            @endif

        </div>


    {{-- Statistik --}}
    <div class="row g-3 mb-4">

        {{-- Total Transaksi --}}
        <div class="col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <p class="text-muted mb-1">
                        Total Transaksi
                    </p>

                    <h2 class="mb-0">
                        {{ $totalTransaksi }}
                    </h2>

                    <small class="text-muted">
                        Transaksi parkir selesai
                    </small>

                </div>

            </div>

        </div>


        {{-- Total Pendapatan --}}
        <div class="col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <p class="text-muted mb-1">
                        Total Pendapatan
                    </p>

                    <h2 class="mb-0">
                        Rp {{ number_format(
                            $totalPendapatan,
                            0,
                            ',',
                            '.'
                        ) }}
                    </h2>

                    <small class="text-muted">
                        Pendapatan dari transaksi selesai
                    </small>

                </div>

            </div>

        </div>

    </div>


    {{-- Tabel Transaksi --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="mb-3">

                <h2 class="h5 mb-1">
                    Data Transaksi
                </h2>

                <p class="text-muted mb-0">
                    Daftar transaksi parkir yang telah selesai.
                </p>

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="60">
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

                        @forelse($transaksi as $item)

                            <tr>

                                {{-- Nomor --}}
                                <td>
                                    {{ $no++ }}
                                </td>


                                {{-- Plat Nomor --}}
                                <td>
                                    <strong>
                                        {{ $item->plat_nomor ?? '-' }}
                                    </strong>
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
                                    Rp {{ number_format(
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
                                    class="text-center py-5 text-muted"
                                >
                                    Tidak ada transaksi pada periode
                                    yang dipilih.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection