<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $role = session('user_role');

        // Cegah akses jika bukan admin atau kepala sekolah
        if (!in_array($role, ['admin', 'kepala_sekolah'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $kelas = Kelas::orderBy('nama_kelas')->get();
        $guru = Guru::where('role', 'wali_kelas')->orderBy('nama_guru')->get();

        return view('siswa.kelas', compact('kelas', 'guru'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'wali_kelas' => 'nullable|string|max:100',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas' => $request->wali_kelas,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
