<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaController extends Controller
{
    // Tampilkan semua siswa
    public function index()
    {
        $siswa = Siswa::with('kelas')->get();
        $kelas = Kelas::all();
        return view('siswa.index', compact('siswa', 'kelas'));
    }

    // Simpan siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:tbl_siswa,nis',
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nilai_rapor' => 'required|numeric|min:0|max:100',
            'id_kelas' => 'required|exists:tbl_kelas,id_kelas',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nilai_rapor' => $request->nilai_rapor,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($nis)
    {
        $siswa = Siswa::findOrFail($nis);
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    // Proses update data siswa
    public function update(Request $request, $nis)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nilai_rapor' => 'required|numeric|min:0|max:100',
            'id_kelas' => 'required|exists:tbl_kelas,id_kelas',
        ]);

        $siswa = Siswa::findOrFail($nis);
        $siswa->update([
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nilai_rapor' => $request->nilai_rapor,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    // Hapus data siswa
    public function destroy($nis)
    {
        $siswa = Siswa::findOrFail($nis);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
