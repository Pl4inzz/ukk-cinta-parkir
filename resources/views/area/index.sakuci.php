@extends('layouts.app')

@section('title', 'Kelola Area Parkir')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Admin
        </span>

        <h1 class="h4 mb-1">
            Kelola Area Parkir
        </h1>

        <p class="text-muted mb-0">
            Kelola lokasi dan kapasitas area parkir EZPark.
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

    {{-- FORM TAMBAH AREA --}}
    <div class="col-md-5">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <div>
                        <h2 class="h6 mb-1">
                            Tambah Area
                        </h2>

                        <small class="text-muted">
                            Tambahkan area parkir baru
                        </small>
                    </div>

                    <span class="badge bg-info-subtle text-info">
                        Area Parkir
                    </span>

                </div>


                <form
                    method="POST"
                    action="{{ route('area.store') }}"
                >

                    @csrf


                    {{-- NAMA AREA --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="nama_area"
                        >
                            Nama Area
                        </label>

                        <input
                            type="text"
                            id="nama_area"
                            name="nama_area"
                            value="{{ old('nama_area') }}"
                            placeholder="Contoh: Gedung A, Lantai 1"
                            class="form-control {{ errors()->has('nama_area') ? 'is-invalid' : '' }}"
                        >

                        <small class="text-muted">
                            Masukkan nama atau lokasi area parkir.
                        </small>

                        @error('nama_area')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- KAPASITAS --}}
                    <div class="mb-4">

                        <label
                            class="form-label"
                            for="kapasitas"
                        >
                            Kapasitas
                        </label>

                        <div class="input-group">

                            <input
                                type="number"
                                id="kapasitas"
                                name="kapasitas"
                                value="{{ old('kapasitas') }}"
                                placeholder="Contoh: 50"
                                min="0"
                                step="1"
                                class="form-control {{ errors()->has('kapasitas') ? 'is-invalid' : '' }}"
                            >

                            <span class="input-group-text">
                                Slot
                            </span>

                        </div>

                        @error('kapasitas')
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
                        + Tambah Area
                    </button>

                </form>

            </div>

        </div>


        {{-- INFO --}}
        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body p-4">

                <h2 class="h6 mb-3">
                    Informasi Area
                </h2>

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Kapasitas Parkir
                    </strong>

                    <small class="text-muted">
                        Kapasitas menunjukkan jumlah slot kendaraan
                        yang dapat ditampung oleh suatu area parkir.
                    </small>

                </div>

            </div>

        </div>

    </div>


    {{-- DAFTAR AREA --}}
    <div class="col-md-7">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <div>
                        <h2 class="h6 mb-1">
                            Daftar Area Parkir
                        </h2>

                        <small class="text-muted">
                            Area yang tersedia pada sistem
                        </small>
                    </div>

                    <span class="badge rounded-pill badge-brand">
                        {{ isset($areaList) ? count($areaList) : 0 }} Area
                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>
                                <th width="50">#</th>
                                <th>Nama Area</th>
                                <th>Kapasitas</th>
                                <th>Terisi</th>
                                <th class="text-end">Aksi</th>
                            </tr>

                        </thead>


                        <tbody>

                        @if (isset($areaList) && count($areaList) > 0)

                            @php
                                $no = 1;
                            @endphp

                            @foreach ($areaList as $item)

                                <tr>

                                    {{-- NOMOR --}}
                                    <td class="text-muted">
                                        {{ $no++ }}
                                    </td>


                                    {{-- NAMA AREA --}}
                                    <td>

                                        <span class="fw-medium">
                                            {{ $item->nama_area }}
                                        </span>

                                    </td>


                                    {{-- KAPASITAS --}}
                                    <td>

                                        <span class="badge bg-secondary-subtle text-secondary">
                                            {{ $item->kapasitas }} Slot
                                        </span>

                                    </td>


                                    {{-- TERISI --}}
                                    <td>

                                        @if ($item->terisi >= $item->kapasitas && $item->kapasitas > 0)

                                            <span class="badge bg-danger-subtle text-danger">
                                                Penuh
                                            </span>

                                        @elseif ($item->terisi > 0)

                                            <span class="badge bg-warning-subtle text-warning">
                                                {{ $item->terisi }} Kendaraan
                                            </span>

                                        @else

                                            <span class="badge bg-success-subtle text-success">
                                                Kosong
                                            </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="text-end">

                                        <div class="d-inline-flex gap-2">

                                            <a
                                                href="{{ route('area.edit', ['id' => $item->id_area]) }}"
                                                class="btn btn-sm btn-outline-brand"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                method="POST"
                                                action="{{ route('area.destroy', ['id' => $item->id_area]) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus area ini?')"
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
                                    colspan="5"
                                    class="text-center text-secondary py-4"
                                >
                                    Belum ada data area parkir.
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