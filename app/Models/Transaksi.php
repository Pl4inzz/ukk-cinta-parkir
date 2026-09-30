<?php

namespace App\Models;

use Sakuci\Database\Model;

class Transaksi extends Model
{
    protected static ?string $table = 'transaksi';

    protected string $primaryKey = 'id_parkir';

    protected array $fillable = [
        'id_user',
        'id_member',
        'plat_nomor',
        'id_area',
        'id_tarif',
        'durasi_jam',
        'biaya_total',
        'waktu_masuk',
        'waktu_keluar',
        'status',
    ];

    /**
     * Member yang menggunakan kendaraan
     */
    public function member()
    {
        return $this->belongsTo(
            Member::class,
            'id_member',
            'id_member'
        );
    }

    /**
     * Area tempat kendaraan parkir
     */
    public function area()
    {
        return $this->belongsTo(
            AreaParkir::class,
            'id_area',
            'id_area'
        );
    }

    /**
     * Tarif yang digunakan transaksi
     */
    public function tarif()
    {
        return $this->belongsTo(
            Tarif::class,
            'id_tarif',
            'id_tarif'
        );
    }

    /**
     * User/petugas yang mencatat transaksi
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'
        );
    }
}