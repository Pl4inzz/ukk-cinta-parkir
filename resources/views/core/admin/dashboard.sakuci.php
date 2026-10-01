@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>

        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Admin
        </span>

        <h1 class="h4 mb-1">
            Dashboard Admin
        </h1>

        <p class="text-muted mb-0">
            Selamat datang, {{ $user->nama_lengkap ?? $user->username }}.
        </p>

    </div>

</div>


{{-- Header --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-4">

        <h2 class="h5 mb-2">
            Pengelolaan Sistem
        </h2>

        <p class="text-muted mb-0">
            Kelola data pengguna, tarif parkir, area parkir,
            membership, dan aktivitas sistem EZPark.
        </p>

    </div>

</div>


{{-- Master Data --}}
<div class="row g-4">

    {{-- User --}}
    <div class="col-md-6 col-xl-4">

        <a
            href="{{ route('admin.users.index') }}"
            class="card border-0 shadow-sm h-100 text-decoration-none"
        >

            <div class="card-body p-4">

                <span class="badge rounded-pill badge-brand mb-3">
                    User
                </span>

                <h2 class="h6 text-body mb-2">
                    Kelola User
                </h2>

                <p class="text-muted small mb-0">
                    Kelola akun pengguna dan role
                    yang tersedia pada sistem.
                </p>

            </div>

        </a>

    </div>


    {{-- Tarif --}}
    <div class="col-md-6 col-xl-4">

        <a
            href="{{ route('admin.tarif.index') }}"
            class="card border-0 shadow-sm h-100 text-decoration-none"
        >

            <div class="card-body p-4">

                <span class="badge bg-success-subtle text-success mb-3">
                    Tarif
                </span>

                <h2 class="h6 text-body mb-2">
                    Tarif Parkir
                </h2>

                <p class="text-muted small mb-0">
                    Kelola tarif parkir berdasarkan
                    jenis kendaraan.
                </p>

            </div>

        </a>

    </div>


    {{-- Area --}}
    <div class="col-md-6 col-xl-4">

        <a
            href="{{ route('area.index') }}"
            class="card border-0 shadow-sm h-100 text-decoration-none"
        >

            <div class="card-body p-4">

                <span class="badge bg-info-subtle text-info mb-3">
                    Area
                </span>

                <h2 class="h6 text-body mb-2">
                    Area Parkir
                </h2>

                <p class="text-muted small mb-0">
                    Kelola area, kapasitas, dan
                    ketersediaan parkir.
                </p>

            </div>

        </a>

    </div>


    {{-- Member --}}
    <div class="col-md-6 col-xl-4">

        <a
            href="{{ route('members.index') }}"
            class="card border-0 shadow-sm h-100 text-decoration-none"
        >

            <div class="card-body p-4">

                <span class="badge bg-warning-subtle text-warning mb-3">
                    Membership
                </span>

                <h2 class="h6 text-body mb-2">
                    Data Member
                </h2>

                <p class="text-muted small mb-0">
                    Kelola data member dan masa berlaku
                    keanggotaan.
                </p>

            </div>

        </a>

    </div>


    {{-- Log --}}
    <div class="col-md-6 col-xl-4">

        <a
            href="{{ route('logAktivitas.index') }}"
            class="card border-0 shadow-sm h-100 text-decoration-none"
        >

            <div class="card-body p-4">

                <span class="badge bg-secondary-subtle text-secondary mb-3">
                    Monitoring
                </span>

                <h2 class="h6 text-body mb-2">
                    Log Aktivitas
                </h2>

                <p class="text-muted small mb-0">
                    Lihat aktivitas pengguna dan
                    aktivitas transaksi sistem.
                </p>

            </div>

        </a>

    </div>


    {{-- Database --}}
    <div class="col-md-6 col-xl-4">

        <a
            href="{{ route('admin.database.export') }}"
            class="card border-0 shadow-sm h-100 text-decoration-none"
        >

            <div class="card-body p-4">

                <span class="badge bg-secondary-subtle text-secondary mb-3">
                    Sistem
                </span>

                <h2 class="h6 text-body mb-2">
                    Download Database
                </h2>

                <p class="text-muted small mb-0">
                    Unduh database sebagai file SQL
                    untuk kebutuhan backup.
                </p>

            </div>

        </a>

    </div>

</div>


{{-- Informasi --}}
<div class="card border-0 shadow-sm mt-4">

    <div class="card-body p-4">

        <h2 class="h6 mb-3">
            Struktur Pengelolaan EZPark
        </h2>

        <div class="row g-3">

            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Data Master
                    </strong>

                    <small class="text-muted">
                        User, tarif, area parkir,
                        dan member.
                    </small>

                </div>

            </div>


            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Operasional
                    </strong>

                    <small class="text-muted">
                        Transaksi parkir dikelola
                        oleh petugas.
                    </small>

                </div>

            </div>


            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Monitoring
                    </strong>

                    <small class="text-muted">
                        Aktivitas sistem dapat
                        dipantau melalui log.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection