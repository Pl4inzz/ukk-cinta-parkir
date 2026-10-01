@extends('layouts.app')

@section('title', 'Kelola Tarif Parkir')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Admin
        </span>

        <h1 class="h4 mb-1">
            Kelola Tarif Parkir
        </h1>

        <p class="text-muted mb-0">
            Kelola tarif parkir berdasarkan jenis kendaraan.
        </p>
    </div>

    <a
        href="{{ route('admin.dashboard') }}"
        class="btn btn-sm btn-outline-secondary"
    >
        &larr; Kembali
    </a>

</div>


<div class="row g-4">

    {{-- FORM TAMBAH TARIF --}}
    <div class="col-md-5">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <div>
                        <h2 class="h6 mb-1">
                            Tambah Tarif
                        </h2>

                        <small class="text-muted">
                            Tambahkan tarif kendaraan baru
                        </small>
                    </div>

                    <span class="badge bg-success-subtle text-success">
                        Tarif Parkir
                    </span>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.tarif.store') }}"
                >

                    @csrf


                    {{-- JENIS KENDARAAN --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="jenis_kendaraan"
                        >
                            Jenis Kendaraan
                        </label>

                        <input
                            type="text"
                            id="jenis_kendaraan"
                            name="jenis_kendaraan"
                            value="{{ old('jenis_kendaraan') }}"
                            placeholder="Contoh: motor, mobil, truk"
                            class="form-control {{ errors()->has('jenis_kendaraan') ? 'is-invalid' : '' }}"
                        >

                        <small class="text-muted">
                            Masukkan jenis kendaraan sesuai kebutuhan parkir.
                        </small>

                        @error('jenis_kendaraan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- TARIF --}}
                    <div class="mb-4">

                        <label
                            class="form-label"
                            for="tarif_per_jam"
                        >
                            Tarif per Jam
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input
                                type="number"
                                id="tarif_per_jam"
                                name="tarif_per_jam"
                                value="{{ old('tarif_per_jam') }}"
                                placeholder="Contoh: 2000"
                                min="0"
                                step="1"
                                class="form-control {{ errors()->has('tarif_per_jam') ? 'is-invalid' : '' }}"
                            >

                        </div>

                        @error('tarif_per_jam')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- BUTTON --}}
                    <button
                        class="btn btn-brand w-100"
                        type="submit"
                    >
                        + Tambah Tarif
                    </button>

                </form>

            </div>

        </div>


        {{-- INFO --}}
        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body p-4">

                <h2 class="h6 mb-3">
                    Informasi Tarif
                </h2>

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Tarif per Jam
                    </strong>

                    <small class="text-muted">
                        Tarif digunakan oleh sistem untuk menghitung
                        biaya transaksi berdasarkan durasi parkir.
                    </small>

                </div>

            </div>

        </div>

    </div>


    {{-- DAFTAR TARIF --}}
    <div class="col-md-7">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <div>
                        <h2 class="h6 mb-1">
                            Daftar Tarif Parkir
                        </h2>

                        <small class="text-muted">
                            Tarif yang tersedia pada sistem
                        </small>
                    </div>

                    <span class="badge rounded-pill badge-brand">
                        {{ count($tarifList) }} Tarif
                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>
                                <th width="50">#</th>
                                <th>Jenis Kendaraan</th>
                                <th>Tarif / Jam</th>
                                <th class="text-end">Aksi</th>
                            </tr>

                        </thead>


                        <tbody>

                        @if (count($tarifList) > 0)

                            @php
                                $no = 1;
                            @endphp

                            @foreach ($tarifList as $item)

                                <tr>

                                    {{-- NOMOR --}}
                                    <td class="text-muted">
                                        {{ $no++ }}
                                    </td>


                                    {{-- JENIS KENDARAAN --}}
                                    <td>

                                        <span class="fw-medium text-capitalize">
                                            {{ $item->jenis_kendaraan }}
                                        </span>

                                    </td>


                                    {{-- TARIF --}}
                                    <td>

                                        <strong>
                                            Rp {{ number_format($item->tarif_per_jam, 0, ',', '.') }}
                                        </strong>

                                        <small class="text-muted">
                                            / jam
                                        </small>

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="text-end">

                                        <div class="d-inline-flex gap-2">

                                            <a
                                                href="{{ route('admin.tarif.edit', ['id' => $item->id_tarif]) }}"
                                                class="btn btn-sm btn-outline-brand"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                method="POST"
                                                action="{{ route('admin.tarif.destroy', ['id' => $item->id_tarif]) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus tarif ini?')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="btn btn-sm btn-outline-danger"
                                                    type="submit"
                                                >
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        @else

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center text-secondary py-4"
                                >
                                    Belum ada data tarif parkir.
                                </td>

                            </tr>

                        @endif

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection