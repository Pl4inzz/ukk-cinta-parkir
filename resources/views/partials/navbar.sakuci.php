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

        <button type="button"
                class="logo-toggle border-0 bg-transparent p-0 d-inline-flex align-items-center justify-content-center flex-shrink-0 ms-auto"
                style="width: 44px; height: 44px;"
                aria-label="Ganti tema terang/gelap"
                title="Ganti tema terang/gelap"
                onclick="var t=document.getElementById('themeToggle'); if(t){t.click();}">
            <svg width="28"
                 height="28"
                 viewBox="0 0 32 32"
                 xmlns="http://www.w3.org/2000/svg"
                 style="display: block;"
                 aria-hidden="true">
                <circle class="logo-ring" cx="16" cy="16" r="15"/>
                <circle cx="16"
                        cy="16"
                        r="9"
                        fill="{{ $dbConnected ? '#28a745' : '#dc3545' }}"/>
            </svg>
        </button>

    </div>

</nav>



<!-- ===================== SIDEBAR / OFFCANVAS ===================== -->

<div class="sidebar offcanvas-lg offcanvas-start bg-body border-end"

     tabindex="-1"

     id="ezparkSidebar"

     aria-labelledby="ezparkSidebarLabel">



    <!-- Header offcanvas, hanya tampil di mobile -->

    <div class="offcanvas-header d-lg-none border-bottom">

        <h5 class="offcanvas-title fw-bold" id="ezparkSidebarLabel">EZPark</h5>

        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#ezparkSidebar" aria-label="Tutup"></button>
