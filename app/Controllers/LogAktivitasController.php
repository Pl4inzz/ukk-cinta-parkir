<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\LogAktivitas;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $logAktivitas = LogAktivitas::paginate(10);

        return view('logAktivitas.index', [
            'logAktivitas' => $logAktivitas
        ]);
    }
}