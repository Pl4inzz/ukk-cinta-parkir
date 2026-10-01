@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Admin
        </span>

        <h1 class="h4 mb-1">
            Kelola User
        </h1>

        <p class="text-muted mb-0">
            Kelola akun pengguna yang digunakan untuk mengakses sistem EZPark.
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

    {{-- FORM TAMBAH USER --}}
    <div class="col-md-5">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <div>
                        <h2 class="h6 mb-1">
                            Tambah User
                        </h2>

                        <small class="text-muted">
                            Buat akun petugas baru
                        </small>
                    </div>

                    <span class="badge bg-success-subtle text-success">
                        Petugas
                    </span>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.users.store') }}"
                >

                    @csrf


                    {{-- USERNAME --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="username"
                        >
                            Username
                        </label>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username') }}"
                            class="form-control {{ errors()->has('username') ? 'is-invalid' : '' }}"
                            placeholder="Masukkan username"
                            autofocus
                        >

                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- NAMA LENGKAP --}}
                    <div class="mb-3">

                        <label
                            for="nama_lengkap"
                            class="form-label"
                        >
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="nama_lengkap"
                            id="nama_lengkap"
                            value="{{ old('nama_lengkap') }}"
                            class="form-control {{ errors()->has('nama_lengkap') ? 'is-invalid' : '' }}"
                            placeholder="Masukkan nama lengkap"
                            required
                        >

                        @error('nama_lengkap')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- PASSWORD --}}
                    <div class="mb-3">

                        <label
                            class="form-label"
                            for="password"
                        >
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control {{ errors()->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Masukkan password"
                        >

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- ROLE --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Role
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                👤
                            </span>

                            <input
                                type="text"
                                class="form-control"
                                value="Petugas"
                                readonly
                            >

                        </div>

                        <input
                            type="hidden"
                            name="role"
                            value="petugas"
                        >

                        <small class="text-muted">
                            User baru melalui menu ini akan dibuat sebagai Petugas.
                        </small>

                    </div>


                    {{-- BUTTON --}}
                    <button
                        class="btn btn-brand w-100"
                        type="submit"
                    >
                        + Tambah User
                    </button>

                </form>

            </div>

        </div>

    </div>


    {{-- DAFTAR USER --}}
    <div class="col-md-7">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <div>
                        <h2 class="h6 mb-1">
                            Daftar User
                        </h2>

                        <small class="text-muted">
                            Daftar akun pengguna EZPark
                        </small>
                    </div>

                    <span class="badge rounded-pill badge-brand">
                        {{ count($users) }} User
                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>
                                <th width="50">#</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Role</th>
                                <th width="150">Aksi</th>
                            </tr>

                        </thead>


                        <tbody>

                        @php
                            $no = 1;
                        @endphp

                        @forelse ($users as $item)

                            <tr>

                                {{-- NOMOR --}}
                                <td class="text-muted">
                                    {{ $no++ }}
                                </td>


                                {{-- USERNAME --}}
                                <td>

                                    <strong>
                                        {{ $item->username }}
                                    </strong>

                                </td>


                                {{-- NAMA --}}
                                <td>
                                    {{ $item->nama_lengkap ?? '-' }}
                                </td>


                                {{-- ROLE --}}
                                <td>

                                    @if ($item->role === 'owner')

                                        <span class="badge bg-primary-subtle text-primary">
                                            OWNER
                                        </span>

                                    @elseif ($item->role === 'admin')

                                        <span class="badge bg-success-subtle text-success">
                                            ADMIN
                                        </span>

                                    @elseif ($item->role === 'petugas')

                                        <span class="badge bg-secondary-subtle text-secondary">
                                            PETUGAS
                                        </span>

                                    @else

                                        <span class="badge bg-light text-dark">
                                            {{ strtoupper($item->role) }}
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td>

                                    <div class="d-flex gap-2">

                                        <a
                                            href="{{ route('core.admin.users.edit', ['id' => $item->id]) }}"
                                            class="btn btn-sm btn-outline-brand"
                                        >
                                            Edit
                                        </a>


                                        <form
                                            method="POST"
                                            action="{{ route('core.admin.users.destroy', ['id' => $item->id]) }}"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
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

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center text-secondary py-4"
                                >
                                    Belum ada user.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- INFO --}}
<div class="card border-0 shadow-sm mt-4">

    <div class="card-body p-4">

        <h2 class="h6 mb-3">
            Informasi Pengelolaan User
        </h2>

        <div class="row g-3">

            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Username
                    </strong>

                    <small class="text-muted">
                        Digunakan untuk login ke sistem EZPark.
                    </small>

                </div>

            </div>


            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Role
                    </strong>

                    <small class="text-muted">
                        Menentukan akses pengguna terhadap sistem.
                    </small>

                </div>

            </div>


            <div class="col-md-4">

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <strong class="d-block mb-1">
                        Petugas
                    </strong>

                    <small class="text-muted">
                        Bertugas mengelola transaksi kendaraan masuk dan keluar.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection