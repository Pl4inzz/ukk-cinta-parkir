@extends('layouts.app')
@section('title', 'Proses Parkir Keluar')

@section('content')
<div class="card border-0 shadow-sm col-md-6 mx-auto">
    <div class="card-body p-4">
        <h2 class="h5 mb-4">Proses Parkir Keluar #{{ $transaksi->id_parkir }}</h2>

        <form method="POST" action="{{ route('petugas.transaksi.updateKeluar', ['id' => $transaksi->id_parkir]) }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Waktu Masuk</label>
                <input type="text" class="form-control" value="{{ $transaksi->waktu_masuk }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Waktu Keluar</label>
                <input type="text" name="waktu_keluar" class="form-control" value="{{ $waktuKeluar }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Estimasi Durasi (Jam)</label>
                <input type="number" name="durasi_jam" class="form-control" value="{{ $durasiJam }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Tarif Parkir Per Jam</label>
                <select name="id_tarif" class="form-select" required>
                    <option value="">-- Pilih Jenis Tarif --</option>
                    @foreach($tarifs as $t)
                        <option value="{{ $t->id_tarif }}">{{ $t->jenis_kendaraan }} - Rp {{ number_format($t->tarif_per_jam, 0, ',', '.') }}/jam</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-danger w-100">Proses Bayar & Selesai</button>
        </form>
    </div>
</div>
@endsection