<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('siswa.kriteria', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:20',
            'bobot' => 'required|numeric|min:0|max:1',
            'sifat' => 'required|in:benefit,cost',
        ]);

        Kriteria::create($request->all());

        return redirect()->back()->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:20',
            'bobot' => 'required|numeric|min:0|max:1',
            'sifat' => 'required|in:benefit,cost',
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update($request->all());

        return redirect()->back()->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->back()->with('success', 'Kriteria berhasil dihapus.');
    }
}
