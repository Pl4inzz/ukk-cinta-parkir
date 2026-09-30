    <!doctype html>
    <html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name'))</title>

        {{-- Terapkan tema tersimpan sebelum apa pun dirender, supaya tidak ada flash warna --}}
        <script>
            (function () {
                var saved = localStorage.getItem('sakuci-theme');
                var theme = saved || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                document.documentElement.setAttribute('data-bs-theme', theme);
            })();
        </script>

        {{-- Bootstrap 5.3.8 & App CSS --}}
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
        <style>
            html, body {
                height: 100%;
                margin: 0;
                overflow-x: hidden;
            }
            .ezpark-content {
                min-width: 0;
            }

            @media (min-width: 992px) {
                .ezpark-content {
                    max-height: 100vh;
                }
            }
        </style>
    </head>
    <body class="bg-body-tertiary">

        <!-- Wrapper utama flexbox sejajar samping (Horizontal) -->
        <div class="d-flex flex-column flex-lg-row min-vh-100 align-items-stretch">

            <!-- Include Sidebar/Navbar dari partials/navbar.sakuci.php -->
            @include('partials.navbar')

            <!-- Container Konten Utama di Sebelah Kanan Navigasi -->
            <div class="ezpark-content d-flex flex-column flex-grow-1 overflow-y-auto">
                <main class="flex-grow-1 p-4 p-lg-5">
                    @include('partials.flash')

                    @yield('content')
                </main>

                @include('partials.footer')
            </div>

        </div>

        

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    @yield('scripts')

    </body>
    </html>