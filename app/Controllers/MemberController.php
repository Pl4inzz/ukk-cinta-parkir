<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Member;
use App\Models\User;
use App\Models\LogAktivitas;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::all();
        $users = User::current();

        return view(
            'members.index',
            compact(
                'members',
                'users'
            )
        );
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_member' =>
                'required|max:50|unique:member,kode_member',

            'nama' =>
                'required|min:3|max:255',

            'plat_nomor' =>
                'required|min:3|max:15',

            'jenis_kendaraan' =>
                'required|in:motor,mobil,lainnya',

            'no_hp' =>
                'nullable',

            'status_aktif' =>
                'required|in:aktif,nonaktif',

            'tanggal_kadaluarsa' =>
                'nullable|date',
        ]);


        /*
         * Rapikan data sebelum disimpan
         */
        $data['kode_member'] =
            strtoupper(
                trim($data['kode_member'])
            );

        $data['plat_nomor'] =
            strtoupper(
                trim($data['plat_nomor'])
            );


        /*
         * Cek plat nomor
         * supaya tidak terdaftar di dua member
         */
        $memberTerdaftar = Member::where(
            'plat_nomor',
            $data['plat_nomor']
        )->first();

        if ($memberTerdaftar) {

            return redirect()
                ->route('members.index')
                ->with(
                    'error',
                    'Plat nomor ' .
                    $data['plat_nomor'] .
                    ' sudah terdaftar sebagai member ' .
                    $memberTerdaftar->nama .
                    '.'
                );
        }


        /*
         * Pendaftar otomatis adalah
         * user yang sedang login
         */
        $user = User::current();

        $data['id_user'] =
            $user ? $user->id : null;


        /*
         * Simpan member
         */
        $member = Member::create($data);


        /*
         * Catat aktivitas
         */
        LogAktivitas::catat(
            'CREATE',
            'Menambahkan member ' .
            $member->nama .
            ' dengan kode member ' .
            $member->kode_member .
            ' dan plat nomor ' .
            $member->plat_nomor .
            '.'
        );


        return redirect()
            ->route('members.index')
            ->with(
                'success',
                'Member berhasil ditambahkan.'
            );
    }


    public function edit($id)
    {
        $member = Member::findOrFail($id);

        return view(
            'members.edit',
            compact('member')
        );
    }


    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);


        /*
         * Simpan data lama
         * untuk kebutuhan log aktivitas
         */
        $namaLama = $member->nama;
        $kodeLama = $member->kode_member;
        $platLama = $member->plat_nomor;


        $data = $request->validate([
            'kode_member' =>
                'required|max:50|unique:member,kode_member,' .
                $id .
                ',id_member',

            'nama' =>
                'required|min:3|max:255',

            'plat_nomor' =>
                'required|min:3|max:15',

            'jenis_kendaraan' =>
                'required|in:motor,mobil,lainnya',

            'no_hp' =>
                'nullable',

            'status_aktif' =>
                'required|in:aktif,nonaktif',

            'tanggal_kadaluarsa' =>
                'nullable|date',
        ]);


        /*
         * Rapikan data
         */
        $data['kode_member'] =
            strtoupper(
                trim($data['kode_member'])
            );

        $data['plat_nomor'] =
            strtoupper(
                trim($data['plat_nomor'])
            );


        /*
         * Cek apakah plat nomor
         * sudah dipakai member lain
         */
        $memberTerdaftar = Member::where(
            'plat_nomor',
            $data['plat_nomor']
        )->first();

        if (
            $memberTerdaftar &&
            $memberTerdaftar->id_member != $id
        ) {

            return redirect()
                ->route(
                    'members.edit',
                    ['id' => $id]
                )
                ->with(
                    'error',
                    'Plat nomor ' .
                    $data['plat_nomor'] .
                    ' sudah digunakan oleh member ' .
                    $memberTerdaftar->nama .
                    '.'
                );
        }


        /*
         * Jangan mengubah id_user
         * saat edit.
         */
        unset($data['id_user']);


        $member->update($data);


        /*
         * Catat aktivitas
         */
        LogAktivitas::catat(
            'UPDATE',
            'Mengubah member ' .
            $namaLama .
            ' (' .
            $kodeLama .
            ', ' .
            $platLama .
            ') menjadi ' .
            $member->nama .
            ' (' .
            $member->kode_member .
            ', ' .
            $member->plat_nomor .
            ').'
        );


        return redirect()
            ->route('members.index')
            ->with(
                'success',
                'Data member berhasil diperbarui.'
            );
    }


    public function destroy($id)
    {
        $member = Member::findOrFail($id);


        /*
         * Simpan data sebelum dihapus
         */
        $namaMember = $member->nama;
        $kodeMember = $member->kode_member;
        $platNomor = $member->plat_nomor;


        $member->delete();


        /*
         * Catat aktivitas
         */
        LogAktivitas::catat(
            'DELETE',
            'Menghapus member ' .
            $namaMember .
            ' dengan kode member ' .
            $kodeMember .
            ' dan plat nomor ' .
            $platNomor .
            '.'
        );


        return redirect()
            ->route('members.index')
            ->with(
                'success',
                'Member berhasil dihapus.'
            );
    }
}