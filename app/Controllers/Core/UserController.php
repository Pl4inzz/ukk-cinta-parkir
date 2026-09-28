<?php

namespace App\Controllers\Core;

use App\Models\Role;
use App\Models\User;
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

        User::create([
            'username' => $data['username'],
            'nama_lengkap' => $data['nama_lengkap'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role'     => $data['role'],
        ]);

        return back()->with('success', 'User "' . $data['username'] . '" berhasil ditambahkan.');
    }

    // 1. Menampilkan form edit user
public function edit($id)
{
    $user = User::findOrFail($id);
    $roles = Role::all(); // sesuaikan jika ada model Role
    return view('core.admin.users.edit', compact('user', 'roles'));
}

// 2. Memproses update data user
public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $rules = [
        'username'     => 'required|min:3|max:50|alpha_dash|unique:users,username,' . $id,
        'nama_lengkap' => 'required|min:3|max:100',
        'role'         => 'required',
    ];

    // Password opsional saat edit (diisi jika ingin ganti saja)
    if ($request->filled('password')) {
        $rules['password'] = 'min:6';
    }

    $data = $request->validate($rules);

    $updateData = [
        'username'     => $data['username'],
        'nama_lengkap' => $data['nama_lengkap'],
        'role'         => $data['role'],
    ];

    if ($request->filled('password')) {
        $updateData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    $user->update($updateData);

    return redirect('/admin/users')->with('success', 'Data user berhasil diperbarui.');
}

// 3. Memproses hapus user
public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return back()->with('success', 'User berhasil dihapus.');
}
}

