<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;

class AreaParkirController extends Controller
{
    public function index(Request $request)
    {
        $areaList = \App\Models\AreaParkir::all();
        // Ubah 'area.index' menjadi 'admin.area.index' dan sesuaikan nama variabel ke 'areaList'
        return view('area.index', ['areaList' => $areaList]);
    }

    public function create(Request $request)
    {
        return view('area.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['nama_area', 'kapasitas']);
        $data['terisi'] = 0; // Set terisi ke 0 saat membuat area parkir baru
        \App\Models\AreaParkir::create($data);
        return redirect()->route('area.index')->with('success', 'Area parkir berhasil ditambahkan.');
    }

public function edit(Request $request, $id)
{
    $area = \App\Models\AreaParkir::find($id);
    if (!$area) {
        return redirect()->route('area.index')->with('error', 'Area parkir tidak ditemukan.');
    }
    
    // Ubah kunci dari 'areaParkir' menjadi 'area'
    return view('area.edit', ['area' => $area]);
}

    public function update(Request $request, $id)
    {
        $areaParkir = \App\Models\AreaParkir::find($id);
        if (!$areaParkir) {
            return redirect()->route('area.index')->with('error', 'Area parkir tidak ditemukan.');
        }

        $data = $request->only(['nama_area', 'kapasitas']);
        $areaParkir->update($data);
        return redirect()->route('area.index')->with('success', 'Area parkir berhasil diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $areaParkir = \App\Models\AreaParkir::find($id);
        if (!$areaParkir) {
            return redirect()->route('area.index')->with('error', 'Area parkir tidak ditemukan.');
        }

        $areaParkir->delete();
        return redirect()->route('area.index')->with('success', 'Area parkir berhasil dihapus.');
    }
}