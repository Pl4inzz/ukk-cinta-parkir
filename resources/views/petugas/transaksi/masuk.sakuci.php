@extends('layouts.app')

@section('title', 'Input Parkir Masuk')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Petugas
        </span>

        <h1 class="h4 mb-1">
            Input Kendaraan Masuk
        </h1>

        <small class="text-muted">
            Catat kendaraan yang masuk ke area parkir.
        </small>
    </div>

</div>


<div class="card border-0 shadow-sm col-md-7 mx-auto">

    <div class="card-body p-4">

        <h2 class="h6 mb-4">
            Data Parkir Masuk
        </h2>


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
                    Pilih Member
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
                    Untuk member, plat nomor mengikuti data member.
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
                    Jenis kendaraan mengikuti data tarif.
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

                        <option value="{{ $a->id_area }}">

                            {{ $a->nama_area }}

                            ({{ $a->terisi }}/{{ $a->kapasitas }})

                        </option>

                    @endforeach

                </select>

                <small class="text-muted">
                    Angka menunjukkan jumlah terisi dari kapasitas area.
                </small>

            </div>


            {{-- BUTTON --}}
            <div class="d-flex gap-2">

                <a
                    href="{{ route('petugas.transaksi.index') }}"
                    class="btn btn-outline-secondary flex-fill"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-success flex-fill"
                >
                    Simpan & Cetak Tiket
                </button>

            </div>

        </form>

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