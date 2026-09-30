@extends('layouts.app')

@section('title', 'Proses Parkir Keluar')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Petugas
        </span>

        <h1 class="h4 mb-1">
            Proses Parkir Keluar
        </h1>

        <small class="text-muted">
            Periksa data parkir dan proses pembayaran.
        </small>
    </div>

    <a
        href="{{ route('petugas.transaksi.index') }}"
        class="btn btn-sm btn-outline-secondary"
    >
        &larr; Kembali
    </a>

</div>


<div class="card border-0 shadow-sm col-md-7 mx-auto">

    <div class="card-body p-4">

        <div class="d-flex align-items-center justify-content-between mb-4">

            <div>

                <h2 class="h6 mb-1">
                    Transaksi #{{ $transaksi->id_parkir }}
                </h2>

                <small class="text-muted">
                    Detail kendaraan yang akan keluar.
                </small>

            </div>

            @if($transaksi->status === 'masuk')

                <span class="badge bg-warning text-dark">
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
        @if($transaksi->member)

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


        {{-- PLAT --}}
        <div class="mb-3">

            <label class="form-label">
                Plat Nomor
            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $transaksi->plat_nomor ?? '-' }}"
                readonly
            >

        </div>


        {{-- JENIS KENDARAAN --}}
        <div class="mb-3">

            <label class="form-label">
                Jenis Kendaraan
            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $tarif->jenis_kendaraan
                    ? ucfirst($tarif->jenis_kendaraan)
                    : '-'
                }}"
                readonly
            >

        </div>


        {{-- AREA --}}
        <div class="mb-3">

            <label class="form-label">
                Area Parkir
            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $transaksi->area?->nama_area ?? '-' }}"
                readonly
            >

        </div>


        {{-- WAKTU MASUK --}}
        <div class="mb-3">

            <label class="form-label">
                Waktu Masuk
            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $transaksi->waktu_masuk }}"
                readonly
            >

        </div>


        {{-- WAKTU KELUAR --}}
        <div class="mb-3">

            <label class="form-label">
                Waktu Keluar
            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $waktuKeluar }}"
                readonly
            >

        </div>


        {{-- DURASI --}}
        <div class="mb-3">

            <label class="form-label">
                Durasi Parkir
            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $durasiJam }} jam"
                readonly
            >

        </div>


        {{-- TARIF --}}
        <div class="mb-3">

            <label class="form-label">
                Tarif Per Jam
            </label>

            <input
                type="text"
                class="form-control"
                value="Rp {{ number_format(
                    $tarif->tarif_per_jam,
                    0,
                    ',',
                    '.'
                ) }}"
                readonly
            >

        </div>


        {{-- TOTAL --}}
        <div class="alert alert-info mb-4">

            <div class="d-flex justify-content-between align-items-center">

                <span>
                    Total Biaya
                </span>

                <strong class="fs-5">

                    Rp
                    {{ number_format(
                        $biayaTotal,
                        0,
                        ',',
                        '.'
                    ) }}

                </strong>

            </div>

        </div>


        {{-- PROSES --}}
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
                class="btn btn-danger w-100"
            >
                Proses Bayar & Selesai
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

@endsection