<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Member;
use App\Models\User;

class MemberController extends Controller
{
    // 1. Menampilkan daftar member
    public function index(Request $request)
    {
        $members = Member::all();
        $users = User::current();
        return view('members.index', compact('members', 'users'));
    }

    // 3. Memproses simpan data member baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_member'        => 'required|unique:member,kode_member',
            'nama'               => 'required|min:3|max:255',
            'plat_nomor'         => 'required|min:3|max:15',
            'jenis_kendaraan'    => 'required|string|max:50',
            'id_user'            => 'nullable', // Diizinkan menangkap pilihan petugas dari form
            'no_hp'              => 'nullable',
            'status_aktif'       => 'required|in:aktif,nonaktif',
            'tanggal_kadaluarsa' => 'nullable|date',
        ]);

        // Jika tidak ada petugas yang dipilih di dropdown, gunakan ID user yang sedang login
        if (empty($data['id_user'])) {
            $data['id_user'] = session('user_id') ?? null;
        }

        Member::create($data);

        return redirect()->route('members.index')->with('success', 'Member berhasil ditambahkan.');
    }

    // 4. Menampilkan form edit member
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    // 5. Memproses update data member
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $data = $request->validate([
            'kode_member'        => 'required|unique:member,kode_member,' . $id . ',id_member',
            'nama'               => 'required|min:3|max:255',
            'plat_nomor'         => 'required|min:3|max:15',
            'jenis_kendaraan'    => 'required|string|max:50',
            'no_hp'              => 'nullable',
            'status_aktif'       => 'required|in:aktif,nonaktif',
            'tanggal_kadaluarsa' => 'nullable|date',
        ]);

        $member->update($data);

        return redirect()->route('members.index')->with('success', 'Member berhasil ditambahkan.');
    }

    // 6. Memproses hapus member
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return back()->with('success', 'Member berhasil dihapus.');
    }
}