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

        <p class="text-secondary mb-0">
            Perbarui kategori dan tarif parkir.
        </p>

    </div>

</div>


<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h2 class="h6 mb-3">
                    Form Edit Tarif
                </h2>


                <form
                    method="POST"
                    action="{{ route('admin.tarif.update', ['id' => $tarif->id_tarif]) }}"
                >

                    @csrf
                    @method('PUT')


                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="jenis_kendaraan"
                        >
                            Kategori Kendaraan
                        </label>

                        <select
                            id="jenis_kendaraan"
                            name="jenis_kendaraan"
                            class="form-select {{ errors()->has('jenis_kendaraan') ? 'is-invalid' : '' }}"
                            required
                        >

                            <option
                                value="kecil"
                                {{ old('jenis_kendaraan', $tarif->jenis_kendaraan) === 'kecil' ? 'selected' : '' }}
                            >
                                Kecil
                            </option>

                            <option
                                value="sedang"
                                {{ old('jenis_kendaraan', $tarif->jenis_kendaraan) === 'sedang' ? 'selected' : '' }}
                            >
                                Sedang
                            </option>

                            <option
                                value="besar"
                                {{ old('jenis_kendaraan', $tarif->jenis_kendaraan) === 'besar' ? 'selected' : '' }}
                            >
                                Besar
                            </option>

                        </select>

                        @error('jenis_kendaraan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="mb-4">

                        <label
                            class="form-label"
                            for="tarif_per_jam"
                        >
                            Tarif per Jam (Rp)
                        </label>

                        <input
                            type="number"
                            id="tarif_per_jam"
                            name="tarif_per_jam"
                            value="{{ old('tarif_per_jam', $tarif->tarif_per_jam) }}"
                            min="0"
                            step="1"
                            class="form-control {{ errors()->has('tarif_per_jam') ? 'is-invalid' : '' }}"
                            required
                        >

                        @error('tarif_per_jam')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


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


        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body p-4">

                <h2 class="h6 mb-2">
                    Informasi
                </h2>

                <p class="small text-secondary mb-0">
                    Mengubah tarif tidak menghapus transaksi yang sudah ada.
                    Transaksi tetap menggunakan ID tarif yang sama.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection