@php
    $dbConnected = false;
    try {
        \Sakuci\Database\Connection::pdo();
        $dbConnected = true;
    } catch (\Throwable $e) {
        $dbConnected = false;
    }
    $currentUser = \App\Models\User::current();
@endphp

<!-- ===================== TOPBAR MOBILE (hanya tampil < lg) ===================== -->
<nav class="navbar d-lg-none border-bottom bg-body px-2 sticky-top">
    <div class="container-fluid justify-content-start flex-nowrap">
        <button class="btn border-0 d-inline-flex align-items-center justify-content-center flex-shrink-0" type="button"
                style="width: 44px; height: 44px;"
                data-bs-toggle="offcanvas" data-bs-target="#ezparkSidebar"
                aria-controls="ezparkSidebar" aria-label="Buka menu">
            <svg width="24" height="24" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>
        <a href="{{ route('home') }}" class="navbar-brand fw-bold fs-5 mb-0 text-body text-decoration-none ms-2">
            EZPark
        </a>
        <button id="themeToggleMobile" type="button"
                class="logo-toggle border-0 bg-transparent p-0 d-inline-flex align-items-center justify-content-center flex-shrink-0 ms-auto"
                style="width: 44px; height: 44px;"
                aria-label="Ganti tema terang/gelap" title="Ganti tema terang/gelap"
                onclick="document.getElementById('themeToggle').click()">
            <svg width="28" height="28" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" style="display: block;" aria-hidden="true">
                    <circle class="logo-ring" cx="16" cy="16" r="15"/>
                    <circle cx="16" cy="16" r="9" fill="{{ $dbConnected ? '#28a745' : '#dc3545' }}"/>
                </svg>
        </button>
    </div>
</nav>

<!-- ===================== SIDEBAR / OFFCANVAS ===================== -->
<div class="offcanvas-lg offcanvas-start bg-body border-end"
     tabindex="-1"
     id="ezparkSidebar"
     aria-labelledby="ezparkSidebarLabel"
     style="width: 260px; max-width: calc(100vw - 48px);">

    <!-- Header offcanvas, hanya tampil di mobile -->
    <div class="offcanvas-header d-lg-none border-bottom">
        <h5 class="offcanvas-title fw-bold" id="ezparkSidebarLabel">EZPark</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#ezparkSidebar" aria-label="Tutup"></button>
    </div>

    <aside class="offcanvas-body d-flex flex-column flex-shrink-0 p-3 vh-lg-100 position-lg-sticky top-0">

        <!-- Brand / Logo Header (hanya tampil di desktop, di mobile sudah ada di topbar) -->
        <div class="d-none d-lg-flex align-items-center gap-2 mb-3 border-bottom pb-3 w-100">
            <button id="themeToggle" type="button" class="logo-toggle border-0 bg-transparent p-0"
                    aria-label="Ganti tema terang/gelap (status database: {{ $dbConnected ? 'terhubung' : 'tidak terhubung' }})"
                    title="Ganti tema terang/gelap">
                <svg width="28" height="28" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" style="display: block;" aria-hidden="true">
                    <circle class="logo-ring" cx="16" cy="16" r="15"/>
                    <circle cx="16" cy="16" r="9" fill="{{ $dbConnected ? '#28a745' : '#dc3545' }}"/>
                </svg>
            </button>
            <a href="{{ route('home') }}" class="navbar-brand fw-bold fs-5 mb-0 text-body text-decoration-none">
                EZPark
            </a>
        </div>

        <!-- Navigation Menu Group -->
        <ul class="nav nav-pills flex-column mb-auto gap-1">
            <!-- Menu Umum / Publik -->
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link rounded-3 {{ is_route('home') ? 'btn-brand text-white fw-semibold' : 'text-body' }}">
                    Beranda
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('docs') }}" class="nav-link rounded-3 {{ is_route('docs') ? 'btn-brand text-white fw-semibold' : 'text-body' }}">
                    Docs
                </a>
            </li>

            @if ($currentUser)
                <hr class="my-2 border-secondary">
                <div class="px-3 text-secondary text-uppercase fs-7 fw-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">MENU {{ strtoupper($currentUser->role) }}</div>

                <!-- Menu Khusus Admin -->
                @if ($currentUser->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link rounded-3 {{ is_route('admin.dashboard') ? 'btn-brand text-white fw-semibold' : 'text-body' }}">
                            Dashboard Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link rounded-3 {{ is_route('admin.users.index') ? 'btn-brand text-white fw-semibold' : 'text-body' }}">
                            Kelola User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.tarif.index') }}" class="nav-link rounded-3 {{ is_route('admin.tarif.index') ? 'btn-brand text-white fw-semibold' : 'text-body' }}">
                            Tarif Parkir
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('area.index') }}" class="nav-link rounded-3 {{ is_route('area.index') ? 'btn-brand text-white fw-semibold' : 'text-body' }}">
                            Area Parkir
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('members.index') }}" class="nav-link rounded-3 {{ is_route('members.index') ? 'btn-brand text-white fw-semibold' : 'text-body' }}">
                            Data Member
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logAktivitas.index') }}" class="nav-link rounded-3 {{ is_route('logAktivitas.index') ? 'btn-brand text-white fw-semibold' : 'text-body' }}">
                            Log Aktivitas
                        </a>
                    </li>

                <!-- Menu Khusus Petugas -->
                @elseif ($currentUser->role === 'petugas')
                    <li class="nav-item">
                        <a href="{{ route('petugas.dashboard') }}" class="nav-link rounded-3 {{ is_route('petugas.dashboard') ? 'btn-brand text-white fw-semibold' : 'text-body' }} ">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('petugas.transaksi.index') }}" class="nav-link rounded-3 {{ is_route('petugas.transaksi.index') ? 'btn-brand text-white fw-semibold' : 'text-body' }}" class="nav-link rounded-3 ">
                            Transaksi Parkir
                        </a>
                    </li>

                <!-- Menu Khusus Owner -->
                @elseif ($currentUser->role === 'owner')
                    <li class="nav-item">
                        <a href="{{ route('owner.rekap') }}" class="nav-link rounded-3 {{ is_route('owner.rekap') ? 'btn-brand text-white fw-semibold' : 'text-body' }}">
                            Rekap Laporan
                        </a>
                    </li>
                @endif

            @else
                <!-- Menu jika belum Login -->
                <hr class="my-2 border-secondary">
                @php
                    $canRegister = false;
                    if ($dbConnected) {
                        try {
                            $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                        } catch (\Throwable $e) {
                            $canRegister = false;
                        }
                    }
                @endphp
                @if ($canRegister)
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link rounded-3 {{ is_route('register') ? 'btn-brand text-white fw-semibold' : 'text-body' }}">
                            Daftar
                        </a>
                    </li>
                @endif
                <li class="nav-item mt-2">
                    <a class="btn btn-brand rounded-pill w-100 d-inline-flex align-items-center justify-content-center gap-2" href="{{ route('login') }}">
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="8" cy="5" r="3" fill="currentColor" stroke="none"/>
                            <path d="M2.5 14c0-3.6 2.9-5.8 5.5-5.8s5.5 2.2 5.5 5.8"/>
                        </svg>
                        Masuk
                    </a>
                </li>
            @endif
        </ul>

        <!-- Footer Profile Section -->
        @if ($currentUser)
            <div class="border-top pt-3 mt-auto border-secondary">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2 overflow-hidden">
                        <div class="btn-brand text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-weight: 600;">
                            {{ strtoupper(substr($currentUser->username, 0, 1)) }}
                        </div>
                        <div class="lh-1 text-truncate">
                            <strong class="d-block text-truncate fs-6 text-body">{{ $currentUser->username }}</strong>
                            <small class="text-secondary text-capitalize" style="font-size: 0.75rem;">{{ $currentUser->role }}</small>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm text-danger border-0 p-1" title="Logout">
                            <svg width="18" height="18" viewBox="0 0 16 16" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </aside>
</div>