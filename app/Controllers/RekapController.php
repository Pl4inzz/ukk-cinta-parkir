<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use Sakuci\Controller;
use Sakuci\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->only([
            'tanggal_mulai',
            'tanggal_selesai'
        ]);

        $tanggalMulai = $data['tanggal_mulai'] ?? null;
        $tanggalSelesai = $data['tanggal_selesai'] ?? null;

        $query = Transaksi::where('status', 'keluar');

        if ($tanggalMulai) {
            $query = $query->where(
                'waktu_keluar',
                '>=',
                $tanggalMulai . ' 00:00:00'
            );
        }

        if ($tanggalSelesai) {
            $query = $query->where(
                'waktu_keluar',
                '<=',
                $tanggalSelesai . ' 23:59:59'
            );
        }

        $transaksi = $query
            ->orderBy('waktu_keluar', 'desc')
            ->get();

        $totalTransaksi = count($transaksi);

        $totalPendapatan = 0;

        foreach ($transaksi as $item) {
            $totalPendapatan += (int) $item->biaya_total;
        }

        return view('owner.rekap', [
            'user' => User::current(),
            'transaksi' => $transaksi,
            'totalTransaksi' => $totalTransaksi,
            'totalPendapatan' => $totalPendapatan,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
        ]);
    }


    public function cetak(Request $request)
    {
        $data = $request->only([
            'tanggal_mulai',
            'tanggal_selesai'
        ]);

        $tanggalMulai = $data['tanggal_mulai'] ?? null;
        $tanggalSelesai = $data['tanggal_selesai'] ?? null;

        $query = Transaksi::where('status', 'keluar');

        if ($tanggalMulai) {
            $query = $query->where(
                'waktu_keluar',
                '>=',
                $tanggalMulai . ' 00:00:00'
            );
        }

        if ($tanggalSelesai) {
            $query = $query->where(
                'waktu_keluar',
                '<=',
                $tanggalSelesai . ' 23:59:59'
            );
        }

        $transaksi = $query
            ->orderBy('waktu_keluar', 'asc')
            ->get();

        $totalTransaksi = count($transaksi);

        $totalPendapatan = 0;

        foreach ($transaksi as $item) {
            $totalPendapatan += (int) $item->biaya_total;
        }

        return view('owner.cetak', [
            'user' => User::current(),
            'transaksi' => $transaksi,
            'totalTransaksi' => $totalTransaksi,
            'totalPendapatan' => $totalPendapatan,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
        ]);
    }
}