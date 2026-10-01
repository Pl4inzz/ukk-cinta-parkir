@extends('layouts.app')

@section('title', 'Manage Member')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Member Admin
        </span>

        <h1 class="h4 mb-0">
            Manage Member
        </h1>
    </div>

    <a
        href="{{ route('admin.dashboard') }}"
        class="btn btn-sm btn-outline-secondary"
    >
        &larr; Kembali
    </a>
</div>ww
<div class="row g-4">

    <!-- Form Tambah Member -->
    <div class="col-md-5">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h2 class="h6 mb-3">
                    Tambah Member
                </h2>

                <form
                    method="POST"
                    action="{{ route('members.store') }}"
                >

                    @csrf


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
                            value="{{ old('kode_member') }}"
                            placeholder="Contoh: MBR-001"
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
                            value="{{ $users ? $users->username  : '-' }}"
                            class="form-control"
                            readonly
                        >

                        <input
                            type="hidden"
                            name="id_user"
                            value="{{ $users ? $users->id : '' }}"
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
                            value="{{ old('tanggal_kadaluarsa') }}"
                            class="form-control {{ errors()->has('tanggal_kadaluarsa') ? 'is-invalid' : '' }}"
                        >

                        @error('tanggal_kadaluarsa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <button
                        class="btn btn-brand w-100"
                        type="submit"
                    >
                        Tambah Member
                    </button>

                </form>

            </div>

        </div>

    </div>


    <!-- Tabel Daftar Member -->
    <div class="col-md-7">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h2 class="h6 mb-3">
                    Daftar Member
                </h2>

                <table class="table table-sm align-middle mb-0">

                    <thead>

                        <tr>
                            <th>#</th>
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

                                    <td>
                                        {{ $no++ }}
                                    </td>

                                    <td>

                                        <span class="fw-medium d-block">
                                            {{ $item->nama }}
                                        </span>

                                        <small class="text-secondary">
                                            {{ $item->kode_member }}
                                        </small>

                                    </td>

                                    <td>
                                        @if ($item->user)
                                            {{ $item->user->username }}
                                        @else
                                            <span class="text-secondary">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>

                                        <span class="fw-medium d-block">
                                            {{ $item->plat_nomor }}
                                        </span>

                                        <span class="badge bg-secondary-subtle text-secondary">
                                            {{ ucfirst($item->jenis_kendaraan) }}
                                        </span>

                                    </td>

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

                                    <td class="text-end">

                                        <div class="d-inline-flex gap-2">

                                            <a
                                                href="{{ route(
                                                    'members.edit',
                                                    ['id' => $item->id_member]
                                                ) }}"
                                                class="btn btn-sm btn-outline-brand"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'members.destroy',
                                                    ['id' => $item->id_member]
                                                ) }}"
                                                class="d-inline"
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
                                    class="text-secondary text-center py-3"
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

@endsection