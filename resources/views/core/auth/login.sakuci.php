@extends('layouts.app')

@section('title', 'Masuk - ' . config('app.name'))

@section('content')

    {{-- Tombol Kembali --}}
    <div class="mb-3">
        <a href="/" class="btn btn-sm btn-link text-decoration-none text-secondary p-0 d-inline-flex align-items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <div class="card border-0 shadow-sm p-2 p-sm-3">
        <div class="card-body p-4">
            
            {{-- Header & Branding --}}
            <div class="text-center mb-4">
                <div class="brand-mark mx-auto mb-2" style="width: 44px; height: 44px; font-size: 20px;">P</div>
                <h1 class="h4 fw-bold mb-1">Masuk ke Sistem</h1>
                <p class="text-secondary small mb-0">Sistem Manajemen Parkir Sakuci</p>
            </div>

            {{-- Alert Informasi Akun Demo --}}
            <div class="alert alert-brand border-0 bg-brand-subtle small mb-4 py-2 px-3 text-center">
                <span class="text-brand">Akun demo:</span> <strong>admin</strong> &mdash; password <code class="inline">rahasia123</code>
            </div>

            {{-- Form Login --}}
            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label small fw-medium" for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control {{ errors()->has('username') ? 'is-invalid' : '' }}" autofocus placeholder="Masukkan username">
                    @error('username') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-medium" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control {{ errors()->has('password') ? 'is-invalid' : '' }}" placeholder="••••••••">
                    @error('password') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <button class="btn btn-brand w-100 py-2 fw-semibold" type="submit">
                    Masuk Sekarang
                </button>
            </form>

            {{-- Opsi Pendaftaran --}}
            @php
                $canRegister = false;
                try {
                    $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                } catch (\Throwable $e) {
                    $canRegister = false;
                }
            @endphp

            @if ($canRegister)
                <div class="text-center mt-4 pt-3 border-top">
                    <p class="text-secondary small mb-0">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-brand fw-semibold text-decoration-none">Daftar di sini</a>.
                    </p>
                </div>
            @endif

        </div>
    </div>

    {{-- Footer Copyright --}}
    <div class="text-center mt-4">
        <span class="text-secondary small">&copy; {{ date('Y') }} Sakuci Parking System</span>
    </div>

@endsection