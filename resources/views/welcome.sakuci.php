@extends('layouts.app')

@section('title', 'Sistem Manajemen Parkir Sakuci')

@section('content')

    {{-- Hero / Quick Status Banner --}}
    <section class="py-4 mb-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">Sakuci Parking System v1.0</span>
                <h1 class="display-6 fw-bold mb-2">
                    Sistem Manajemen <span class="text-brand">Parkir Terpadu</span>
                </h1>
                <p class="text-secondary mb-4">
                    Kelola transaksi masuk-keluar kendaraan, pantau ketersediaan slot secara real-time, dan cek status keanggotaan member dengan cepat.
                </p>

                <div class="d-flex flex-wrap gap-2">
                    <a href="/transaksi/masuk" class="btn btn-brand btn-lg px-4 fs-6 fw-semibold">
                        🚗 Parkir Masuk
                    </a>
                    <a href="/transaksi/keluar" class="btn btn-outline-brand btn-lg px-4 fs-6 fw-semibold">
                        💳 Parkir Keluar / Bayar
                    </a>
                </div>
            </div>

            {{-- Ringkasan Slot Parkir Real-time --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h6 fw-bold mb-3 d-flex justify-content-between align-items-center">
                            <span>Status Slot Parkir Hari Ini</span>
                            <span class="badge bg-success-subtle text-success small fw-normal">Live</span>
                        </h2>

                        <div class="row g-3 text-center">
                            <div class="col-6">
                                <div class="p-3 border rounded-3 bg-body-tertiary">
                                    <div class="text-secondary small fw-medium mb-1">Slot Motor</div>
                                    <div class="fs-3 fw-bold text-brand">42 <span class="fs-6 text-muted fw-normal">/ 100</span></div>
                                    <div class="progress mt-2" style="height: 6px;">
                                        <div class="progress-bar bg-brand" style="width: 58%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 border rounded-3 bg-body-tertiary">
                                    <div class="text-secondary small fw-medium mb-1">Slot Mobil</div>
                                    <div class="fs-3 fw-bold text-brand">15 <span class="fs-6 text-muted fw-normal">/ 50</span></div>
                                    <div class="progress mt-2" style="height: 6px;">
                                        <div class="progress-bar bg-brand" style="width: 70%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Akses Cepat Modul Utama --}}
    <section class="mb-5">
        <h2 class="h5 fw-bold mb-3">Akses Modul Utama</h2>

        <div class="row row-cols-1 row-cols-md-3 g-3">
            {{-- Modul Transaksi --}}
            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="step-number mb-3">1</div>
                        <h3 class="h6 fw-bold mb-2">Karcis & Transaksi</h3>
                        <p class="text-secondary small mb-3">
                            Cetak karcis masuk, scan barcode karcis keluar, dan hitung tarif otomatis berdasarkan durasi parkir.
                        </p>
                        <a href="/transaksi" class="text-brand fw-semibold small text-decoration-none">Buka Transaksi &rarr;</a>
                    </div>
                </div>
            </div>

            {{-- Modul Member --}}
            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="step-number mb-3">2</div>
                        <h3 class="h6 fw-bold mb-2">Keanggotaan (Member)</h3>
                        <p class="text-secondary small mb-3">
                            Kelola data member bulanan, registrasi kendaraan langganan, dan perpanjangan masa aktif kartu.
                        </p>
                        <a href="/member" class="text-brand fw-semibold small text-decoration-none">Kelola Member &rarr;</a>
                    </div>
                </div>
            </div>

            {{-- Modul Tarif & Area --}}
            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="step-number mb-3">3</div>
                        <h3 class="h6 fw-bold mb-2">Tarif & Kapasitas</h3>
                        <p class="text-secondary small mb-3">
                            Atur skema tarif flat/progresif per jenis kendaraan serta batasan kapasitas area lokasi parkir.
                        </p>
                        <a href="/tarif" class="text-brand fw-semibold small text-decoration-none">Pengaturan Tarif &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tabel Ringkasan Kendaraan Masuk Terakhir --}}
    <section class="mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-body border-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h5 fw-bold mb-1">Aktivitas Parkir Terbaru</h2>
                    <p class="text-secondary small mb-0">Daftar kendaraan yang baru masuk area parkir</p>
                </div>
                <a href="/transaksi/riwayat" class="btn btn-sm btn-outline-brand">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">No. Karcis</th>
                                <th>Plat Nomor</th>
                                <th>Jenis Kendaraan</th>
                                <th>Waktu Masuk</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4"><code class="inline">PKR-20260926-001</code></td>
                                <td class="fw-bold">D 1829 SAK</td>
                                <td><span class="badge bg-secondary-subtle text-secondary">Motor</span></td>
                                <td class="small text-secondary">10:15 WIB</td>
                                <td><span class="badge bg-warning-subtle text-warning-emphasis">Terparkir</span></td>
                                <td class="text-end pe-4">
                                    <a href="/transaksi/keluar?karcis=PKR-20260926-001" class="btn btn-sm btn-brand">Proses Keluar</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4"><code class="inline">PKR-20260926-002</code></td>
                                <td class="fw-bold">B 1024 RFD</td>
                                <td><span class="badge bg-primary-subtle text-primary">Mobil</span></td>
                                <td class="small text-secondary">10:02 WIB</td>
                                <td><span class="badge bg-warning-subtle text-warning-emphasis">Terparkir</span></td>
                                <td class="text-end pe-4">
                                    <a href="/transaksi/keluar?karcis=PKR-20260926-002" class="btn btn-sm btn-brand">Proses Keluar</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4"><code class="inline">PKR-20260926-003</code></td>
                                <td class="fw-bold">D 4412 KC</td>
                                <td><span class="badge bg-success-subtle text-success">Member Motor</span></td>
                                <td class="small text-secondary">09:45 WIB</td>
                                <td><span class="badge bg-warning-subtle text-warning-emphasis">Terparkir</span></td>
                                <td class="text-end pe-4">
                                    <a href="/transaksi/keluar?karcis=PKR-20260926-003" class="btn btn-sm btn-brand">Proses Keluar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection