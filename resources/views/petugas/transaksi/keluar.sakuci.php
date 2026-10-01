@extends('layouts.app')

@section('title', 'Proses Parkir Keluar')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Petugas
        </span>

        <h1 class="h4 mb-1">
            Proses Parkir Keluar
        </h1>

        <p class="text-muted mb-0">
            Periksa data kendaraan, hitung pembayaran, dan selesaikan transaksi.
        </p>
    </div>

    <a
        href="{{ route('petugas.transaksi.index') }}"
        class="btn btn-sm btn-outline-secondary"
    >
        &larr; Kembali
    </a>

</div>


<div class="row justify-content-center">

    <div class="col-md-8 col-lg-7">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">


                {{-- HEADER TRANSAKSI --}}
                <div class="d-flex align-items-center justify-content-between mb-4">

                    <div>

                        <h2 class="h6 mb-1">
                            Transaksi #{{ $transaksi->id_parkir }}
                        </h2>

                        <small class="text-muted">
                            Detail kendaraan yang akan keluar.
                        </small>

                    </div>


                    @if ($transaksi->status === 'masuk')

                        <span class="badge bg-warning-subtle text-warning">
                            PARKIR
                        </span>

                    @endif

                </div>


                {{-- MEMBER --}}
                <div class="mb-3">

                    <label class="form-label">
                        Member
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $transaksi->member?->nama ?? 'Non-Member' }}"
                        readonly
                    >

                </div>


                {{-- KODE MEMBER --}}
                @if ($transaksi->member)

                    <div class="mb-3">

                        <label class="form-label">
                            Kode Member
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $transaksi->member->kode_member }}"
                            readonly
                        >

                    </div>

                @endif


                {{-- STATUS MEMBER --}}
                @if ($transaksi->id_member)

                    <div class="alert alert-success mb-4">

                        <div class="d-flex align-items-start gap-2">

                            <span>
                                🎉
                            </span>

                            <div>

                                <strong>
                                    Member mendapatkan diskon 20%
                                </strong>

                                <div class="small mt-1">
                                    Transaksi ini terdaftar sebagai member
                                    dan mendapatkan potongan sebesar 20%
                                    dari biaya normal.
                                </div>

                            </div>

                        </div>

                    </div>

                @else

                    <div class="alert alert-secondary mb-4">

                        <strong>
                            Non-Member
                        </strong>

                        <div class="small mt-1">
                            Transaksi ini menggunakan tarif parkir normal.
                        </div>

                    </div>

                @endif


                {{-- DATA KENDARAAN --}}
                <div class="card border-0 bg-body-tertiary mb-4">

                    <div class="card-body p-3">

                        <h3 class="h6 mb-3">
                            Data Kendaraan
                        </h3>


                        <div class="row g-3">

                            {{-- PLAT --}}
                            <div class="col-md-6">

                                <label class="form-label text-muted small">
                                    Plat Nomor
                                </label>

                                <div class="fw-semibold">
                                    {{ $transaksi->plat_nomor ?? '-' }}
                                </div>

                            </div>


                            {{-- JENIS --}}
                            <div class="col-md-6">

                                <label class="form-label text-muted small">
                                    Jenis Kendaraan
                                </label>

                                <div class="fw-semibold">

                                    {{ $tarif->jenis_kendaraan
                                        ? ucfirst($tarif->jenis_kendaraan)
                                        : '-'
                                    }}

                                </div>

                            </div>


                            {{-- AREA --}}
                            <div class="col-md-6">

                                <label class="form-label text-muted small">
                                    Area Parkir
                                </label>

                                <div class="fw-semibold">
                                    {{ $transaksi->area?->nama_area ?? '-' }}
                                </div>

                            </div>


                            {{-- TARIF --}}
                            <div class="col-md-6">

                                <label class="form-label text-muted small">
                                    Tarif Per Jam
                                </label>

                                <div class="fw-semibold">

                                    Rp {{ number_format(
                                        $tarif->tarif_per_jam,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- WAKTU PARKIR --}}
                <div class="card border-0 bg-body-tertiary mb-4">

                    <div class="card-body p-3">

                        <h3 class="h6 mb-3">
                            Waktu Parkir
                        </h3>


                        <div class="row g-3">

                            <div class="col-md-4">

                                <label class="form-label text-muted small">
                                    Waktu Masuk
                                </label>

                                <div class="fw-semibold">
                                    {{ $transaksi->waktu_masuk }}
                                </div>

                            </div>


                            <div class="col-md-4">

                                <label class="form-label text-muted small">
                                    Waktu Keluar
                                </label>

                                <div class="fw-semibold">
                                    {{ $waktuKeluar }}
                                </div>

                            </div>


                            <div class="col-md-4">

                                <label class="form-label text-muted small">
                                    Durasi Parkir
                                </label>

                                <div class="fw-semibold">
                                    {{ $durasiJam }} jam
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- RINCIAN PEMBAYARAN --}}
                <div class="card border mb-4">

                    <div class="card-body p-4">

                        <div class="d-flex align-items-center justify-content-between mb-3">

                            <h3 class="h6 mb-0">
                                Rincian Pembayaran
                            </h3>

                            @if ($diskon > 0)

                                <span class="badge bg-success-subtle text-success">
                                    Member -20%
                                </span>

                            @else

                                <span class="badge bg-secondary-subtle text-secondary">
                                    Tarif Normal
                                </span>

                            @endif

                        </div>


                        {{-- BIAYA NORMAL --}}
                        <div class="d-flex justify-content-between mb-2">

                            <span class="text-muted">
                                Biaya Normal
                            </span>

                            <strong>
                                Rp {{ number_format(
                                    $biayaNormal,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </strong>

                        </div>


                        {{-- DISKON --}}
                        @if ($diskon > 0)

                            <div class="d-flex justify-content-between mb-2">

                                <span class="text-success">
                                    Diskon Member (20%)
                                </span>

                                <strong class="text-success">

                                    - Rp {{ number_format(
                                        $diskon,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </strong>

                            </div>

                        @else

                            <div class="d-flex justify-content-between mb-2">

                                <span class="text-muted">
                                    Diskon
                                </span>

                                <span class="text-muted">
                                    Rp 0
                                </span>

                            </div>

                        @endif


                        <hr>


                        {{-- TOTAL --}}
                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <span class="text-muted small d-block">
                                    Total Pembayaran
                                </span>

                                <strong>
                                    Total Bayar
                                </strong>

                            </div>

                            <strong class="fs-3">

                                Rp {{ number_format(
                                    $biayaTotal,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </strong>

                        </div>

                    </div>

                </div>


                {{-- PROSES PEMBAYARAN --}}
                <form
                    method="POST"
                    action="{{ route(
                        'petugas.transaksi.updateKeluar',
                        ['id' => $transaksi->id_parkir]
                    ) }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-brand w-100"
                    >
                        Proses Bayar & Selesaikan Transaksi
                    </button>

                </form>


                <a
                    href="{{ route('petugas.transaksi.index') }}"
                    class="btn btn-outline-secondary w-100 mt-2"
                >
                    Batal

                </a>

            </div>

        </div>


        {{-- INFORMASI --}}
        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body p-4">

                <h2 class="h6 mb-3">
                    Informasi Pembayaran
                </h2>

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Transaksi akan diselesaikan
                    </strong>

                    <small class="text-muted">
                        Setelah tombol pembayaran ditekan, transaksi akan
                        berstatus selesai dan kendaraan dapat keluar dari
                        area parkir. Untuk member, diskon 20% telah
                        diperhitungkan pada total pembayaran.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection