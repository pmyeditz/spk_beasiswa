<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }

    // Proses login
    public function loginProcess(Request $request)
    {
        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin_id' => $admin->id_admin]);
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'Username atau password salah.');
    }

    // Logout
    public function logout()
    {
        session()->forget('admin_id');

        // ✅ Ganti 'login.form' jadi 'login'
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
