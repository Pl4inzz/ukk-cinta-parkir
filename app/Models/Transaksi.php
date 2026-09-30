<?php

namespace App\Models;

use Sakuci\Database\Model;

class Transaksi extends Model
{
    protected static ?string $table = 'transaksi';

    // Beritahu ORM nama primary key yang sebenarnya
    protected string $primaryKey = 'id_parkir';

    protected array $fillable = [
        'id_user',
        'id_member',
        'id_area',
        'id_tarif',
        'durasi_jam',
        'biaya_total',
        'waktu_masuk',
        'waktu_keluar',
        'status'
    ];
}