@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
            Admin
        </span>

        <h1 class="h4 mb-1">
            Log Aktivitas
        </h1>

        <small class="text-muted">
            Riwayat aktivitas pengguna di dalam sistem EZPark.
        </small>
    </div>

    <a
        href="{{ route('admin.dashboard') }}"
        class="btn btn-sm btn-outline-secondary"
    >
        &larr; Kembali
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <div class="mb-3">
            <h2 class="h6 mb-1">
                Riwayat Aktivitas
            </h2>

            <small class="text-muted">
                Menampilkan aktivitas yang dilakukan oleh pengguna.
            </small>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Aktivitas</th>
                        <th>Deskripsi</th>
                        <th>Waktu</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($logAktivitas as $log)

                        <tr>

                            <td>
                                {{ $log->id_log }}
                            </td>

                            <td>
                                {{ $log->user->username ?? '-' }}
                            </td>

                            <td>
                                <span class="badge bg-primary">
                                    {{ $log->aktivitas }}
                                </span>
                            </td>

                            <td>
                                {{ $log->deskripsi ?? '-' }}
                            </td>

                            <td>
                                {{ $log->created_at ?? '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="5"
                                class="text-center text-muted py-5"
                            >
                                Belum ada aktivitas yang tercatat.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection