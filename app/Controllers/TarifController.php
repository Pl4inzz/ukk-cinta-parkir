<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Tarif;
use App\Models\Transaksi;
use App\Models\AreaParkir;
use App\Models\LogAktivitas;

class TarifController extends Controller
{
    public function index(Request $request)
    {
        $tarifList = Tarif::all();

        $jumlahTransaksi = [];

        foreach ($tarifList as $tarif) {
            $transaksi = Transaksi::where(
                'id_tarif',
                $tarif->id_tarif
            )->get();

            $jumlahTransaksi[$tarif->id_tarif] = count($transaksi);
        }

        return view('tarif.index', [
            'tarifList' => $tarifList,
            'jumlahTransaksi' => $jumlahTransaksi
        ]);
    }


    public function create(Request $request)
    {
        return view('tarif.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_kendaraan' =>
                'required|in:kecil,sedang,besar',

            'tarif_per_jam' =>
                'required|numeric|min:0'
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
            return redirect()
                ->route('admin.tarif.index')
                ->with(
                    'error',
                    'Tarif tidak ditemukan.'
                );
        }

        return view('tarif.edit', [
            'tarif' => $tarif
        ]);
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

        $data = $request->validate([
            'jenis_kendaraan' =>
                'required|in:kecil,sedang,besar',

            'tarif_per_jam' =>
                'required|numeric|min:0'
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

        /*
         * Ambil semua transaksi
         * yang menggunakan tarif ini.
         */
        $transaksiList = Transaksi::where(
            'id_tarif',
            $id
        )->get();

        $jumlahTransaksi = count($transaksiList);

        /*
         * Jika ada transaksi aktif,
         * kurangi jumlah kendaraan
         * pada area parkir terlebih dahulu.
         */
        foreach ($transaksiList as $transaksi) {

            if ($transaksi->status === 'masuk') {

                $area = AreaParkir::where(
                    'id_area',
                    $transaksi->id_area
                )->first();

                if ($area && $area->terisi > 0) {

                    $area->update([
                        'terisi' => $area->terisi - 1
                    ]);
                }
            }
        }

        /*
         * Hapus seluruh transaksi
         * yang menggunakan tarif tersebut.
         */
        if ($jumlahTransaksi > 0) {

            Transaksi::where(
                'id_tarif',
                $id
            )->delete();
        }

        /*
         * Setelah transaksi dihapus,
         * baru hapus tarif.
         */
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
            ) .
            ' beserta ' .
            $jumlahTransaksi .
            ' transaksi terkait.'
        );

        return redirect()
            ->route('admin.tarif.index')
            ->with(
                'success',
                'Tarif dan ' .
                $jumlahTransaksi .
                ' transaksi terkait berhasil dihapus.'
            );
    }
}