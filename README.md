# EZPark – Sistem Informasi Manajemen Parkir

EZPark merupakan aplikasi berbasis web yang dirancang untuk membantu pengelolaan parkir secara digital, mulai dari pencatatan kendaraan masuk dan keluar, pengelolaan member, pengaturan tarif, hingga pembuatan laporan pendapatan parkir.

## Fitur Utama

- **Manajemen User:** Mengelola akun pengguna berdasarkan hak akses.
- **Manajemen Member:** Mengelola data anggota parkir.
- **Manajemen Tarif:** Mengatur tarif parkir berdasarkan kategori kendaraan.
- **Manajemen Area Parkir:** Mengelola kapasitas dan jumlah kendaraan di area parkir.
- **Transaksi Parkir:** Mencatat kendaraan masuk dan keluar.
- **Tiket dan Struk:** Menampilkan tiket masuk dan bukti transaksi parkir.
- **Log Aktivitas:** Mencatat aktivitas pengguna dalam aplikasi.
- **Rekap Laporan:** Menampilkan jumlah transaksi dan total pendapatan berdasarkan periode tertentu.

## Hak Akses Pengguna

| Role    | Hak Akses                                                      |
| ------- | -------------------------------------------------------------- |
| Admin   | Mengelola user, tarif, area parkir, member, dan log aktivitas. |
| Petugas | Mengelola transaksi kendaraan masuk dan keluar.                |
| Owner   | Melihat, memfilter, dan mencetak laporan parkir.               |

## Akun Demo

Gunakan akun berikut untuk mencoba aplikasi:

| Role    | Username | Password   |
| ------- | -------- | ---------- |
| Admin   | admin    | rahasia123 |
| Petugas | petugas  | rahasia123 |
| Owner   | owner    | rahasia123 |

> Akun di atas merupakan akun demo untuk keperluan pengujian aplikasi. Jangan gunakan password akun pribadi atau akun produksi.

## Teknologi yang Digunakan

- PHP
- Sakuci Framework
- MySQL
- HTML
- CSS
- JavaScript
- Bootstrap
- XAMPP

## Instalasi

1. Clone repository ini:

   ```bash
   git clone github.com/Pl4inzz/ukk-cinta-parkir
   ```

2. Masuk ke direktori project:

   ```bash
   cd ukk-cinta-parkir
   ```

3. Siapkan database MySQL dengan nama database yang digunakan oleh konfigurasi aplikasi.

4. Import file database atau jalankan migration yang tersedia.

5. Sesuaikan konfigurasi koneksi database.

6. Jalankan aplikasi melalui server lokal sesuai konfigurasi Sakuci Framework.

7. Buka aplikasi melalui browser.

## Pengembang

**Mikael Keyndradito**

Project ini dikembangkan sebagai bagian dari tugas Uji Kompetensi Keahlian (UKK), Rekayasa Perangkat Lunak.

---

© 2027 EZPark – Sistem Informasi Manajemen Parkir.
