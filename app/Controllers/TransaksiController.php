<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Transaksi;
use App\Models\Tarif;
use App\Models\AreaParkir;
use App\Models\Member;
use App\Models\User;

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
        $areas = AreaParkir::all();
        $members = Member::all();
        $tarifs = Tarif::all();

        return view('petugas.transaksi.masuk', [
            'areas' => $areas,
            'members' => $members,
            'tarifs' => $tarifs
        ]); 
    }
    /**
     * Proses simpan transaksi parkir masuk
     */
public function storeMasuk(Request $request)
{
    $user = User::current();

    if (!$user) {
        return redirect()
            ->route('petugas.transaksi.index')
            ->with(
                'error',
                'Sesi pengguna tidak ditemukan.'
            );
    }

    // =========================
    // VALIDASI INPUT
    // =========================

    $request->validate([
        'id_member' => 'nullable',
        'plat_nomor' => 'required|max:15',
        'jenis_kendaraan' => 'required|max:50',
        'id_area' => 'required',
    ]);

    // Rapikan plat nomor
    $platNomor = strtoupper(
        trim($request->input('plat_nomor'))
    );

    $member = null;

    // =========================
    // CEK MEMBER
    // =========================

    if ($request->input('id_member')) {

        $member = Member::where(
            'id_member',
            $request->input('id_member')
        )->first();

        if (!$member) {

            return redirect()
                ->route('petugas.transaksi.masuk')
                ->with(
                    'error',
                    'Member tidak ditemukan.'
                );
        }

        // Jika member dipilih,
        // plat nomor mengikuti data member
        $platNomor = strtoupper(
            trim($member->plat_nomor)
        );

        // Jenis kendaraan juga mengikuti member
        $jenisKendaraan = $member->jenis_kendaraan;

    } else {

        // =========================
        // NON-MEMBER
        // =========================

        $jenisKendaraan =
            $request->input('jenis_kendaraan');

        // Cek apakah nopol ternyata sudah
        // terdaftar sebagai member
        $memberTerdaftar = Member::where(
            'plat_nomor',
            $platNomor
        )->first();

        if ($memberTerdaftar) {

            return redirect()
                ->route('petugas.transaksi.masuk')
                ->with(
                    'error',
                    'Plat nomor ' .
                    $platNomor .
                    ' sudah terdaftar sebagai member ' .
                    $memberTerdaftar->nama .
                    '. Silakan pilih member tersebut.'
                );
        }
    }

    // =========================
    // CEK KENDARAAN MASIH PARKIR
    // =========================

    $transaksiAktif = Transaksi::where(
        'plat_nomor',
        $platNomor
    )
    ->where(
        'status',
        'masuk'
    )
    ->first();

    if ($transaksiAktif) {

        return redirect()
            ->route('petugas.transaksi.masuk')
            ->with(
                'error',
                'Kendaraan dengan plat nomor ' .
                $platNomor .
                ' masih berada di area parkir.'
            );
    }

    // =========================
    // CEK AREA PARKIR
    // =========================

    $area = AreaParkir::where(
        'id_area',
        $request->input('id_area')
    )->first();

    if (!$area) {

        return redirect()
            ->route('petugas.transaksi.masuk')
            ->with(
                'error',
                'Area parkir tidak ditemukan.'
            );
    }

    // Cek kapasitas
    if ($area->terisi >= $area->kapasitas) {

        return redirect()
            ->route('petugas.transaksi.masuk')
            ->with(
                'error',
                'Area parkir ' .
                $area->nama_area .
                ' sudah penuh.'
            );
    }

    // =========================
    // CARI TARIF
    // =========================

    $tarif = Tarif::where(
        'jenis_kendaraan',
        $jenisKendaraan
    )->first();

    if (!$tarif) {

        return redirect()
            ->route('petugas.transaksi.masuk')
            ->with(
                'error',
                'Tarif untuk kendaraan ' .
                $jenisKendaraan .
                ' belum tersedia.'
            );
    }

    // =========================
    // BUAT TRANSAKSI
    // =========================

    $transaksi = Transaksi::create([
        'id_user' => $user->id,

        'id_member' => $member
            ? $member->id_member
            : null,

        'plat_nomor' => $platNomor,

        'id_area' => $area->id_area,

        'id_tarif' => $tarif->id_tarif,

        'durasi_jam' => 0,

        'biaya_total' => 0,

        'waktu_masuk' => date('Y-m-d H:i:s'),

        'waktu_keluar' => null,

        'status' => 'masuk',
    ]);

    // =========================
    // TAMBAH JUMLAH TERISI
    // =========================

    $area->update([
        'terisi' => $area->terisi + 1
    ]);

    // =========================
    // CETAK TIKET
    // =========================

    return redirect()
        ->route(
            'petugas.transaksi.cetakTiket',
            [
                'id' => $transaksi->id_parkir
            ]
        )
        ->with(
            'success',
            'Berhasil mencatat kendaraan masuk!'
        );
}

    /**
     * Proses simpan transaksi parkir keluar
     */
    public function updateKeluar(Request $request, $id)
    {
        $transaksi = Transaksi::where('id_parkir', $id)->first();

        if (!$transaksi) {
            return redirect()
                ->route('petugas.transaksi.index')
                ->with('error', 'Data transaksi tidak ditemukan.');
        }

        if ($transaksi->status !== 'masuk') {
            return redirect()
                ->route('petugas.transaksi.index')
                ->with('error', 'Transaksi ini sudah diproses keluar.');
        }

        // Ambil tarif yang sudah ditentukan saat kendaraan masuk
        $tarif = Tarif::where(
            'id_tarif',
            $transaksi->id_tarif
        )->first();

        if (!$tarif) {
            return redirect()
                ->route('petugas.transaksi.index')
                ->with('error', 'Tarif transaksi tidak ditemukan.');
        }

        // Waktu keluar ditentukan server
        $waktuKeluar = date('Y-m-d H:i:s');

        // Hitung durasi
        $waktuMasukTimestamp = strtotime($transaksi->waktu_masuk);
        $waktuKeluarTimestamp = strtotime($waktuKeluar);

        $selisihDetik = $waktuKeluarTimestamp - $waktuMasukTimestamp;

        $durasiJam = (int) ceil($selisihDetik / 3600);

        if ($durasiJam < 1) {
            $durasiJam = 1;
        }

        // Hitung biaya
        $biayaTotal = $tarif->tarif_per_jam * $durasiJam;

        // Update transaksi
        $transaksi->update([
            'waktu_keluar' => $waktuKeluar,
            'durasi_jam' => $durasiJam,
            'biaya_total' => $biayaTotal,
            'status' => 'keluar',
        ]);

        // Kurangi jumlah kendaraan di area
        $area = AreaParkir::where(
            'id_area',
            $transaksi->id_area
        )->first();

        if ($area && $area->terisi > 0) {
            $area->update([
                'terisi' => $area->terisi - 1
            ]);
        }

        return redirect()
            ->route('petugas.transaksi.cetakStruk', [
                'id' => $transaksi->id_parkir
            ])
            ->with(
                'success',
                'Transaksi keluar berhasil diproses.'
            );
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

    /**
 * Form kendaraan keluar
 */
public function editKeluar(Request $request, $id)
{
    $transaksi = Transaksi::where(
        'id_parkir',
        $id
    )->first();

    if (!$transaksi) {
        return redirect()
            ->route('petugas.transaksi.index')
            ->with(
                'error',
                'Transaksi tidak ditemukan.'
            );
    }

    if ($transaksi->status !== 'masuk') {
        return redirect()
            ->route('petugas.transaksi.index')
            ->with(
                'error',
                'Kendaraan sudah diproses keluar.'
            );
    }

    // Waktu keluar ditentukan server
    $waktuKeluar = date('Y-m-d H:i:s');

    // Hitung durasi parkir
    $waktuMasukTimestamp = strtotime(
        $transaksi->waktu_masuk
    );

    $waktuKeluarTimestamp = strtotime(
        $waktuKeluar
    );

    $selisihDetik =
        $waktuKeluarTimestamp -
        $waktuMasukTimestamp;

    $durasiJam = (int) ceil(
        $selisihDetik / 3600
    );

    if ($durasiJam < 1) {
        $durasiJam = 1;
    }

    // Ambil tarif yang sudah disimpan
    // ketika kendaraan masuk
    $tarif = Tarif::where(
        'id_tarif',
        $transaksi->id_tarif
    )->first();

    if (!$tarif) {
        return redirect()
            ->route('petugas.transaksi.index')
            ->with(
                'error',
                'Tarif transaksi tidak ditemukan.'
            );
    }

    // Hitung total biaya
    $biayaTotal =
        $tarif->tarif_per_jam *
        $durasiJam;

    return view(
        'petugas.transaksi.keluar',
        [
            'transaksi' => $transaksi,
            'waktuKeluar' => $waktuKeluar,
            'durasiJam' => $durasiJam,
            'tarif' => $tarif,
            'biayaTotal' => $biayaTotal,
        ]
    );
}
}