@extends('layouts.app')

@section('title', 'Dashboard Owner')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>

        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Owner
        </span>

        <h1 class="h4 mb-1">
            Dashboard Owner
        </h1>

        <p class="text-muted mb-0">
            Selamat datang, {{ $user->nama_lengkap ?? $user->username }}.
        </p>

    </div>

</div>


{{-- Informasi Utama --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-4">

        <div class="row align-items-center g-4">

            <div class="col-md-8">

                <span class="badge bg-success-subtle text-success mb-3">
                    Monitoring Parkir
                </span>

                <h2 class="h4 mb-2">
                    Selamat datang di EZPark
                </h2>

                <p class="text-muted mb-0">
                    Pantau aktivitas parkir dan lihat laporan transaksi
                    berdasarkan periode yang dibutuhkan.
                </p>

            </div>


            <div class="col-md-4 text-md-end">

                <a
                    href="{{ route('owner.rekap') }}"
                    class="btn btn-brand"
                >
                    Lihat Rekap Laporan
                </a>

            </div>

        </div>

    </div>

</div>


{{-- Menu Owner --}}
<div class="row g-4">

    {{-- Rekap --}}
    <div class="col-md-6">

        <a
            href="{{ route('owner.rekap') }}"
            class="card border-0 shadow-sm h-100 text-decoration-none"
        >

            <div class="card-body p-4">

                <span class="badge rounded-pill badge-brand mb-3">
                    Laporan
                </span>

                <h2 class="h5 text-body mb-2">
                    Rekap Laporan Parkir
                </h2>

                <p class="text-muted mb-0">
                    Lihat transaksi parkir yang telah selesai,
                    filter berdasarkan periode, dan cetak laporan.
                </p>

            </div>

        </a>

    </div>


    {{-- Monitoring --}}
    <div class="col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <span class="badge bg-secondary-subtle text-secondary mb-3">
                    Informasi
                </span>

                <h2 class="h5 mb-2">
                    Sistem Parkir
                </h2>

                <p class="text-muted mb-0">
                    EZPark membantu pengelolaan transaksi parkir,
                    membership, tarif, area parkir, dan laporan.
                </p>

            </div>

        </div>

    </div>

</div>


{{-- Panduan --}}
<div class="card border-0 shadow-sm mt-4">

    <div class="card-body p-4">

        <h2 class="h6 mb-3">
            Menu Owner
        </h2>

        <div class="row g-3">

            <div class="col-md-6">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Rekap Laporan
                    </strong>

                    <small class="text-muted">
                        Filter transaksi berdasarkan tanggal
                        dan cetak laporan.
                    </small>

                </div>

            </div>


            <div class="col-md-6">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Monitoring
                    </strong>

                    <small class="text-muted">
                        Gunakan laporan untuk melihat aktivitas
                        transaksi parkir.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection