<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Guru;

class ProfileController extends Controller
{
    public function index()
    {
        $role = session('user_role');

        if ($role === 'admin') {
            $user = Admin::find(session('user_id'));
        } else {
            $user = Guru::find(session('user_id'));
        }

        return view('admin.profile', ['user' => $user, 'role' => $role]);
    }

    public function update(Request $request)
    {
        $role = session('user_role');

        // Validasi sesuai role
        $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'nullable|email|max:100',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($role === 'admin') {
            $user = Admin::find(session('user_id'));
            $user->nama_admin = $request->nama;
        } else {
            $user = Guru::find(session('user_id'));
            $user->nama_guru = $request->nama;
        }

        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update session agar nama & email ikut berubah
        session([
            'user_name' => $request->nama,
            'email'     => $request->email,
        ]);

        session()->flash('success', 'Profil berhasil diperbarui.');
        return view('auth.loading', [
            'redirectTo' => route('admin.profile')
        ]);

        // return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
