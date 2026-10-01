@extends('layouts.app')

@section('title', 'Edit Tarif Parkir')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Admin
        </span>

        <h1 class="h4 mb-1">
            Edit Tarif Parkir
        </h1>

        <p class="text-muted mb-0">
            Perbarui jenis kendaraan dan tarif parkir yang digunakan sistem.
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
                            Form Edit Tarif
                        </h2>

                        <small class="text-muted">
                            Tarif #{{ $tarif->id_tarif }}
                        </small>
                    </div>

                    <span class="badge bg-success-subtle text-success">
                        Tarif Parkir
                    </span>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.tarif.update', ['id' => $tarif->id_tarif]) }}"
                >

                    @csrf
                    @method('PUT')


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
                            value="{{ old('jenis_kendaraan', $tarif->jenis_kendaraan) }}"
                            placeholder="Contoh: motor, mobil, truk"
                            class="form-control {{ errors()->has('jenis_kendaraan') ? 'is-invalid' : '' }}"
                        >

                        <small class="text-muted">
                            Masukkan jenis kendaraan sesuai tarif yang berlaku.
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
                                value="{{ old('tarif_per_jam', $tarif->tarif_per_jam) }}"
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


                    {{-- TOMBOL --}}
                    <div class="d-flex gap-2">

                        <a
                            href="{{ route('admin.tarif.index') }}"
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
                    Informasi Tarif
                </h2>

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Perhitungan Parkir
                    </strong>

                    <small class="text-muted">
                        Tarif ini digunakan sebagai dasar perhitungan
                        biaya parkir berdasarkan durasi kendaraan.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection