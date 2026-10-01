@extends('layouts.app')

@section('title', 'EZPark - Sistem Manajemen Parkir')

@section('content')

{{-- HERO --}}
<div class="row align-items-center g-4 mb-5">

    <div class="col-lg-7">

        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
            EZPark Parking System
        </span>

        <h1 class="display-5 fw-bold mb-3">
            Sistem Manajemen
            <span class="text-brand">
                Parkir Terintegrasi
            </span>
        </h1>

        <p class="text-secondary fs-5 mb-4">
            EZPark membantu pengelolaan kendaraan masuk dan keluar,
            membership, tarif parkir, area parkir, serta laporan
            transaksi dalam satu sistem.
        </p>

        <div class="d-flex flex-wrap gap-2">

            <a
                href="{{ route('login') }}"
                class="btn btn-brand btn-lg px-4 fw-semibold"
            >
                Login ke EZPark
            </a>

        </div>

    </div>


    <div class="col-lg-5">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center gap-3 mb-4">

                    <div
                        class="rounded-3 bg-success-subtle d-flex align-items-center justify-content-center"
                        style="width: 56px; height: 56px;"
                    >
                        <span class="fs-3">
                            🚗
                        </span>
                    </div>

                    <div>

                        <h2 class="h5 mb-1">
                            EZPark
                        </h2>

                        <small class="text-muted">
                            Parking Management System
                        </small>

                    </div>

                </div>


                <div class="p-3 rounded-3 bg-body-tertiary mb-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <span class="text-muted">
                            Transaksi
                        </span>

                        <span class="badge bg-success-subtle text-success">
                            Terintegrasi
                        </span>

                    </div>

                </div>


                <div class="p-3 rounded-3 bg-body-tertiary mb-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <span class="text-muted">
                            Membership
                        </span>

                        <span class="badge bg-warning-subtle text-warning">
                            Diskon 20%
                        </span>

                    </div>

                </div>


                <div class="p-3 rounded-3 bg-body-tertiary">

                    <div class="d-flex justify-content-between align-items-center">

                        <span class="text-muted">
                            Laporan
                        </span>

                        <span class="badge bg-info-subtle text-info">
                            Tersedia
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- FITUR --}}
<section class="mb-5">

    <div class="text-center mb-4">

        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Fitur Sistem
        </span>

        <h2 class="h4 fw-bold mb-2">
            Semua kebutuhan parkir dalam satu sistem
        </h2>

        <p class="text-muted mb-0">
            EZPark menyediakan fitur untuk mendukung operasional
            dan pengelolaan parkir.
        </p>

    </div>


    <div class="row g-4">

        {{-- TRANSAKSI --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div
                        class="rounded-3 bg-success-subtle d-flex align-items-center justify-content-center mb-3"
                        style="width: 48px; height: 48px;"
                    >
                        🚗
                    </div>

                    <h3 class="h6 fw-bold mb-2">
                        Transaksi Parkir
                    </h3>

                    <p class="text-muted small mb-0">
                        Catat kendaraan masuk, proses kendaraan keluar,
                        hitung biaya, dan cetak tiket maupun struk.
                    </p>

                </div>

            </div>

        </div>


        {{-- MEMBER --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div
                        class="rounded-3 bg-warning-subtle d-flex align-items-center justify-content-center mb-3"
                        style="width: 48px; height: 48px;"
                    >
                        👥
                    </div>

                    <h3 class="h6 fw-bold mb-2">
                        Membership
                    </h3>

                    <p class="text-muted small mb-0">
                        Kelola data member dan kendaraan yang terdaftar
                        serta berikan diskon 20% pada transaksi member.
                    </p>

                </div>

            </div>

        </div>


        {{-- AREA --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div
                        class="rounded-3 bg-info-subtle d-flex align-items-center justify-content-center mb-3"
                        style="width: 48px; height: 48px;"
                    >
                        🅿️
                    </div>

                    <h3 class="h6 fw-bold mb-2">
                        Area Parkir
                    </h3>

                    <p class="text-muted small mb-0">
                        Kelola area parkir beserta kapasitas dan
                        jumlah kendaraan yang sedang berada di dalamnya.
                    </p>

                </div>

            </div>

        </div>


        {{-- LAPORAN --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div
                        class="rounded-3 bg-secondary-subtle d-flex align-items-center justify-content-center mb-3"
                        style="width: 48px; height: 48px;"
                    >
                        📊
                    </div>

                    <h3 class="h6 fw-bold mb-2">
                        Rekap Laporan
                    </h3>

                    <p class="text-muted small mb-0">
                        Lihat transaksi yang telah selesai berdasarkan
                        periode tertentu dan cetak laporan.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ALUR SISTEM --}}
<section class="mb-5">

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4 p-lg-5">

            <div class="text-center mb-4">

                <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
                    Alur Parkir
                </span>

                <h2 class="h4 fw-bold mb-2">
                    Proses parkir yang sederhana
                </h2>

                <p class="text-muted mb-0">
                    Alur utama EZPark dari kendaraan masuk
                    sampai transaksi selesai.
                </p>

            </div>


            <div class="row g-4">

                <div class="col-md-4">

                    <div class="text-center">

                        <div
                            class="rounded-circle bg-success-subtle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 56px; height: 56px;"
                        >
                            <strong class="text-success">
                                1
                            </strong>
                        </div>

                        <h3 class="h6 fw-bold">
                            Kendaraan Masuk
                        </h3>

                        <p class="text-muted small mb-0">
                            Petugas mencatat kendaraan,
                            member, dan area parkir.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="text-center">

                        <div
                            class="rounded-circle bg-warning-subtle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 56px; height: 56px;"
                        >
                            <strong class="text-warning">
                                2
                            </strong>
                        </div>

                        <h3 class="h6 fw-bold">
                            Kendaraan Parkir
                        </h3>

                        <p class="text-muted small mb-0">
                            Transaksi tersimpan dan kendaraan
                            tercatat sebagai masih parkir.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="text-center">

                        <div
                            class="rounded-circle bg-info-subtle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 56px; height: 56px;"
                        >
                            <strong class="text-info">
                                3
                            </strong>
                        </div>

                        <h3 class="h6 fw-bold">
                            Kendaraan Keluar
                        </h3>

                        <p class="text-muted small mb-0">
                            Biaya dihitung, diskon member diterapkan,
                            kemudian struk dapat dicetak.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- TENTANG EZPARK --}}
<section class="mb-4">

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4 p-lg-5">

            <div class="row align-items-center g-4">

                <div class="col-lg-8">

                    <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
                        Tentang EZPark
                    </span>

                    <h2 class="h4 fw-bold mb-2">
                        Sistem Informasi Manajemen Parkir
                    </h2>

                    <p class="text-muted mb-0">
                        EZPark dirancang untuk membantu pengelolaan
                        operasional parkir secara terstruktur, mulai dari
                        data master, transaksi kendaraan, membership,
                        hingga rekap laporan.
                    </p>

                </div>


                <div class="col-lg-4 text-lg-end">

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-brand px-4"
                    >
                        Masuk ke Sistem
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


@endsection