<?php

namespace App\Controllers\Core;

use App\Models\Role;
use App\Models\User;
use App\Models\LogAktivitas;
use Sakuci\Controller;
use Sakuci\Http\Request;

/** Halaman admin untuk menambah user dan menentukan role-nya. */
class UserController extends Controller
{
    public function index()
    {
        return view('core.admin.users.index', [
            'users' => User::orderBy('username')->get(),
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|min:3|max:50|alpha_dash|unique:users,username',
            'nama_lengkap' => 'required|min:3|max:100',
            'password' => 'required|min:6',
            'role'     => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'username' => $data['username'],
            'nama_lengkap' => $data['nama_lengkap'],
            'password' => password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            ),
            'role' => $data['role'],
        ]);

        LogAktivitas::catat(
            'CREATE',
            'Menambahkan user ' .
            $user->username .
            ' dengan role ' .
            $user->role .
            '.'
        );

        return back()->with(
            'success',
            'User "' .
            $data['username'] .
            '" berhasil ditambahkan.'
        );
    }


    // 1. Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view(
            'core.admin.users.edit',
            compact(
                'user',
                'roles'
            )
        );
    }


    // 2. Memproses update data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        /*
         * Simpan data lama untuk log aktivitas
         */
        $usernameLama = $user->username;
        $namaLama = $user->nama_lengkap;
        $roleLama = $user->role;

        $rules = [
            'username' =>
                'required|min:3|max:50|alpha_dash|unique:users,username,' . $id,

            'nama_lengkap' =>
                'required|min:3|max:100',

            'role' =>
                'required',
        ];

        // Password opsional saat edit
        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $data = $request->validate($rules);

        $updateData = [
            'username' => $data['username'],
            'nama_lengkap' => $data['nama_lengkap'],
            'role' => $data['role'],
        ];

        if ($request->filled('password')) {
            $updateData['password'] =
                password_hash(
                    $data['password'],
                    PASSWORD_DEFAULT
                );
        }

        $user->update($updateData);

        /*
         * Catat aktivitas
         */
        LogAktivitas::catat(
            'UPDATE',
            'Mengubah user ' .
            $usernameLama .
            ' (' .
            $namaLama .
            ', role ' .
            $roleLama .
            ') menjadi ' .
            $user->username .
            ' (' .
            $user->nama_lengkap .
            ', role ' .
            $user->role .
            ').'
        );

        return redirect('/admin/users')
            ->with(
                'success',
                'Data user berhasil diperbarui.'
            );
    }


    // 3. Memproses hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        /*
         * Simpan data sebelum dihapus
         */
        $username = $user->username;
        $namaLengkap = $user->nama_lengkap;
        $role = $user->role;

        $user->delete();

        /*
         * Catat aktivitas
         */
        LogAktivitas::catat(
            'DELETE',
            'Menghapus user ' .
            $username .
            ' (' .
            $namaLengkap .
            ', role ' .
            $role .
            ').'
        );

        return back()->with(
            'success',
            'User berhasil dihapus.'
        );
    }
}