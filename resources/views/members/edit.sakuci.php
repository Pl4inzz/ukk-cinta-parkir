@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">Area Admin</span>
            <h1 class="h4 mb-0">Edit Member</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h6 mb-3">Form Edit Member</h2>

                    <form method="POST" action="{{ route('members.update', ['id' => $member->id_member ?? $member->id]) }}">
                        @csrf
                        @method('PUT')

                        <!-- Kode Member -->
                        <div class="mb-3">
                            <label class="form-label" for="kode_member">Kode Member</label>
                            <input type="text" 
                                   id="kode_member" 
                                   name="kode_member" 
                                   value="{{ old('kode_member', $member->kode_member) }}" 
                                   placeholder="Contoh: MBR-001" 
                                   class="form-control {{ errors()->has('kode_member') ? 'is-invalid' : '' }}">
                            @error('kode_member')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <input type="text" 
                                   id="nama" 
                                   name="nama" 
                                   value="{{ old('nama', $member->nama) }}" 
                                   placeholder="Contoh: Mikael Keyndradito" 
                                   class="form-control {{ errors()->has('nama') ? 'is-invalid' : '' }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Plat Nomor -->
                        <div class="mb-3">
                            <label class="form-label" for="plat_nomor">Plat Nomor</label>
                            <input type="text" 
                                   id="plat_nomor" 
                                   name="plat_nomor" 
                                   value="{{ old('plat_nomor', $member->plat_nomor) }}" 
                                   placeholder="Contoh: D 1234 ABC" 
                                   class="form-control {{ errors()->has('plat_nomor') ? 'is-invalid' : '' }}">
                            @error('plat_nomor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenis Kendaraan (Varchar / Input Text) -->
                        <div class="mb-3">
                            <label class="form-label" for="jenis_kendaraan">Jenis Kendaraan</label>
                            <input type="text" 
                                   id="jenis_kendaraan" 
                                   name="jenis_kendaraan" 
                                   value="{{ old('jenis_kendaraan', $member->jenis_kendaraan) }}" 
                                   placeholder="Contoh: motor, mobil, truk" 
                                   class="form-control {{ errors()->has('jenis_kendaraan') ? 'is-invalid' : '' }}">
                            @error('jenis_kendaraan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div class="mb-3">
                            <label class="form-label" for="no_hp">No. HP <small class="text-muted">(Opsional)</small></label>
                            <input type="text" 
                                   id="no_hp" 
                                   name="no_hp" 
                                   value="{{ old('no_hp', $member->no_hp) }}" 
                                   placeholder="Contoh: 081234567890" 
                                   class="form-control {{ errors()->has('no_hp') ? 'is-invalid' : '' }}">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Aktif -->
                        <div class="mb-3">
                            <label class="form-label" for="status_aktif">Status Member</label>
                            <select id="status_aktif" 
                                    name="status_aktif" 
                                    class="form-select {{ errors()->has('status_aktif') ? 'is-invalid' : '' }}">
                                <option value="aktif" {{ old('status_aktif', $member->status_aktif) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status_aktif', $member->status_aktif) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status_aktif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Kadaluarsa -->
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_kadaluarsa">Tanggal Kadaluarsa <small class="text-muted">(Opsional)</small></label>
                            <input type="date" 
                                   id="tanggal_kadaluarsa" 
                                   name="tanggal_kadaluarsa" 
                                   value="{{ old('tanggal_kadaluarsa', $member->tanggal_kadaluarsa) }}" 
                                   class="form-control {{ errors()->has('tanggal_kadaluarsa') ? 'is-invalid' : '' }}">
                            @error('tanggal_kadaluarsa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2">
                            <a href="{{ route('members.index') }}" class="btn btn-outline-secondary w-50">Batal</a>
                            <button class="btn btn-brand w-50" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection