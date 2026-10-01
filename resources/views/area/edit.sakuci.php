@extends('layouts.app')

@section('title', 'Edit Area Parkir')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Admin
        </span>

        <h1 class="h4 mb-1">
            Edit Area Parkir
        </h1>

        <p class="text-muted mb-0">
            Perbarui nama dan kapasitas area parkir EZPark.
        </p>
    </div>

</div>


<div class="row justify-content-center">

    <div class="col-md-7 col-lg-6">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-4">

                    <div>
                        <h2 class="h6 mb-1">
                            Form Edit Area
                        </h2>

                        <small class="text-muted">
                            Area #{{ $area->id_area }}
                        </small>
                    </div>

                    <span class="badge bg-info-subtle text-info">
                        Area Parkir
                    </span>

                </div>


                <form
                    method="POST"
                    action="{{ route('area.update', ['id' => $area->id_area]) }}"
                >

                    @csrf
                    @method('PUT')


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
                            value="{{ old('nama_area', $area->nama_area) }}"
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
                                value="{{ old('kapasitas', $area->kapasitas) }}"
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


                    {{-- TOMBOL --}}
                    <div class="d-flex gap-2">

                        <a
                            href="{{ route('area.index') }}"
                            class="btn btn-outline-secondary w-50"
                        >
                            Batal
                        </a>

                        <button
                            class="btn btn-brand w-50"
                            type="submit"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

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
                        Kapasitas Area
                    </strong>

                    <small class="text-muted">
                        Kapasitas menunjukkan jumlah slot kendaraan
                        yang dapat ditampung oleh area parkir.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection