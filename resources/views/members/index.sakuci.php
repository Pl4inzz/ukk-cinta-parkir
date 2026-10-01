@extends('layouts.app')

@section('title', 'Kelola Member')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Admin
        </span>

        <h1 class="h4 mb-1">
            Kelola Member
        </h1>

        <p class="text-muted mb-0">
            Kelola data member dan status keanggotaan parkir EZPark.
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

    {{-- FORM TAMBAH MEMBER --}}
    <div class="col-md-5">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <div>
                        <h2 class="h6 mb-1">
                            Tambah Member
                        </h2>

                        <small class="text-muted">
                            Daftarkan member baru
                        </small>
                    </div>

                    <span class="badge bg-warning-subtle text-warning">
                        Member
                    </span>

                </div>


                <form
                    method="POST"
                    action="{{ route('members.store') }}"
                >

                    @csrf


                    {{-- KODE MEMBER --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="kode_member"
                        >
                            Kode Member
                        </label>

                        <input
                            type="text"
                            id="kode_member"
                            name="kode_member"
                            value="{{ old('kode_member') }}"
                            placeholder="Contoh: MBR-001"
                            class="form-control {{ errors()->has('kode_member') ? 'is-invalid' : '' }}"
                        >

                        <small class="text-muted">
                            Gunakan kode unik untuk setiap member.
                        </small>

                        @error('kode_member')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- NAMA --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="nama"
                        >
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Contoh: Mikael Keyndradito"
                            class="form-control {{ errors()->has('nama') ? 'is-invalid' : '' }}"
                        >

                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- PENDAFTAR --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="id_user"
                        >
                            Pendaftar
                        </label>

                        <input
                            type="text"
                            id="id_user"
                            value="{{ $users ? $users->username : '-' }}"
                            class="form-control"
                            readonly
                        >

                        <input
                            type="hidden"
                            name="id_user"
                            value="{{ $users ? $users->id : '' }}"
                        >

                        <small class="text-muted">
                            Akun yang sedang digunakan untuk mendaftarkan member.
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
                            id="plat_nomor"
                            name="plat_nomor"
                            value="{{ old('plat_nomor') }}"
                            placeholder="Contoh: B 1234 ABC"
                            maxlength="15"
                            class="form-control {{ errors()->has('plat_nomor') ? 'is-invalid' : '' }}"
                        >

                        @error('plat_nomor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

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
                            id="jenis_kendaraan"
                            name="jenis_kendaraan"
                            class="form-select {{ errors()->has('jenis_kendaraan') ? 'is-invalid' : '' }}"
                        >

                            <option value="">
                                -- Pilih Jenis Kendaraan --
                            </option>

                            <option
                                value="motor"
                                {{ old('jenis_kendaraan') === 'motor' ? 'selected' : '' }}
                            >
                                Motor
                            </option>

                            <option
                                value="mobil"
                                {{ old('jenis_kendaraan') === 'mobil' ? 'selected' : '' }}
                            >
                                Mobil
                            </option>

                            <option
                                value="lainnya"
                                {{ old('jenis_kendaraan') === 'lainnya' ? 'selected' : '' }}
                            >
                                Lainnya
                            </option>

                        </select>

                        @error('jenis_kendaraan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- NO HP --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="no_hp"
                        >
                            No. HP
                        </label>

                        <input
                            type="text"
                            id="no_hp"
                            name="no_hp"
                            value="{{ old('no_hp') }}"
                            placeholder="Contoh: 081234567890"
                            class="form-control {{ errors()->has('no_hp') ? 'is-invalid' : '' }}"
                        >

                        @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- STATUS --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="status_aktif"
                        >
                            Status Member
                        </label>

                        <select
                            id="status_aktif"
                            name="status_aktif"
                            class="form-select {{ errors()->has('status_aktif') ? 'is-invalid' : '' }}"
                        >

                            <option
                                value="aktif"
                                {{ old('status_aktif', 'aktif') === 'aktif' ? 'selected' : '' }}
                            >
                                Aktif
                            </option>

                            <option
                                value="nonaktif"
                                {{ old('status_aktif') === 'nonaktif' ? 'selected' : '' }}
                            >
                                Nonaktif
                            </option>

                        </select>

                        @error('status_aktif')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- TANGGAL KADALUARSA --}}
                    <div class="mb-4">

                        <label
                            class="form-label"
                            for="tanggal_kadaluarsa"
                        >
                            Tanggal Kadaluarsa
                        </label>

                        <input
                            type="date"
                            id="tanggal_kadaluarsa"
                            name="tanggal_kadaluarsa"
                            value="{{ old('tanggal_kadaluarsa') }}"
                            class="form-control {{ errors()->has('tanggal_kadaluarsa') ? 'is-invalid' : '' }}"
                        >

                        <small class="text-muted">
                            Tanggal berakhirnya masa keanggotaan.
                        </small>

                        @error('tanggal_kadaluarsa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- BUTTON --}}
                    <button
                        class="btn btn-brand w-100"
                        type="submit"
                    >
                        + Tambah Member
                    </button>

                </form>

            </div>

        </div>


        {{-- INFO MEMBER --}}
        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body p-4">

                <h2 class="h6 mb-3">
                    Keuntungan Member
                </h2>

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Diskon Parkir 20%
                    </strong>

                    <small class="text-muted">
                        Member mendapatkan potongan 20% dari biaya normal
                        saat melakukan transaksi parkir.
                    </small>

                </div>

            </div>

        </div>

    </div>


    {{-- DAFTAR MEMBER --}}
    <div class="col-md-7">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <div>
                        <h2 class="h6 mb-1">
                            Daftar Member
                        </h2>

                        <small class="text-muted">
                            Member yang terdaftar pada sistem
                        </small>
                    </div>

                    <span class="badge rounded-pill badge-brand">
                        {{ isset($members) ? count($members) : 0 }} Member
                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>
                                <th width="45">#</th>
                                <th>Member</th>
                                <th>Pendaftar</th>
                                <th>Kendaraan</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>

                        </thead>


                        <tbody>

                        @if (isset($members) && count($members) > 0)

                            @php
                                $no = 1;
                            @endphp

                            @foreach ($members as $item)

                                <tr>

                                    {{-- NOMOR --}}
                                    <td class="text-muted">
                                        {{ $no++ }}
                                    </td>


                                    {{-- MEMBER --}}
                                    <td>

                                        <span class="fw-medium d-block">
                                            {{ $item->nama }}
                                        </span>

                                        <small class="text-secondary">
                                            {{ $item->kode_member }}
                                        </small>

                                    </td>


                                    {{-- PENDAFTAR --}}
                                    <td>

                                        @if ($item->user)

                                            {{ $item->user->username }}

                                        @else

                                            <span class="text-secondary">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- KENDARAAN --}}
                                    <td>

                                        <span class="fw-medium d-block">
                                            {{ $item->plat_nomor }}
                                        </span>

                                        <span class="badge bg-secondary-subtle text-secondary">
                                            {{ ucfirst($item->jenis_kendaraan) }}
                                        </span>

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if ($item->status_aktif === 'aktif')

                                            <span class="badge bg-success-subtle text-success">
                                                Aktif
                                            </span>

                                        @else

                                            <span class="badge bg-danger-subtle text-danger">
                                                Nonaktif
                                            </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="text-end">

                                        <div class="d-inline-flex gap-2">

                                            <a
                                                href="{{ route('members.edit', ['id' => $item->id_member]) }}"
                                                class="btn btn-sm btn-outline-brand"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                method="POST"
                                                action="{{ route('members.destroy', ['id' => $item->id_member]) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus member ini?')"
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
                                    colspan="6"
                                    class="text-center text-secondary py-4"
                                >
                                    Belum ada data member.
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