<?php

namespace App\Models;

use Sakuci\Database\Model;

class AreaParkir extends Model
{
    protected static ?string $table = 'area_parkirs';

    protected string $primaryKey = 'id_area';

    protected array $fillable = ['nama_area', 'kapasitas', 'terisi', 'created_at', 'updated_at'];
}
