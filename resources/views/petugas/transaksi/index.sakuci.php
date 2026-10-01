@extends('layouts.app')

@section('title', 'Transaksi Parkir')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Petugas
        </span>

        <h1 class="h4 mb-1">
            Transaksi Parkir
        </h1>

        <p class="text-muted mb-0">
            Kelola kendaraan yang sedang parkir dan transaksi yang telah selesai.
        </p>
    </div>

    <a
        href="{{ route('petugas.transaksi.masuk') }}"
        class="btn btn-brand"
    >
        + Parkir Masuk
    </a>

</div>


{{-- RINGKASAN --}}
<div class="row g-3 mb-4">

    <div class="col-md-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <span class="badge bg-warning-subtle text-warning mb-3">
                    Kendaraan Parkir
                </span>

                <h2 class="h4 mb-1">

                    @php
                        $jumlahParkir = 0;
                    @endphp

                    @foreach ($transaksiList as $item)

                        @if ($item->status === 'masuk')
                            @php
                                $jumlahParkir++;
                            @endphp
                        @endif

                    @endforeach

                    {{ $jumlahParkir }}

                </h2>

                <small class="text-muted">
                    Kendaraan yang masih berada di area parkir.
                </small>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <span class="badge bg-success-subtle text-success mb-3">
                    Selesai
                </span>

                <h2 class="h4 mb-1">

                    @php
                        $jumlahKeluar = 0;
                    @endphp

                    @foreach ($transaksiList as $item)

                        @if ($item->status === 'keluar')
                            @php
                                $jumlahKeluar++;
                            @endphp
                        @endif

                    @endforeach

                    {{ $jumlahKeluar }}

                </h2>

                <small class="text-muted">
                    Kendaraan yang sudah menyelesaikan parkir.
                </small>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <span class="badge rounded-pill badge-brand mb-3">
                    Total Transaksi
                </span>

                <h2 class="h4 mb-1">
                    {{ count($transaksiList) }}
                </h2>

                <small class="text-muted">
                    Seluruh transaksi yang tercatat.
                </small>

            </div>

        </div>

    </div>

</div>


{{-- DAFTAR TRANSAKSI --}}
<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <div class="d-flex align-items-center justify-content-between mb-3">

            <div>

                <h2 class="h6 mb-1">
                    Daftar Transaksi
                </h2>

                <small class="text-muted">
                    Kendaraan masuk, kendaraan yang masih parkir,
                    dan transaksi yang telah selesai.
                </small>

            </div>

            <span class="badge rounded-pill badge-brand">
                {{ count($transaksiList) }} Transaksi
            </span>

        </div>


        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead>

                    <tr>

                        <th width="50">#</th>
                        <th>Plat Nomor</th>
                        <th>Kendaraan</th>
                        <th>Member</th>
                        <th>Area</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>

                    </tr>

                </thead>


                <tbody>

                @php
                    $no = 1;
                @endphp


                @forelse ($transaksiList as $t)

                    <tr>


                        {{-- NOMOR --}}
                        <td class="text-muted">
                            {{ $no++ }}
                        </td>


                        {{-- PLAT NOMOR --}}
                        <td>

                            <strong>
                                {{ $t->plat_nomor ?? '-' }}
                            </strong>

                        </td>


                        {{-- JENIS KENDARAAN --}}
                        <td>

                            @if ($t->tarif)

                                <span class="badge bg-secondary-subtle text-secondary">
                                    {{ ucfirst($t->tarif->jenis_kendaraan) }}
                                </span>

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- MEMBER --}}
                        <td>

                            @if ($t->member)

                                <span class="fw-medium d-block">
                                    {{ $t->member->nama }}
                                </span>

                                <small class="text-muted">
                                    {{ $t->member->kode_member }}
                                </small>

                                <br>

                                <span class="badge bg-success-subtle text-success mt-1">
                                    Diskon 20%
                                </span>

                            @else

                                <span class="text-muted">
                                    Non-Member
                                </span>

                            @endif

                        </td>


                        {{-- AREA --}}
                        <td>

                            @if ($t->area)

                                {{ $t->area->nama_area }}

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- WAKTU MASUK --}}
                        <td>

                            <small>
                                {{ $t->waktu_masuk }}
                            </small>

                        </td>


                        {{-- WAKTU KELUAR --}}
                        <td>

                            @if ($t->waktu_keluar)

                                <small>
                                    {{ $t->waktu_keluar }}
                                </small>

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- BIAYA --}}
                        <td>

                            @if ($t->status === 'keluar')

                                <strong>
                                    Rp {{ number_format(
                                        $t->biaya_total ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </strong>

                            @else

                                <span class="text-muted">
                                    Belum dihitung
                                </span>

                            @endif

                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if ($t->status === 'masuk')

                                <span class="badge bg-warning-subtle text-warning">
                                    PARKIR
                                </span>

                            @elseif ($t->status === 'keluar')

                                <span class="badge bg-success-subtle text-success">
                                    SELESAI
                                </span>

                            @else

                                <span class="badge bg-secondary-subtle text-secondary">
                                    {{ strtoupper($t->status) }}
                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td class="text-end">

                            @if ($t->status === 'masuk')

                                <div class="d-inline-flex gap-2">

                                    <a
                                        href="{{ route(
                                            'petugas.transaksi.keluar',
                                            [
                                                'id' => $t->id_parkir
                                            ]
                                        ) }}"
                                        class="btn btn-sm btn-outline-danger"
                                    >
                                        Keluar
                                    </a>


                                    <a
                                        href="{{ route(
                                            'petugas.transaksi.cetakTiket',
                                            [
                                                'id' => $t->id_parkir
                                            ]
                                        ) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-secondary"
                                    >
                                        Tiket
                                    </a>

                                </div>


                            @elseif ($t->status === 'keluar')

                                <a
                                    href="{{ route(
                                        'petugas.transaksi.cetakStruk',
                                        [
                                            'id' => $t->id_parkir
                                        ]
                                    ) }}"
                                    target="_blank"
                                    class="btn btn-sm btn-outline-info"
                                >
                                    Struk
                                </a>

                            @endif

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="10"
                            class="text-center py-5"
                        >

                            <div class="mb-3">

                                <span class="badge bg-secondary-subtle text-secondary mb-2">
                                    Belum Ada Transaksi
                                </span>

                                <p class="text-muted mb-0">
                                    Belum ada transaksi parkir yang tercatat.
                                </p>

                            </div>


                            <a
                                href="{{ route(
                                    'petugas.transaksi.masuk'
                                ) }}"
                                class="btn btn-brand"
                            >
                                + Parkir Masuk
                            </a>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- INFO --}}
<div class="card border-0 shadow-sm mt-4">

    <div class="card-body p-4">

        <h2 class="h6 mb-3">
            Alur Transaksi
        </h2>

        <div class="row g-3">

            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        1. Kendaraan Masuk
                    </strong>

                    <small class="text-muted">
                        Catat kendaraan dan area parkir,
                        kemudian cetak tiket.
                    </small>

                </div>

            </div>


            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        2. Kendaraan Parkir
                    </strong>

                    <small class="text-muted">
                        Transaksi berstatus PARKIR
                        sampai kendaraan keluar.
                    </small>

                </div>

            </div>


            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        3. Kendaraan Keluar
                    </strong>

                    <small class="text-muted">
                        Hitung biaya, diskon member,
                        lalu cetak struk.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection