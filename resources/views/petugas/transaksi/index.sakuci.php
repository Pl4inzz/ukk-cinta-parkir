@extends('layouts.app')
@section('title', 'Daftar Transaksi Parkir')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5 mb-0">Daftar Transaksi Parkir</h2>
            <a href="{{ route('petugas.transaksi.masuk') }}" class="btn btn-primary">+ Parkir Masuk</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID Parkir</th>
                    <th>Member</th>
                    <th>Area</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Biaya Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksiList as $t)
                <tr>
                    <td><strong>#{{ $t->id_parkir }}</strong></td>
                    <td>{{ $t->member ? $t->member->nama : 'Non-Member' }}</td>
                    <td>{{ $t->area ? $t->area->nama_area : '-' }}</td>
                    <td>{{ $t->waktu_masuk }}</td>
                    <td>{{ $t->waktu_keluar ?? '-' }}</td>
                    <td>Rp {{ number_format($t->biaya_total ?? 0, 0, ',', '.') }}</td>
                    <td>
                        @if($t->status === 'PARKIR')
                            <span class="badge bg-warning text-dark">PARKIR</span>
                        @else
                            <span class="badge bg-success">KELUAR</span>
                        @endif
                    </td>
                    <td>
                        @if($t->status === 'PARKIR')
                            <a href="{{ route('petugas.transaksi.keluar', ['id' => $t->id_parkir]) }}" class="btn btn-sm btn-danger">Proses Keluar</a>
                            <a href="{{ route('petugas.transaksi.cetakTiket', ['id' => $t->id_parkir]) }}" target="_blank" class="btn btn-sm btn-secondary">Cetak Tiket</a>
                        @else
                            <a href="{{ route('petugas.transaksi.cetakStruk', ['id' => $t->id_parkir]) }}" target="_blank" class="btn btn-sm btn-info">Cetak Struk</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection