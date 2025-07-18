<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Guru;

class LoginController extends Controller
{

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // pastikan file ini ada
    }

    // Proses login
    public function loginProcess(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 🔍 Cek login sebagai admin
        $admin = Admin::where('username', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'user_id'    => $admin->id_admin,
                'user_name'  => $admin->nama_admin,
                'username'   => $admin->username,
                'email'      => $admin->email,
                'user_role'  => 'admin',
            ]);

            return view('auth.loading', ['redirectTo' => route('admin.dashboard')]);
        }

        // 🔍 Cek login sebagai guru
        $guru = Guru::where('username', $request->username)->first();
        if ($guru && Hash::check($request->password, $guru->password)) {
            session([
                'user_id'    => $guru->id_guru,
                'user_name'  => $guru->nama_guru,
                'username'   => $guru->username,
                'email'      => $guru->email,
                'user_role'  => $guru->role,
                'id_guru'    => $guru->id_guru,
            ]);

            return view('auth.loading', ['redirectTo' => route('admin.dashboard')]);
        }

        // ❌ Jika gagal login → arahkan ke loading lalu kembali ke login
        return view('auth.loading', ['redirectTo' => route('login')]);
    }

    // Logout
    public function logout()
    {
        session()->flush();

        // Redirect ke loading page dulu, lalu baru ke login
        return view('auth.loading', [
            'redirectTo' => route('login'),
            'message' => 'Berhasil logout. Anda akan diarahkan ke halaman login.'
        ]);
    }
}
