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

        <p class="text-secondary mb-0">
            Atur kategori kendaraan dan tarif parkir per jam.
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

    {{-- FORM TAMBAH --}}
    <div class="col-md-5">

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <h2 class="h6 mb-3">
                    Tambah Tarif Parkir
                </h2>

                <form
                    method="POST"
                    action="{{ route('admin.tarif.store') }}"
                >

                    @csrf

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

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            <option
                                value="kecil"
                                {{ old('jenis_kendaraan') === 'kecil' ? 'selected' : '' }}
                            >
                                Kecil
                            </option>

                            <option
                                value="sedang"
                                {{ old('jenis_kendaraan') === 'sedang' ? 'selected' : '' }}
                            >
                                Sedang
                            </option>

                            <option
                                value="besar"
                                {{ old('jenis_kendaraan') === 'besar' ? 'selected' : '' }}
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


                    <div class="mb-3">

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
                            value="{{ old('tarif_per_jam') }}"
                            placeholder="Contoh: 2000"
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


                    <button
                        class="btn btn-brand w-100"
                        type="submit"
                    >
                        Tambah Tarif
                    </button>

                </form>

            </div>
        </div>


        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-4">

                <h2 class="h6 mb-2">
                    Kategori Kendaraan
                </h2>

                <div class="small text-secondary">

                    <div class="mb-2">
                        <strong>Kecil</strong>
                        — kendaraan kecil seperti motor.
                    </div>

                    <div class="mb-2">
                        <strong>Sedang</strong>
                        — kendaraan sedang seperti mobil.
                    </div>

                    <div>
                        <strong>Besar</strong>
                        — kendaraan besar seperti truk/bus.
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- DAFTAR TARIF --}}
    <div class="col-md-7">

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h2 class="h6 mb-0">
                        Daftar Tarif Parkir
                    </h2>

                    <span class="badge bg-secondary-subtle text-secondary">
                        {{ count($tarifList) }} Tarif
                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table table-sm align-middle mb-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori</th>
                                <th>Tarif / Jam</th>
                                <th>Transaksi</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @if (count($tarifList) > 0)

                                <?php $no = 1; ?>

                                @foreach ($tarifList as $item)

                                    <tr>

                                        <td>
                                            {{ $no++ }}
                                        </td>


                                        <td>

                                            @if ($item->jenis_kendaraan === 'kecil')

                                                <span class="badge bg-success-subtle text-success">
                                                    Kecil
                                                </span>

                                            @elseif ($item->jenis_kendaraan === 'sedang')

                                                <span class="badge bg-warning-subtle text-warning">
                                                    Sedang
                                                </span>

                                            @else

                                                <span class="badge bg-danger-subtle text-danger">
                                                    Besar
                                                </span>

                                            @endif

                                        </td>


                                        <td>
                                            <strong>
                                                Rp {{ number_format($item->tarif_per_jam, 0, ',', '.') }}
                                            </strong>
                                        </td>


                                        <td>

                                            <span class="badge bg-secondary-subtle text-secondary">
                                                {{ $jumlahTransaksi[$item->id_tarif] ?? 0 }}
                                                transaksi
                                            </span>

                                        </td>


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
                                                    class="d-inline"
                                                    onsubmit="return confirm('PERINGATAN!\\n\\nMenghapus tarif {{ ucfirst($item->jenis_kendaraan) }} akan sekaligus menghapus {{ $jumlahTransaksi[$item->id_tarif] ?? 0 }} transaksi yang menggunakan tarif ini.\\n\\nData yang sudah dihapus tidak dapat dikembalikan.\\n\\nApakah Anda yakin ingin melanjutkan?')"
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
                                        class="text-secondary text-center py-4"
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


        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body p-4">

                <h2 class="h6 mb-2">
                    Catatan Penghapusan
                </h2>

                <p class="small text-secondary mb-0">
                    Jika tarif dihapus, seluruh transaksi yang menggunakan
                    tarif tersebut juga akan dihapus. Transaksi parkir aktif
                    juga akan dikeluarkan dari perhitungan kapasitas area.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection