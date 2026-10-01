@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Admin
        </span>

        <h1 class="h4 mb-1">
            Edit Member
        </h1>

        <p class="text-muted mb-0">
            Perbarui data dan status keanggotaan member EZPark.
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
                            Form Edit Member
                        </h2>

                        <small class="text-muted">
                            Member #{{ $member->id_member }}
                        </small>
                    </div>

                    @if ($member->status_aktif === 'aktif')

                        <span class="badge bg-success-subtle text-success">
                            Aktif
                        </span>

                    @else

                        <span class="badge bg-danger-subtle text-danger">
                            Nonaktif
                        </span>

                    @endif

                </div>


                <form
                    method="POST"
                    action="{{ route('members.update', ['id' => $member->id_member]) }}"
                >

                    @csrf
                    @method('PUT')


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
                            value="{{ old('kode_member', $member->kode_member) }}"
                            placeholder="Contoh: MBR-001"
                            class="form-control {{ errors()->has('kode_member') ? 'is-invalid' : '' }}"
                        >

                        <small class="text-muted">
                            Kode member harus unik.
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
                            value="{{ old('nama', $member->nama) }}"
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
                            value="{{ $member->user ? $member->user->nama_lengkap : '-' }}"
                            class="form-control"
                            readonly
                        >

                        <input
                            type="hidden"
                            name="id_user"
                            value="{{ $member->id_user }}"
                        >

                        <small class="text-muted">
                            Akun pendaftar tidak diubah melalui form ini.
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
                            value="{{ old('plat_nomor', $member->plat_nomor) }}"
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
                                {{ old('jenis_kendaraan', $member->jenis_kendaraan) === 'motor' ? 'selected' : '' }}
                            >
                                Motor
                            </option>

                            <option
                                value="mobil"
                                {{ old('jenis_kendaraan', $member->jenis_kendaraan) === 'mobil' ? 'selected' : '' }}
                            >
                                Mobil
                            </option>

                            <option
                                value="lainnya"
                                {{ old('jenis_kendaraan', $member->jenis_kendaraan) === 'lainnya' ? 'selected' : '' }}
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
                            value="{{ old('no_hp', $member->no_hp) }}"
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
                                {{ old('status_aktif', $member->status_aktif) === 'aktif' ? 'selected' : '' }}
                            >
                                Aktif
                            </option>

                            <option
                                value="nonaktif"
                                {{ old('status_aktif', $member->status_aktif) === 'nonaktif' ? 'selected' : '' }}
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
                            value="{{ old('tanggal_kadaluarsa', $member->tanggal_kadaluarsa) }}"
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


        {{-- INFO --}}
        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body p-4">

                <h2 class="h6 mb-3">
                    Informasi Member
                </h2>

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Diskon Member 20%
                    </strong>

                    <small class="text-muted">
                        Member mendapatkan potongan 20% dari biaya normal
                        pada transaksi parkir.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection