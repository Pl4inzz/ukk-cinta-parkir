@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">Area Admin</span>
            <h1 class="h4 mb-0">Edit User</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h6 mb-3">Form Edit User</h2>

                    <form method="POST" action="{{ route('admin.users.update', ['id' => $user->id]) }}">
                        @csrf
                        @method('PUT')

                        <!-- Username -->
                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" 
                                   id="username" 
                                   name="username" 
                                   value="{{ old('username', $user->username) }}" 
                                   placeholder="Masukkan username" 
                                   class="form-control {{ errors()->has('username') ? 'is-invalid' : '' }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" 
                                   id="nama_lengkap" 
                                   name="nama_lengkap" 
                                   value="{{ old('nama_lengkap', $user->nama_lengkap) }}" 
                                   placeholder="Masukkan nama lengkap" 
                                   class="form-control {{ errors()->has('nama_lengkap') ? 'is-invalid' : '' }}">
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password (Opsional) -->
                        <div class="mb-3">
                            <label class="form-label" for="password">Password <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></label>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Masukkan password baru" 
                                   class="form-control {{ errors()->has('password') ? 'is-invalid' : '' }}">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

<!-- Role -->
<div class="mb-3">
    <label class="form-label" for="role">Role</label>

    <input
        type="text"
        class="form-control"
        value="{{ ucfirst($user->role) }}"
        readonly
    >

    <input
        type="hidden"
        name="role"
        value="{{ $user->role }}"
    >
</div>

<!-- Perubahan ini diubah oleh Hasan Asykari XII RPL 1, absen sekian, SMK Sangkuriang 1 Cimahi, Jl. Cibatu Cikupa, Ngamprah, Bandung Barat, @levtofer. --!>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary w-50">Batal</a>
                            <button class="btn btn-brand w-50" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection