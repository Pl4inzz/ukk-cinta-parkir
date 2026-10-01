@extends('layouts.app')

@section('title', 'Dashboard Owner')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
                Area Owner
            </span>

            <h1 class="h4 mb-1">Dashboard Owner</h1>

            <p class="text-muted mb-0">
                Selamat datang, {{ $user->username }}.
            </p>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <p class="text-muted mb-1">
                        Sistem Parkir
                    </p>

                    <h2 class="h5 mb-2">
                        EZPark
                    </h2>

                    <p class="text-muted mb-0">
                        Selamat datang di dashboard Owner.
                        Gunakan halaman ini untuk memantau
                        aktivitas dan rekapitulasi parkir.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <p class="text-muted mb-1">
                        Akses
                    </p>

                    <h2 class="h5 mb-2">
                        Owner
                    </h2>

                    <p class="text-muted mb-0">
                        Anda masuk sebagai Owner dan dapat
                        mengakses informasi rekap transaksi.
                    </p>
                </div>
            </div>
        </div>

    </div>

@endsection