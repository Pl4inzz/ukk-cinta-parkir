@extends('layouts.app')

@section('title', 'Input Parkir Masuk')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Petugas
        </span>

        <h1 class="h4 mb-1">
            Input Kendaraan Masuk
        </h1>

        <p class="text-muted mb-0">
            Catat kendaraan yang masuk ke area parkir EZPark.
        </p>
    </div>

</div>


<div class="row justify-content-center">

    <div class="col-md-8 col-lg-7">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-4">

                    <div>
                        <h2 class="h6 mb-1">
                            Data Parkir Masuk
                        </h2>

                        <small class="text-muted">
                            Isi data kendaraan sebelum mencetak tiket.
                        </small>
                    </div>

                    <span class="badge bg-success-subtle text-success">
                        Kendaraan Masuk
                    </span>

                </div>


                <form
                    method="POST"
                    action="{{ route('petugas.transaksi.storeMasuk') }}"
                >

                    @csrf


                    {{-- MEMBER --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="id_member"
                        >
                            Member
                            <small class="text-muted">
                                (Opsional)
                            </small>
                        </label>

                        <select
                            name="id_member"
                            id="id_member"
                            class="form-select"
                        >

                            <option value="">
                                -- Non-Member / Umum --
                            </option>

                            @foreach($members as $m)

                                <option
                                    value="{{ $m->id_member }}"
                                    data-plat="{{ $m->plat_nomor }}"
                                    data-jenis="{{ $m->jenis_kendaraan }}"
                                >

                                    {{ $m->kode_member }}
                                    -
                                    {{ $m->nama }}
                                    ({{ $m->plat_nomor }})

                                </option>

                            @endforeach

                        </select>

                        <small class="text-muted">
                            Pilih member jika kendaraan sudah terdaftar.
                            Member mendapatkan diskon 20% saat pembayaran.
                        </small>

                    </div>


                    {{-- PLAT NOMOR --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="plat_nomor"
                        >
                            Plat Nomor
                        </label>

                        <input
                            type="text"
                            name="plat_nomor"
                            id="plat_nomor"
                            class="form-control"
                            maxlength="15"
                            placeholder="Contoh: B 1234 XYZ"
                            required
                        >

                        <small class="text-muted">
                            Untuk member, plat nomor akan mengikuti
                            data kendaraan member.
                        </small>

                    </div>


                    {{-- JENIS KENDARAAN --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="jenis_kendaraan"
                        >
                            Jenis Kendaraan
                        </label>

                        <select
                            name="jenis_kendaraan"
                            id="jenis_kendaraan"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Jenis Kendaraan --
                            </option>

                            @foreach($tarifs as $tarif)

                                <option
                                    value="{{ $tarif->jenis_kendaraan }}"
                                >
                                    {{ ucfirst($tarif->jenis_kendaraan) }}
                                </option>

                            @endforeach

                        </select>

                        <small class="text-muted">
                            Jenis kendaraan mengikuti jenis tarif
                            yang tersedia pada sistem.
                        </small>

                    </div>


                    {{-- AREA --}}
                    <div class="mb-4">

                        <label
                            class="form-label"
                            for="id_area"
                        >
                            Area Parkir
                        </label>

                        <select
                            name="id_area"
                            id="id_area"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Area --
                            </option>

                            @foreach($areas as $a)

                                <option
                                    value="{{ $a->id_area }}"
                                >

                                    {{ $a->nama_area }}
                                    ({{ $a->terisi }}/{{ $a->kapasitas }})

                                </option>

                            @endforeach

                        </select>

                        <small class="text-muted">
                            Angka menunjukkan jumlah kendaraan terisi
                            dibandingkan kapasitas area.
                        </small>

                    </div>


                    {{-- BUTTON --}}
                    <div class="d-flex gap-2">

                        <a
                            href="{{ route('petugas.transaksi.index') }}"
                            class="btn btn-outline-secondary w-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-brand w-50"
                        >
                            Simpan & Cetak Tiket
                        </button>

                    </div>

                </form>

            </div>

        </div>


        {{-- INFO ALUR --}}
        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body p-4">

                <h2 class="h6 mb-3">
                    Alur Parkir Masuk
                </h2>

                <div class="row g-3">

                    <div class="col-md-4">

                        <div class="p-3 rounded-3 bg-body-tertiary">

                            <strong class="d-block mb-1">
                                1. Pilih Member
                            </strong>

                            <small class="text-muted">
                                Pilih member jika kendaraan
                                sudah terdaftar.
                            </small>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="p-3 rounded-3 bg-body-tertiary">

                            <strong class="d-block mb-1">
                                2. Isi Kendaraan
                            </strong>

                            <small class="text-muted">
                                Masukkan plat dan pilih
                                jenis kendaraan.
                            </small>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="p-3 rounded-3 bg-body-tertiary">

                            <strong class="d-block mb-1">
                                3. Cetak Tiket
                            </strong>

                            <small class="text-muted">
                                Simpan transaksi dan
                                cetak tiket parkir.
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script>

document
    .getElementById('id_member')
    .addEventListener('change', function () {

        const selected =
            this.options[this.selectedIndex];

        const plat =
            selected.dataset.plat || '';

        const jenis =
            selected.dataset.jenis || '';

        const platInput =
            document.getElementById('plat_nomor');

        const jenisKendaraan =
            document.getElementById('jenis_kendaraan');


        if (plat) {

            platInput.value = plat;

            platInput.readOnly = true;

        } else {

            platInput.value = '';

            platInput.readOnly = false;

        }


        if (jenis) {

            jenisKendaraan.value = jenis;

        } else {

            jenisKendaraan.value = '';

        }

    });

</script>

@endsection