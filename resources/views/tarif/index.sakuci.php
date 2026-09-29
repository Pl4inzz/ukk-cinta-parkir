@extends('layouts.app')

@section('title', 'Manage Tarif Parkir')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">Area Admin</span>
            <h1 class="h4 mb-0">Manage Tarif Parkir</h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">&larr; Kembali</a>
    </div>

    <div class="row g-4">
        <!-- Form Tambah Tarif -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h6 mb-3">Tambah Tarif Parkir</h2>

                    <form method="POST" action="{{ route('admin.tarif.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="jenis_kendaraan">Jenis Kendaraan</label>
                            <input type="text" id="jenis_kendaraan" name="jenis_kendaraan" value="{{ old('jenis_kendaraan') }}" placeholder="Contoh: motor, mobil, truk" class="form-control {{ errors()->has('jenis_kendaraan') ? 'is-invalid' : '' }}">
                            @error('jenis_kendaraan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="tarif_per_jam">Tarif per Jam (Rp)</label>
                            <input type="number" id="tarif_per_jam" name="tarif_per_jam" value="{{ old('tarif_per_jam') }}" placeholder="Contoh: 2000" class="form-control {{ errors()->has('tarif_per_jam') ? 'is-invalid' : '' }}">
                            @error('tarif_per_jam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button class="btn btn-brand w-100" type="submit">Tambah Tarif</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Tarif -->
        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h6 mb-3">Daftar Tarif Parkir</h2>

                    <table class="table table-sm align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jenis Kendaraan</th>
                                <th>Tarif / Jam</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($tarifList) > 0)
                            @php $no= 1; @endphp
                                @foreach ($tarifList as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="text-capitalize fw-medium">{{ $item->jenis_kendaraan }}</span>
                                        </td>
                                        <td>
                                            <code class="inline">Rp {{ number_format($item->tarif_per_jam, 0, ',', '.') }}</code>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('admin.tarif.edit', ['id' => $item->id_tarif]) }}" class="btn btn-sm btn-outline-brand">Edit</a>
                                                <form method="POST" action="{{ route('admin.tarif.destroy', ['id' => $item->id_tarif]) }}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tarif ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-secondary text-center py-3">Belum ada data tarif parkir.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection