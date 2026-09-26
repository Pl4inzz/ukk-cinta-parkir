@extends('layouts.app')

@section('title', 'Edit Area Parkir')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">Area Admin</span>
            <h1 class="h4 mb-0">Edit Area Parkir</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h6 mb-3">Form Edit Area Parkir</h2>

                    <form method="POST" action="{{ route('area.update', ['id' => $area->id_area]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" for="nama_area">Nama Area</label>
                            <input type="text" 
                                   id="nama_area" 
                                   name="nama_area" 
                                   value="{{ old('nama_area', $area->nama_area) }}" 
                                   placeholder="Contoh: Area A, Area B" 
                                   class="form-control {{ errors()->has('nama_area') ? 'is-invalid' : '' }}">
                            @error('nama_area')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="kapasitas">Kapasitas</label>
                            <input type="number" 
                                   id="kapasitas" 
                                   name="kapasitas" 
                                   value="{{ old('kapasitas', $area->kapasitas) }}" 
                                   placeholder="Contoh: 50" 
                                   class="form-control {{ errors()->has('kapasitas') ? 'is-invalid' : '' }}">
                            @error('kapasitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('area.index') }}" class="btn btn-outline-secondary w-50">Batal</a>
                            <button class="btn btn-brand w-50" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection