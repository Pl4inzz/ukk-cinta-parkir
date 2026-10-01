<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Tarif;
use App\Models\LogAktivitas;

class TarifController extends Controller
{
    public function index(Request $request)
    {
        $tarifList = Tarif::all();
        return view('tarif.index', ['tarifList' => $tarifList]);
    }

    public function create(Request $request)
    {
        return view('tarif.create');
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'jenis_kendaraan',
            'tarif_per_jam'
        ]);

        $tarif = Tarif::create($data);

        LogAktivitas::catat(
            'CREATE',
            'Menambahkan tarif ' .
            $tarif->jenis_kendaraan .
            ' dengan tarif Rp ' .
            number_format(
                $tarif->tarif_per_jam,
                0,
                ',',
                '.'
            )
        );

        return redirect()
            ->route('admin.tarif.index')
            ->with(
                'success',
                'Tarif berhasil ditambahkan.'
            );
    }

    public function edit(Request $request, $id)
    {
        $tarif = Tarif::find($id);
        if (!$tarif) {
            return redirect()->route('admin.tarif.index')->with('error', 'Tarif tidak ditemukan.');
        }
        return view('tarif.edit', ['tarif' => $tarif]);
    }

    public function update(Request $request, $id)
    {
        $tarif = Tarif::find($id);

        if (!$tarif) {
            return redirect()
                ->route('admin.tarif.index')
                ->with(
                    'error',
                    'Tarif tidak ditemukan.'
                );
        }

        $jenisLama = $tarif->jenis_kendaraan;

        $data = $request->only([
            'jenis_kendaraan',
            'tarif_per_jam'
        ]);

        $tarif->update($data);

        LogAktivitas::catat(
            'UPDATE',
            'Mengubah tarif ' .
            $jenisLama .
            ' menjadi ' .
            $tarif->jenis_kendaraan .
            ' dengan tarif Rp ' .
            number_format(
                $tarif->tarif_per_jam,
                0,
                ',',
                '.'
            )
        );

        return redirect()
            ->route('admin.tarif.index')
            ->with(
                'success',
                'Tarif berhasil diperbarui.'
            );
    }

    public function destroy(Request $request, $id)
    {
        $tarif = Tarif::find($id);

        if (!$tarif) {
            return redirect()
                ->route('admin.tarif.index')
                ->with(
                    'error',
                    'Tarif tidak ditemukan.'
                );
        }

        $jenisKendaraan = $tarif->jenis_kendaraan;
        $tarifPerJam = $tarif->tarif_per_jam;

        $tarif->delete();

        LogAktivitas::catat(
            'DELETE',
            'Menghapus tarif ' .
            $jenisKendaraan .
            ' dengan tarif Rp ' .
            number_format(
                $tarifPerJam,
                0,
                ',',
                '.'
            )
        );

        return redirect()
            ->route('admin.tarif.index')
            ->with(
                'success',
                'Tarif berhasil dihapus.'
            );
    }
}