<?php

namespace App\Models;

use Sakuci\Database\Model;

class Member extends Model
{
    protected static ?string $table = 'member';
    protected string $primaryKey = 'id_member';

    protected array $fillable = [
        'id_user',            // Petugas/Admin yang mendaftarkan (jika memakai FK)
        'kode_member',
        'nama',
        'plat_nomor',
        'jenis_kendaraan',
        'no_hp',
        'status_aktif',
        'tanggal_kadaluarsa',
    ];

    // Relasi opsional ke User (Petugas pendaftar)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}