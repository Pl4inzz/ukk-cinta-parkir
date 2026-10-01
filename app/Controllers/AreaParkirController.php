<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\LogAktivitas;
use App\Models\AreaParkir;

class AreaParkirController extends Controller
{
    public function index(Request $request)
    {
        $areaList = AreaParkir::all();

        return view('area.index', [
            'areaList' => $areaList
        ]);
    }

    public function create(Request $request)
    {
        return view('area.create');
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'nama_area',
            'kapasitas'
        ]);

        $data['terisi'] = 0;

        $areaParkir = AreaParkir::create($data);

        LogAktivitas::catat(
            'CREATE',
            'Menambahkan area parkir ' .
            $areaParkir->nama_area .
            ' dengan kapasitas ' .
            $areaParkir->kapasitas .
            ' kendaraan.'
        );

        return redirect()
            ->route('area.index')
            ->with(
                'success',
                'Area parkir berhasil ditambahkan.'
            );
    }

    public function edit(Request $request, $id)
    {
        $area = AreaParkir::find($id);

        if (!$area) {
            return redirect()
                ->route('area.index')
                ->with(
                    'error',
                    'Area parkir tidak ditemukan.'
                );
        }

        return view('area.edit', [
            'area' => $area
        ]);
    }

    public function update(Request $request, $id)
    {
        $areaParkir = AreaParkir::find($id);

        if (!$areaParkir) {
            return redirect()
                ->route('area.index')
                ->with(
                    'error',
                    'Area parkir tidak ditemukan.'
                );
        }

        $namaAreaLama = $areaParkir->nama_area;
        $kapasitasLama = $areaParkir->kapasitas;

        $data = $request->only([
            'nama_area',
            'kapasitas'
        ]);

        $areaParkir->update($data);

        LogAktivitas::catat(
            'UPDATE',
            'Mengubah area parkir ' .
            $namaAreaLama .
            ' menjadi ' .
            $areaParkir->nama_area .
            ' dengan kapasitas ' .
            $kapasitasLama .
            ' menjadi ' .
            $areaParkir->kapasitas .
            ' kendaraan.'
        );

        return redirect()
            ->route('area.index')
            ->with(
                'success',
                'Area parkir berhasil diperbarui.'
            );
    }

    public function destroy(Request $request, $id)
    {
        $areaParkir = AreaParkir::find($id);

        if (!$areaParkir) {
            return redirect()
                ->route('area.index')
                ->with(
                    'error',
                    'Area parkir tidak ditemukan.'
                );
        }

        $namaArea = $areaParkir->nama_area;
        $kapasitas = $areaParkir->kapasitas;

        $areaParkir->delete();

        LogAktivitas::catat(
            'DELETE',
            'Menghapus area parkir ' .
            $namaArea .
            ' dengan kapasitas ' .
            $kapasitas .
            ' kendaraan.'
        );

        return redirect()
            ->route('area.index')
            ->with(
                'success',
                'Area parkir berhasil dihapus.'
            );
    }
}