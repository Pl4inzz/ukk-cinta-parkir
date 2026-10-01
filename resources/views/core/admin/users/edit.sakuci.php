@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">

    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Area Admin
        </span>

        <h1 class="h4 mb-1">
            Edit User
        </h1>

        <p class="text-muted mb-0">
            Perbarui informasi akun pengguna EZPark.
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
                            Form Edit User
                        </h2>

                        <small class="text-muted">
                            Akun: {{ $user->username }}
                        </small>
                    </div>

                    @if ($user->role === 'owner')

                        <span class="badge bg-primary-subtle text-primary">
                            OWNER
                        </span>

                    @elseif ($user->role === 'admin')

                        <span class="badge bg-success-subtle text-success">
                            ADMIN
                        </span>

                    @elseif ($user->role === 'petugas')

                        <span class="badge bg-secondary-subtle text-secondary">
                            PETUGAS
                        </span>

                    @else

                        <span class="badge bg-light text-dark">
                            {{ strtoupper($user->role) }}
                        </span>

                    @endif

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.users.update', ['id' => $user->id]) }}"
                >

                    @csrf
                    @method('PUT')


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
                            value="{{ old('username', $user->username) }}"
                            placeholder="Masukkan username"
                            class="form-control {{ errors()->has('username') ? 'is-invalid' : '' }}"
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
                            class="form-label"
                            for="nama_lengkap"
                        >
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            id="nama_lengkap"
                            name="nama_lengkap"
                            value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                            placeholder="Masukkan nama lengkap"
                            class="form-control {{ errors()->has('nama_lengkap') ? 'is-invalid' : '' }}"
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
                            Password Baru
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password baru"
                            class="form-control {{ errors()->has('password') ? 'is-invalid' : '' }}"
                        >

                        <small class="text-muted">
                            Kosongkan jika password tidak ingin diubah.
                        </small>

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
                                value="{{ ucfirst($user->role) }}"
                                readonly
                            >

                        </div>

                        <input
                            type="hidden"
                            name="role"
                            value="{{ $user->role }}"
                        >

                        <small class="text-muted">
                            Role pengguna ditentukan oleh sistem.
                        </small>

                    </div>


                    {{-- TOMBOL --}}
                    <div class="d-flex gap-2">

                        <a
                            href="{{ route('admin.users.index') }}"
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
                    Informasi
                </h2>

                <div class="p-3 rounded-3 bg-body-tertiary">

                    <div class="d-flex align-items-start gap-3">

                        <span class="fs-4">
                            🔐
                        </span>

                        <div>

                            <strong class="d-block mb-1">
                                Keamanan Password
                            </strong>

                            <small class="text-muted">
                                Password lama tidak perlu dimasukkan.
                                Isi Password Baru hanya jika ingin menggantinya.
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection