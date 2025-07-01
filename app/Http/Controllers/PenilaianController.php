<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Siswa;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaian = Penilaian::with(['siswa', 'kriteria'])->get();
        $siswa = Siswa::all();
        $kriteria = Kriteria::all();

        return view('siswa.penilaian', compact('penilaian', 'siswa', 'kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|exists:tbl_siswa,nis',
            'id_kriteria' => 'required|exists:tbl_kriteria,id_kriteria',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        Penilaian::create($request->all());

        return redirect()->back()->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $penilaian->update(['nilai' => $request->nilai]);

        return redirect()->back()->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->back()->with('success', 'Penilaian berhasil dihapus.');
    }
}
