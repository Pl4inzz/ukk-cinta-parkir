<?php

namespace App\Controllers\Core;

use App\Models\Role;
use App\Models\User;
use App\Models\LogAktivitas;
use Sakuci\Controller;
use Sakuci\Http\Request;
use Sakuci\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('core.auth.login');
    }

    public function showRegister()
    {
        $roles = Role::where('can_register', 1)
            ->orderBy('name')
            ->get();

        if ($roles === []) {
            return redirect('/login')
                ->with(
                    'error',
                    'Pendaftaran belum dibuka.'
                );
        }

        return view(
            'core.auth.register',
            ['roles' => $roles]
        );
    }

    public function register(Request $request)
    {
        $allowed = Role::where(
            'can_register',
            1
        )
        ->pluck('name');

        if ($allowed === []) {
            return redirect('/login')
                ->with(
                    'error',
                    'Pendaftaran belum dibuka.'
                );
        }

        $data = $request->validate([
            'username' =>
                'required|min:3|max:50|alpha_dash|unique:users,username',

            'password' =>
                'required|min:6|confirmed',

            'role' =>
                'required|in:' .
                implode(',', $allowed),
        ]);

        $user = User::create([
            'username' => $data['username'],

            'password' =>
                password_hash(
                    $data['password'],
                    PASSWORD_DEFAULT
                ),

            'role' => $data['role'],
        ]);

        Session::put(
            'user_id',
            $user->id
        );

        return redirect('/dashboard')
            ->with(
                'success',
                'Pendaftaran berhasil. Selamat datang, ' .
                $user->username .
                '.'
            );
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::firstWhere(
            'username',
            $data['username']
        );

        if (
            !$user ||
            !password_verify(
                $data['password'],
                $user->password
            )
        ) {
            return back()
                ->withErrors([
                    'username' =>
                        'Username atau password salah.'
                ])
                ->withInput();
        }

        /*
         * Simpan user yang sedang login
         */
        Session::put(
            'user_id',
            $user->id
        );

        /*
         * Catat aktivitas login
         */
        LogAktivitas::catat(
            'LOGIN',
            'User ' .
            $user->username .
            ' berhasil login.'
        );

        /*
         * Tentukan dashboard berdasarkan role
         */
        if ($user->role === 'admin') {
            $redirect = '/admin';
        } elseif ($user->role === 'petugas') {
            $redirect = '/petugas';
        } elseif ($user->role === 'owner') {
            $redirect = '/owner';
        } else {
            $redirect = '/dashboard';
        }
        return redirect($redirect)
            ->with(
                'success',
                'Selamat datang, ' .
                $user->username .
                '.'
            );
    }

    public function logout()
    {
        /*
         * Ambil user sebelum session dihapus
         */
        $user = User::current();

        /*
         * Catat aktivitas logout
         */
        if ($user) {
            LogAktivitas::catat(
                'LOGOUT',
                'User ' .
                $user->username .
                ' keluar dari sistem.'
            );
        }

        /*
         * Hapus session login
         */
        Session::forget('user_id');

        return redirect('/login')
            ->with(
                'success',
                'Berhasil logout.'
            );
    }
}