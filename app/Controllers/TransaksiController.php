<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Transaksi;
use App\Models\Tarif;
use App\Models\AreaParkir;
use App\Models\Member;
use App\Models\User;
use App\Models\LogAktivitas;

class TransaksiController extends Controller
{
    /**
     * Tampilkan daftar transaksi parkir (Aktif & Selesai)
     */
    public function index(Request $request)
    {
        $transaksiList = Transaksi::whereIn(
            'status',
            ['masuk', 'keluar']
        )->get();

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

        // =========================
        // NORMALISASI PLAT NOMOR
        // =========================

        $platNomor = strtoupper(
            preg_replace(
                '/\s+/',
                ' ',
                trim($request->input('plat_nomor'))
            )
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

            // Plat nomor mengikuti data member
            $platNomor = strtoupper(
                preg_replace(
                    '/\s+/',
                    ' ',
                    trim($member->plat_nomor)
                )
            );

            // Jenis kendaraan mengikuti data member
            $jenisKendaraan = $member->jenis_kendaraan;

        } else {

            // =========================
            // NON-MEMBER
            // =========================

            $jenisKendaraan =
                $request->input('jenis_kendaraan');

            // Cek apakah plat terdaftar sebagai member
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
        // VALIDASI FORMAT PLAT NOMOR
        // =========================

        if (!preg_match(
            '/^[A-Z]{1,2}\s?\d{1,4}\s?[A-Z]{1,3}$/',
            $platNomor
        )) {
            return redirect()
                ->route('petugas.transaksi.masuk')
                ->with(
                    'error',
                    'Format plat nomor tidak valid. Contoh: B 1234 XYZ.'
                );
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

        // Cek kapasitas area
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
        // LOG AKTIVITAS
        // =========================

        LogAktivitas::catat(
            'PARKIR_MASUK',
            'Kendaraan ' .
            $platNomor .
            ' masuk ke area ' .
            $area->nama_area .
            ' (' .
            $jenisKendaraan .
            ').'
        );

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
        $transaksi = Transaksi::where(
            'id_parkir',
            $id
        )->first();

        if (!$transaksi) {
            return redirect()
                ->route('petugas.transaksi.index')
                ->with(
                    'error',
                    'Data transaksi tidak ditemukan.'
                );
        }

        if ($transaksi->status !== 'masuk') {
            return redirect()
                ->route('petugas.transaksi.index')
                ->with(
                    'error',
                    'Transaksi ini sudah diproses keluar.'
                );
        }

        // =========================
        // AMBIL TARIF
        // =========================

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

        // =========================
        // WAKTU KELUAR
        // =========================

        $waktuKeluar = date('Y-m-d H:i:s');

        // =========================
        // HITUNG DURASI
        // =========================

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

        // =========================
        // HITUNG BIAYA
        // =========================

        $biayaNormal =
            $tarif->tarif_per_jam *
            $durasiJam;

        $diskon = 0;

        // Member mendapatkan diskon 20%
        if ($transaksi->id_member) {
            $diskon = $biayaNormal * 0.20;
        }

        // Biaya setelah diskon
        $biayaTotal =
            $biayaNormal - $diskon;

        // =========================
        // UPDATE TRANSAKSI
        // =========================

        $transaksi->update([
            'waktu_keluar' => $waktuKeluar,
            'durasi_jam' => $durasiJam,
            'biaya_total' => $biayaTotal,
            'status' => 'keluar',
        ]);

        // =========================
        // KURANGI JUMLAH TERISI
        // =========================

        $area = AreaParkir::where(
            'id_area',
            $transaksi->id_area
        )->first();

        if ($area && $area->terisi > 0) {
            $area->update([
                'terisi' => $area->terisi - 1
            ]);
        }

        // =========================
        // LOG AKTIVITAS
        // =========================

        LogAktivitas::catat(
            'PARKIR_KELUAR',
            'Kendaraan ' .
            $transaksi->plat_nomor .
            ' keluar dari area ' .
            ($area ? $area->nama_area : '-') .
            ' setelah parkir ' .
            $durasiJam .
            ' jam dengan biaya Rp ' .
            number_format(
                $biayaTotal,
                0,
                ',',
                '.'
            ) .
            '.'
        );

        // =========================
        // CETAK STRUK
        // =========================

        return redirect()
            ->route(
                'petugas.transaksi.cetakStruk',
                [
                    'id' => $transaksi->id_parkir
                ]
            )
            ->with(
                'success',
                'Transaksi keluar berhasil diproses.'
            );
    }

    /**
     * Tampilan cetak tiket parkir
     */
    public function cetakTiket(Request $request, $id)
    {
        $transaksi = Transaksi::where(
            'id_parkir',
            $id
        )->first();

        return view(
            'petugas.transaksi.cetak_tiket',
            [
                'transaksi' => $transaksi
            ]
        );
    }

    /**
     * Tampilan cetak struk pembayaran
     */
    public function cetakStruk(Request $request, $id)
    {
        $transaksi = Transaksi::where(
            'id_parkir',
            $id
        )->first();

        return view(
            'petugas.transaksi.cetak_struk',
            [
                'transaksi' => $transaksi
            ]
        );
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

        // =========================
        // WAKTU KELUAR
        // =========================

        $waktuKeluar = date('Y-m-d H:i:s');

        // =========================
        // HITUNG DURASI PARKIR
        // =========================

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

        // =========================
        // AMBIL TARIF
        // =========================

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

        // =========================
        // HITUNG BIAYA
        // =========================

        $biayaNormal =
            $tarif->tarif_per_jam *
            $durasiJam;

        $diskon = 0;

        // Member mendapatkan diskon 20%
        if ($transaksi->id_member) {
            $diskon = $biayaNormal * 0.20;
        }

        // Biaya akhir setelah diskon
        $biayaTotal =
            $biayaNormal - $diskon;

        // =========================
        // TAMPILKAN HALAMAN KELUAR
        // =========================

        return view(
            'petugas.transaksi.keluar',
            [
                'transaksi' => $transaksi,
                'waktuKeluar' => $waktuKeluar,
                'durasiJam' => $durasiJam,
                'tarif' => $tarif,
                'biayaNormal' => $biayaNormal,
                'diskon' => $diskon,
                'biayaTotal' => $biayaTotal,
            ]
        );
    }
}
