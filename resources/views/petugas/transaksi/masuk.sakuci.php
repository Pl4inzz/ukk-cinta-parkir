@extends('layouts.app')
@section('title', 'Input Parkir Masuk')

@section('content')
<div class="card border-0 shadow-sm col-md-6 mx-auto">
    <div class="card-body p-4">
        <h2 class="h5 mb-4">Input Kendaraan Masuk</h2>

        <form method="POST" action="{{ route('petugas.transaksi.storeMasuk') }}">
            @csrf
            <input type="hidden" name="id_user" value="{{ session('user_id') }}">

            <div class="mb-3">
                <label class="form-label">Pilih Member <small class="text-muted">(Opsional)</small></label>
                <select name="id_member" class="form-select">
                    <option value="">-- Non-Member / Umum --</option>
                    @foreach($members as $m)
                        <option value="{{ $m->id_member }}">{{ $m->kode_member }} - {{ $m->nama }} ({{ $m->plat_nomor }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Area Parkir</label>
                <select name="id_area" class="form-select" required>
                    <option value="">-- Pilih Area --</option>
                    @foreach($areas as $a)
                        <option value="{{ $a->id_area }}">{{ $a->nama_area }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100">Simpan & Cetak Tiket</button>
        </form>
    </div>
</div>
@endsection