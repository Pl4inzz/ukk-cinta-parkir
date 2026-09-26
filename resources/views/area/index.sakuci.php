@extends('layouts.app')

@section('title', 'Manage Area Parkir')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">Area Admin</span>
            <h1 class="h4 mb-0">Manage Area Parkir</h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">&larr; Kembali</a>
    </div>

    <div class="row g-4">
        <!-- Form Tambah Area -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h6 mb-3">Tambah Area Parkir</h2>

                    <form method="POST" action="{{ route('area.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="nama_area">Nama Area</label>
                            <input type="text" id="nama_area" name="nama_area" value="{{ old('nama_area') }}" placeholder="Contoh: Gedung A, Lantai 1" class="form-control {{ errors()->has('nama_area') ? 'is-invalid' : '' }}">
                            @error('nama_area') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="kapasitas">Kapasitas</label>
                            <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas') }}" placeholder="Contoh: 50" class="form-control {{ errors()->has('kapasitas') ? 'is-invalid' : '' }}">
                            @error('kapasitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button class="btn btn-brand w-100" type="submit">Tambah Area</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Area -->
        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h6 mb-3">Daftar Area Parkir</h2>

                    <table class="table table-sm align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Area</th>
                                <th>Kapasitas</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($areaList) && count($areaList) > 0)
                                @foreach ($areaList as $item)
                                    <tr>
                                        <td>{{ $item->id_area }}</td>
                                        <td>
                                            <span class="fw-medium">{{ $item->nama_area }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-secondary">{{ $item->kapasitas }} Slot</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('area.edit', ['id' => $item->id_area]) }}" class="btn btn-sm btn-outline-brand">Edit</a>
                                                <form method="POST" action="{{ route('area.destroy', ['id' => $item->id_area]) }}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus area ini?')">
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
                                    <td colspan="4" class="text-secondary text-center py-3">Belum ada data area parkir.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection