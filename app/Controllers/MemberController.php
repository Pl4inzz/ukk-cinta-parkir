<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    // 1. Menampilkan daftar member
    public function index(Request $request)
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    // 2. Menampilkan form tambah member
    public function create()
    {
        return view('members.create');
    }

    // 3. Memproses simpan data member baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_member'        => 'required|unique:member,kode_member',
            'nama'               => 'required|min:3|max:255',
            'plat_nomor'         => 'required|min:3|max:15',
            'jenis_kendaraan'    => 'required|string|max:50',
            'no_hp'              => 'nullable|max:20',
            'status_aktif'       => 'required|in:aktif,nonaktif',
            'tanggal_kadaluarsa' => 'nullable|date',
        ]);

        // Simpan id_user petugas yang sedang login jika ada session
        if (session('user_id')) {
            $data['id_user'] = session('user_id');
        }

        Member::create($data);

        return redirect('/admin/members')->with('success', 'Member berhasil ditambahkan.');
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
            'kode_member'        => 'required|unique:member,kode_member,' . $id,
            'nama'               => 'required|min:3|max:255',
            'plat_nomor'         => 'required|min:3|max:15',
            'jenis_kendaraan'    => 'required|string|max:50',
            'no_hp'              => 'nullable|string|max:20',
            'status_aktif'       => 'required|in:aktif,nonaktif',
            'tanggal_kadaluarsa' => 'nullable|date',
        ]);

        $member->update($data);

        return redirect('/admin/members')->with('success', 'Data member berhasil diperbarui.');
    }

    // 6. Memproses hapus member
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return back()->with('success', 'Member berhasil dihapus.');
    }
}