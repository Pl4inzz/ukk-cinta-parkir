<?php

namespace App\Models;

use Sakuci\Database\Model;
use App\Models\User;

class LogAktivitas extends Model
{
    protected static ?string $table = 'log_aktivitas';

    protected string $primaryKey = 'id_log';

    protected array $fillable = [
        'id_user',
        'aktivitas',
        'deskripsi',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'
        );
    }

    public static function catat(
        string $aktivitas,
        string $deskripsi
    ): void {
        $user = User::current();

        self::create([
            'id_user' => $user ? $user->id : null,
            'aktivitas' => $aktivitas,
            'deskripsi' => $deskripsi,
        ]);
    }
}