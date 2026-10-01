@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>

        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Petugas
        </span>

        <h1 class="h4 mb-1">
            Dashboard Petugas
        </h1>

        <p class="text-muted mb-0">
            Selamat datang, {{ $user->nama_lengkap ?? $user->username }}.
        </p>

    </div>

</div>


{{-- Sambutan --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-4">

        <h2 class="h5 mb-2">
            Operasional Parkir
        </h2>

        <p class="text-muted mb-0">
            Gunakan menu transaksi untuk mencatat kendaraan masuk,
            memproses kendaraan keluar, dan melihat aktivitas parkir.
        </p>

    </div>

</div>


{{-- Menu Utama --}}
<div class="row g-4">

    {{-- Transaksi Parkir --}}
    <div class="col-md-6">

        <a
            href="{{ route('petugas.transaksi.index') }}"
            class="card border-0 shadow-sm h-100 text-decoration-none"
        >

            <div class="card-body p-4">

                <div class="d-flex align-items-start justify-content-between">

                    <div>

                        <span class="badge rounded-pill badge-brand mb-3">
                            Operasional
                        </span>

                        <h2 class="h5 mb-2 text-body">
                            Transaksi Parkir
                        </h2>

                        <p class="text-muted mb-0">
                            Lihat kendaraan yang sedang parkir,
                            proses kendaraan masuk dan keluar.
                        </p>

                    </div>

                    <span
                        class="fs-3 text-success"
                        aria-hidden="true"
                    >
                        🚗
                    </span>

                </div>

            </div>

        </a>

    </div>


    {{-- Parkir Masuk --}}
    <div class="col-md-6">

        <a
            href="{{ route('petugas.transaksi.masuk') }}"
            class="card border-0 shadow-sm h-100 text-decoration-none"
        >

            <div class="card-body p-4">

                <div class="d-flex align-items-start justify-content-between">

                    <div>

                        <span class="badge bg-success-subtle text-success mb-3">
                            Kendaraan Masuk
                        </span>

                        <h2 class="h5 mb-2 text-body">
                            Catat Parkir Masuk
                        </h2>

                        <p class="text-muted mb-0">
                            Catat kendaraan yang memasuki area parkir
                            dan cetak tiket parkir.
                        </p>

                    </div>

                    <span
                        class="fs-3 text-success"
                        aria-hidden="true"
                    >
                        ➜
                    </span>

                </div>

            </div>

        </a>

    </div>

</div>


{{-- Informasi --}}
<div class="card border-0 shadow-sm mt-4">

    <div class="card-body p-4">

        <h2 class="h6 mb-3">
            Alur Kerja Petugas
        </h2>

        <div class="row g-3">

            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        1. Kendaraan Masuk
                    </strong>

                    <small class="text-muted">
                        Masukkan data kendaraan dan area parkir.
                    </small>

                </div>

            </div>


            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        2. Kendaraan Parkir
                    </strong>

                    <small class="text-muted">
                        Pantau kendaraan melalui menu transaksi.
                    </small>

                </div>

            </div>


            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        3. Kendaraan Keluar
                    </strong>

                    <small class="text-muted">
                        Hitung biaya, diskon member, dan selesaikan pembayaran.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection