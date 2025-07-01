<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = Admin::find(session('admin_id'));
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $admin = Admin::find(session('admin_id'));
        $admin->nama_admin = $request->nama_admin;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
