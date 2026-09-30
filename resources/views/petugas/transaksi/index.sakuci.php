@extends('layouts.app')

@section('title', 'Transaksi Parkir')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Petugas
        </span>

        <h1 class="h4 mb-1">
            Transaksi Parkir
        </h1>

        <small class="text-muted">
            Kelola kendaraan masuk dan keluar.
        </small>
    </div>

    <a
        href="{{ route('petugas.transaksi.masuk') }}"
        class="btn btn-sm btn-success"
    >
        + Parkir Masuk
    </a>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <div class="mb-3">

            <h2 class="h6 mb-1">
                Daftar Transaksi
            </h2>

            <small class="text-muted">
                Daftar kendaraan yang sedang parkir dan yang sudah keluar.
            </small>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Plat Nomor</th>
                        <th>Jenis Kendaraan</th>
                        <th>Member</th>
                        <th>Area</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($transaksiList as $t)

                        <tr>

                            {{-- ID --}}
                            <td>
                                {{ $t->id_parkir }}
                            </td>


                            {{-- PLAT NOMOR --}}
                            <td>

                                <strong>
                                    {{ $t->plat_nomor ?? '-' }}
                                </strong>

                            </td>


                            {{-- JENIS KENDARAAN --}}
                            <td>

                                @if($t->tarif)

                                    {{ ucfirst(
                                        $t->tarif->jenis_kendaraan
                                    ) }}

                                @else

                                    -

                                @endif

                            </td>


                            {{-- MEMBER --}}
                            <td>

                                @if($t->member)

                                    <div>
                                        {{ $t->member->nama }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $t->member->kode_member }}
                                    </small>

                                @else

                                    <span class="text-muted">
                                        Non-Member
                                    </span>

                                @endif

                            </td>


                            {{-- AREA --}}
                            <td>

                                @if($t->area)

                                    {{ $t->area->nama_area }}

                                @else

                                    -

                                @endif

                            </td>


                            {{-- WAKTU MASUK --}}
                            <td>
                                {{ $t->waktu_masuk }}
                            </td>


                            {{-- WAKTU KELUAR --}}
                            <td>
                                {{ $t->waktu_keluar ?? '-' }}
                            </td>


                            {{-- BIAYA --}}
                            <td>

                                Rp
                                {{ number_format(
                                    $t->biaya_total ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($t->status === 'masuk')

                                    <span class="badge bg-warning text-dark">
                                        PARKIR
                                    </span>

                                @elseif($t->status === 'keluar')

                                    <span class="badge bg-success">
                                        KELUAR
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                @if($t->status === 'masuk')

                                    <div class="d-flex gap-1">

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

                                @elseif($t->status === 'keluar')

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
                                class="text-center text-muted py-5"
                            >

                                <div class="mb-3">
                                    Belum ada transaksi parkir.
                                </div>

                                <a
                                    href="{{ route(
                                        'petugas.transaksi.masuk'
                                    ) }}"
                                    class="btn btn-sm btn-success"
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

@endsection