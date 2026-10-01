/*
|--------------------------------------------------------------------------
| EZPark Theme Toggle
|--------------------------------------------------------------------------
| Tombol utama : #themeToggle
| Tombol mobile : #themeToggleMobile
| Tema disimpan di localStorage dengan key "sakuci-theme".
|--------------------------------------------------------------------------
*/

(function () {
    'use strict';

    var STORAGE_KEY = 'sakuci-theme';
    var root = document.documentElement;

    function toggleTheme() {
        var current = root.getAttribute('data-bs-theme') || 'light';
        var next = current === 'dark' ? 'light' : 'dark';

        root.setAttribute('data-bs-theme', next);
        localStorage.setItem(STORAGE_KEY, next);
    }

    function bindThemeButtons() {
        var desktopButton = document.getElementById('themeToggle');
        var mobileButton = document.getElementById('themeToggleMobile');

        if (desktopButton && !desktopButton.dataset.themeBound) {
            desktopButton.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                toggleTheme();
            });

            desktopButton.dataset.themeBound = 'true';
        }

        if (mobileButton && !mobileButton.dataset.themeBound) {
            mobileButton.addEventListener('click', function (event) {
                event.preventDefault();
                toggleTheme();
            });

            mobileButton.dataset.themeBound = 'true';
        }
    }

    /*
     * theme.js dimuat di bagian bawah body oleh app.sakuci.php,
     * jadi tombol biasanya sudah tersedia saat script ini dijalankan.
     */
    bindThemeButtons();

    /*
     * Fallback kalau partial navbar diproses/dimasukkan setelah script.
     */
    document.addEventListener('DOMContentLoaded', bindThemeButtons);
})();
