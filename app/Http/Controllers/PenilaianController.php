<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Kelas;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $userRole = session('user_role');
        $idGuru = session('id_guru');

        if ($userRole === 'wali_kelas') {
            $kelasIds = Kelas::where('wali_kelas', $idGuru)->pluck('id_kelas');
            $siswa = Siswa::whereIn('id_kelas', $kelasIds)->get();
        } else {
            $siswa = Siswa::all();
        }

        $penilaian = Penilaian::with(['siswa', 'kriteria'])->get();
        $kriteria = Kriteria::all();

        return view('siswa.penilaian', compact('penilaian', 'siswa', 'kriteria'));
    }

    public function store(Request $request)
    {
        $userRole = session('user_role');
        $idGuru = session('id_guru');

        // Bersihkan nilai jika input kriteria adalah penghasilan (id_kriteria = 4)
        $nilai = $request->nilai;
        if ($request->id_kriteria == 4) {
            $nilai = str_replace(['Rp', '.', ' '], '', $nilai);
        }
        $request->merge(['nilai' => $nilai]);

        // Validasi awal
        $request->validate([
            'nis' => 'required|exists:tbl_siswa,nis',
            'id_kriteria' => 'required|exists:tbl_kriteria,id_kriteria',
            'nilai' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->id_kriteria != 4 && (!is_numeric($value) || $value < 0 || $value > 100)) {
                        $fail('Nilai harus berupa angka antara 0 - 100 kecuali untuk kriteria Penghasilan Orang Tua.');
                    }

                    if ($request->id_kriteria == 4 && (!is_numeric($value) || $value < 0)) {
                        $fail('Nilai Penghasilan Orang Tua harus berupa angka dan tidak boleh negatif.');
                    }
                },
            ],
        ]);

        // Validasi akses wali kelas
        if ($userRole === 'wali_kelas') {
            $kelasIds = Kelas::where('wali_kelas', $idGuru)->pluck('id_kelas')->toArray();
            $siswa = Siswa::where('nis', $request->nis)->first();

            if (!$siswa || !in_array($siswa->id_kelas, $kelasIds)) {
                return redirect()->back()->with('error', 'Anda tidak berhak menilai siswa ini.');
            }
        }

        Penilaian::create([
            'nis' => $request->nis,
            'id_kriteria' => $request->id_kriteria,
            'nilai' => $nilai
        ]);

        return redirect()->back()->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $nilai = $request->nilai;

        if ($penilaian->id_kriteria == 4) {
            $nilai = str_replace(['Rp', '.', ' '], '', $nilai);
        }

        $request->merge(['nilai' => $nilai]);

        $request->validate([
            'nilai' => [
                'required',
                function ($attribute, $value, $fail) use ($penilaian) {
                    if ($penilaian->id_kriteria != 4 && (!is_numeric($value) || $value < 0 || $value > 100)) {
                        $fail('Nilai harus berupa angka antara 0 - 100 kecuali untuk kriteria Penghasilan Orang Tua.');
                    }

                    if ($penilaian->id_kriteria == 4 && (!is_numeric($value) || $value < 0)) {
                        $fail('Nilai Penghasilan Orang Tua harus berupa angka dan tidak boleh negatif.');
                    }
                },
            ],
        ]);

        $penilaian->update(['nilai' => $nilai]);

        return redirect()->back()->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->back()->with('success', 'Penilaian berhasil dihapus.');
    }
}
