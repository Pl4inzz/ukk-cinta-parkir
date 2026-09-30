<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Tarif;

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
        $data = $request->only(['jenis_kendaraan', 'tarif_per_jam']);
        Tarif::create($data);
        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil ditambahkan.');
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
            return redirect()->route('admin.tarif.index')->with('error', 'Tarif tidak ditemukan.');
        }
        $data = $request->only(['jenis_kendaraan', 'tarif_per_jam']);
        $tarif->update($data);
        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $tarif = Tarif::find($id);
        if (!$tarif) {
            return redirect()->route('admin.tarif.index')->with('error', 'Tarif tidak ditemukan.');
        }
        $tarif->delete();
        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil dihapus.');
    }
}