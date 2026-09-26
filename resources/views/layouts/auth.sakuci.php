<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Masuk - ' . config('app.name'))</title>

    <!-- Bootstrap 5 CSS & Custom App CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">

    {{-- Script Pembaca Tema Otomatis dari Beranda --}}
    <script>
        (function() {
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
            }

            // Cek dari LocalStorage atau Cookie
            const savedTheme = localStorage.getItem('theme') || 
                               localStorage.getItem('color-theme') || 
                               localStorage.getItem('dark_mode') ||
                               getCookie('theme') || 
                               getCookie('dark_mode');

            const isDark = savedTheme === 'dark' || savedTheme === 'true' || 
                          (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches);

            if (isDark) {
                document.documentElement.setAttribute('data-bs-theme', 'dark');
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.setAttribute('data-bs-theme', 'light');
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <style>
        /* CSS Override untuk memaksa Flexbox Penuh di Tengah Layar */
        html, body {
            height: 100vh !important;
            width: 100vw !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow-x: hidden;
        }

        #auth-page-wrapper {
            min-height: 100vh !important;
            width: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 1.5rem !important;
            box-sizing: border-box !important;
        }

        .auth-container-box {
            width: 100% !important;
            max-width: 420px !important;
            margin: 0 auto !important;
        }
    </style>
</head>
<body class="bg-body-tertiary">

    <div id="auth-page-wrapper">
        <div class="auth-container-box">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>