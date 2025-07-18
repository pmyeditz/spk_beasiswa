<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaController extends Controller
{
    // Tampilkan data siswa
    public function index()
    {
        $userRole = session('user_role');
        $idGuru = session('id_guru');

        if ($userRole === 'wali_kelas') {
            // Hanya ambil siswa dari kelas yang diampu wali kelas
            $kelasIds = Kelas::where('wali_kelas', $idGuru)->pluck('id_kelas');
            $siswa = Siswa::with('kelas')->whereIn('id_kelas', $kelasIds)->get();
            $kelas = Kelas::whereIn('id_kelas', $kelasIds)->get();
        } else {
            // Admin dan kepala sekolah bisa lihat semua
            $siswa = Siswa::with('kelas')->get();
            $kelas = Kelas::all();
        }

        return view('siswa.index', compact('siswa', 'kelas'));
    }

    // Simpan siswa baru
    public function store(Request $request)
    {
        $userRole = session('user_role');
        $idGuru = session('id_guru');

        $request->validate([
            'nis' => 'required|unique:tbl_siswa,nis',
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nilai_rapor' => 'required|numeric|min:0|max:100',
            'id_kelas' => 'required|exists:tbl_kelas,id_kelas',
        ]);

        // Cegah wali kelas menambahkan siswa ke kelas yang bukan miliknya
        if ($userRole === 'wali_kelas') {
            $kelasDiampu = Kelas::where('wali_kelas', $idGuru)->pluck('id_kelas')->toArray();

            if (!in_array($request->id_kelas, $kelasDiampu)) {
                return back()->with('error', 'Anda tidak berhak menambahkan siswa ke kelas ini.');
            }
        }

        Siswa::create([
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nilai_rapor' => $request->nilai_rapor,
            'id_kelas' => $request->id_kelas,
        ]);



        session()->flash('success', 'Data siswa berhasil ditambahkan.');
        return view('auth.loading', [
            'redirectTo' => route('siswa.index')
        ]);
    }

    // Tampilkan form edit
    public function edit($nis)
    {
        $siswa = Siswa::findOrFail($nis);
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    // Update data siswa
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

        session()->flash('success', 'Data siswa berhasil diperbarui.');
        return view('auth.loading', [
            'redirectTo' => route('siswa.index')
        ]);
    }

    // Hapus siswa
    public function destroy($nis)
    {
        $siswa = Siswa::findOrFail($nis);
        $siswa->delete();

        session()->flash('success', 'Data siswa berhasil dihapus.');
        return view('auth.loading', [
            'redirectTo' => route('siswa.index')
        ]);
    }


    public function download()
    {
        \Carbon\Carbon::setLocale('id');

        $userRole = session('user_role');
        $idGuru = session('id_guru');

        if ($userRole === 'wali_kelas') {
            $kelasIds = Kelas::where('wali_kelas', $idGuru)->pluck('id_kelas');
            $siswa = Siswa::with('kelas')->whereIn('id_kelas', $kelasIds)->get();
            $waliKelas = Guru::where('id_guru', $idGuru)->first();
        } else {
            $siswa = Siswa::with('kelas')->get();
            $waliKelas = null;
        }

        $kepalaSekolah = Guru::where('role', 'kepala_sekolah')->first();

        $pdf = Pdf::loadView('siswa.pdf', compact('siswa', 'kepalaSekolah', 'waliKelas'));
        return $pdf->stream('data-siswa.pdf');
    }
}
