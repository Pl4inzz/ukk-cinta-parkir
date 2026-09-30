@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Member Admin
        </span>

        <h1 class="h4 mb-0">
            Edit Member
        </h1>
    </div>

    <a
        href="{{ route('members.index') }}"
        class="btn btn-sm btn-outline-secondary"
    >
        &larr; Kembali
    </a>

</div>

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h2 class="h6 mb-3">
                    Edit Data Member
                </h2>

                <form
                    method="POST"
                    action="{{ route(
                        'members.update',
                        ['id' => $member->id_member]
                    ) }}"
                >

                    @csrf
                    @method('PUT')


                    <!-- Kode Member -->
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
                            value="{{ old(
                                'kode_member',
                                $member->kode_member
                            ) }}"
                            class="form-control {{ errors()->has('kode_member') ? 'is-invalid' : '' }}"
                        >

                        @error('kode_member')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- Nama -->
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
                            value="{{ old(
                                'nama',
                                $member->nama
                            ) }}"
                            class="form-control {{ errors()->has('nama') ? 'is-invalid' : '' }}"
                        >

                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- Pendaftar -->
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
                                value="{{ $member->user ? $member->user->nama_lengkap : '-' }}"
                                class="form-control"
                                readonly
                            >

                            <input
                                type="hidden"
                                name="id_user"
                                value="{{ $member->id_user }}"
                            >

                        </div>


                    <!-- Plat Nomor -->
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
                            value="{{ old(
                                'plat_nomor',
                                $member->plat_nomor
                            ) }}"
                            maxlength="15"
                            class="form-control {{ errors()->has('plat_nomor') ? 'is-invalid' : '' }}"
                        >

                        @error('plat_nomor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- Jenis Kendaraan -->
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
                                {{ old(
                                    'jenis_kendaraan',
                                    $member->jenis_kendaraan
                                ) === 'motor' ? 'selected' : '' }}
                            >
                                Motor
                            </option>

                            <option
                                value="mobil"
                                {{ old(
                                    'jenis_kendaraan',
                                    $member->jenis_kendaraan
                                ) === 'mobil' ? 'selected' : '' }}
                            >
                                Mobil
                            </option>

                            <option
                                value="lainnya"
                                {{ old(
                                    'jenis_kendaraan',
                                    $member->jenis_kendaraan
                                ) === 'lainnya' ? 'selected' : '' }}
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


                    <!-- No HP -->
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
                            value="{{ old(
                                'no_hp',
                                $member->no_hp
                            ) }}"
                            class="form-control {{ errors()->has('no_hp') ? 'is-invalid' : '' }}"
                        >

                        @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- Status -->
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="status_aktif"
                        >
                            Status
                        </label>

                        <select
                            id="status_aktif"
                            name="status_aktif"
                            class="form-select {{ errors()->has('status_aktif') ? 'is-invalid' : '' }}"
                        >

                            <option
                                value="aktif"
                                {{ old(
                                    'status_aktif',
                                    $member->status_aktif
                                ) === 'aktif' ? 'selected' : '' }}
                            >
                                Aktif
                            </option>

                            <option
                                value="nonaktif"
                                {{ old(
                                    'status_aktif',
                                    $member->status_aktif
                                ) === 'nonaktif' ? 'selected' : '' }}
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


                    <!-- Tanggal Kadaluarsa -->
                    <div class="mb-3">

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
                            value="{{ old(
                                'tanggal_kadaluarsa',
                                $member->tanggal_kadaluarsa
                            ) }}"
                            class="form-control {{ errors()->has('tanggal_kadaluarsa') ? 'is-invalid' : '' }}"
                        >

                        @error('tanggal_kadaluarsa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="d-flex gap-2">

                        <a
                            href="{{ route('members.index') }}"
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

    </div>

</div>

@endsection