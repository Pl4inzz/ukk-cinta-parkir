<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Transaksi;
use App\Models\Tarif;
use App\Models\AreaParkir;
use App\Models\Member;

class TransaksiController extends Controller
{
    /**
     * Tampilkan daftar transaksi parkir (Aktif & Selesai)
     */
/**
 * Tampilkan daftar transaksi parkir (Aktif & Selesai)
 */
    public function index(Request $request)
{
    // Menggunakan where pada kolom status yang memang ada di database
    $transaksiList = Transaksi::whereIn('status', ['masuk', 'keluar'])->get();

    return view('petugas.transaksi.index', [
        'transaksiList' => $transaksiList
    ]);
}

    /**
     * Form kendaraan masuk
     */
    public function createMasuk(Request $request)
    {
        $areas   = AreaParkir::all();
        $members = Member::all();

        return view('petugas.transaksi.masuk', [
            'areas'   => $areas,
            'members' => $members
        ]);
    }

    /**
     * Proses simpan transaksi parkir masuk
     */
    public function storeMasuk(Request $request)
    {
        // Sesuaikan 'id_user' dengan nama kolom di tabel database kamu
        Transaksi::create([
            'id_user'     => $request->input('id_user') ?? $request->input('user_id'),
            'id_member'   => $request->input('id_member') ?: null,
            'id_area'     => $request->input('id_area'),
            'id_tarif'    => 1, // id_tarif default
            'durasi_jam'  => 0,
            'biaya_total' => 0,
            'waktu_masuk' => date('Y-m-d H:i:s'),
            'status'      => 'masuk',
        ]);

        return redirect()->route('petugas.transaksi.index')
                        ->with('success', 'Berhasil mencatat kendaraan masuk!');
    }

    /**
     * Form / Scan parkir keluar (Hitung durasi & biaya)
     */
    public function editKeluar(Request $request, $id)
    {
        // ✅ Menggunakan where('id_parkir', $id)
        $transaksi = Transaksi::where('id_parkir', $id)->first();

        if (!$transaksi || strtolower($transaksi->status) === 'keluar') {
            return redirect()->route('petugas.transaksi.index')
                             ->with('error', 'Transaksi tidak ditemukan atau kendaraan sudah keluar.');
        }

        $waktuMasuk  = strtotime($transaksi->waktu_masuk);
        $waktuKeluar = time();
        
        $diffDetik = $waktuKeluar - $waktuMasuk;
        $durasiJam = ceil($diffDetik / 3600);
        if ($durasiJam < 1) {
            $durasiJam = 1;
        }

        $tarifs = Tarif::all();

        return view('petugas.transaksi.keluar', [
            'transaksi'   => $transaksi,
            'waktuKeluar' => date('Y-m-d H:i:s', $waktuKeluar),
            'durasiJam'   => $durasiJam,
            'tarifs'      => $tarifs
        ]);
    }

    /**
     * Proses simpan transaksi parkir keluar
     */
    public function updateKeluar(Request $request, $id)
    {
        // ✅ Ganti Transaksi::find($id) menjadi where('id_parkir', $id)->first()
        $transaksi = Transaksi::where('id_parkir', $id)->first();

        if (!$transaksi) {
            return redirect()->route('petugas.transaksi.index')
                             ->with('error', 'Data transaksi tidak ditemukan.');
        }

        $idTarif     = $request->input('id_tarif');
        $durasiJam   = $request->input('durasi_jam');
        $waktuKeluar = $request->input('waktu_keluar') ?: date('Y-m-d H:i:s');

        // Ambil tarif per jam (Ganti Tarif::find jika model Tarif juga tidak memakai 'id')
        $tarif = Tarif::where('id_tarif', $idTarif)->first() ?? Tarif::find($idTarif);
        $biayaTotal = $tarif ? ($tarif->tarif_per_jam * $durasiJam) : 0;

        $transaksi->update([
            'waktu_keluar' => $waktuKeluar,
            'id_tarif'     => $idTarif,
            'durasi_jam'   => $durasiJam,
            'biaya_total'  => $biayaTotal,
            'status'       => 'keluar'
        ]);

        return redirect()->route('petugas.transaksi.cetakStruk', ['id' => $transaksi->id_parkir])
                         ->with('success', 'Transaksi keluar berhasil diproses.');
    }

    /**
     * Tampilan cetak tiket parkir (Saat masuk)
     */
    public function cetakTiket(Request $request, $id)
    {
        // ✅ Ganti Transaksi::find($id)
        $transaksi = Transaksi::where('id_parkir', $id)->first();
        return view('petugas.transaksi.cetak_tiket', ['transaksi' => $transaksi]);
    }

    /**
     * Tampilan cetak struk pembayarannya (Saat keluar)
     */
    public function cetakStruk(Request $request, $id)
    {
        // ✅ Ganti Transaksi::find($id)
        $transaksi = Transaksi::where('id_parkir', $id)->first();
        return view('petugas.transaksi.cetak_struk', ['transaksi' => $transaksi]);
    }
}