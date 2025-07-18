<?php

namespace App\Http\Controllers;

// use PDF;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Laporan;
use App\Models\Kriteria;
// use Barryvdh\DomPDF\PDF;
use App\Models\Keputusan;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KeputusanController extends Controller
{
    public function index()
    {
        $keputusan = Keputusan::with('siswa')->orderByDesc('nilai_akhir')->get();
        return view('siswa.keputusan', compact('keputusan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,diterima,ditolak',
        ]);

        $keputusan = Keputusan::findOrFail($id);
        $keputusan->status = $request->status;
        $keputusan->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $keputusan = Keputusan::findOrFail($id);
        $keputusan->delete();

        return redirect()->back()->with('success', 'Data keputusan dihapus.');
    }

    public function hitungSAW()
    {
        $kriteria = Kriteria::all();
        $siswaList = Siswa::with('penilaian')->get();

        $nilaiMaks = [];
        $nilaiMin = [];

        // Hitung nilai maksimum dan minimum untuk setiap kriteria
        foreach ($kriteria as $k) {
            $nilaiPerKriteria = Penilaian::where('id_kriteria', $k->id_kriteria)
                ->pluck('nilai')
                ->map(fn($v) => floatval($v))
                ->filter(fn($v) => $v > 0);

            $nilaiMaks[$k->id_kriteria] = $nilaiPerKriteria->max() ?? 1;
            $nilaiMin[$k->id_kriteria] = $nilaiPerKriteria->min() ?? 1;
        }

        // Hitung nilai akhir (SAW) untuk setiap siswa
        foreach ($siswaList as $siswa) {
            $total = 0;

            foreach ($kriteria as $k) {
                $nilaiAsli = Penilaian::where('nis', $siswa->nis)
                    ->where('id_kriteria', $k->id_kriteria)
                    ->value('nilai');

                if ($nilaiAsli === null || $nilaiAsli == 0) continue;

                $nilaiAsli = floatval($nilaiAsli);
                $bobot = floatval($k->bobot);

                if ($bobot <= 0) continue;

                if ($k->sifat === 'benefit' && $nilaiMaks[$k->id_kriteria] > 0) {
                    $normal = $nilaiAsli / $nilaiMaks[$k->id_kriteria];
                } elseif ($k->sifat === 'cost' && $nilaiAsli > 0) {
                    $normal = $nilaiMin[$k->id_kriteria] / $nilaiAsli;
                } else {
                    $normal = 0;
                }

                $total += $normal * $bobot;
            }

            // Simpan ke tabel keputusan
            Keputusan::updateOrCreate(
                ['nis' => $siswa->nis],
                ['nilai_akhir' => number_format($total, 4), 'status' => 'diproses']
            );

            // Simpan ke tabel laporan
            Laporan::updateOrCreate(
                ['nis' => $siswa->nis],
                [
                    'nama_siswa' => $siswa->nama_lengkap,
                    'nilai_akhir' => number_format($total, 4),
                    'status' => 'diproses',
                ]
            );
        }

        // Ambang batas penerimaan beasiswa
        $ambang_batas = 0.75;

        // Ambil 3 nilai tertinggi
        $top = Keputusan::orderByDesc('nilai_akhir')->limit(3)->get();
        $jumlah_diterima = 0;

        foreach ($top as $item) {
            if ($item->nilai_akhir >= $ambang_batas) {
                $item->status = 'diterima';
                $item->save();

                Laporan::where('nis', $item->nis)->update(['status' => 'diterima']);
                $jumlah_diterima++;
            }
        }

        if ($jumlah_diterima === 0) {
            return redirect()->route('keputusan.index')->with('warning', 'Perhitungan selesai, namun tidak ada siswa yang memenuhi ambang batas beasiswa.');
        }

        return redirect()->route('keputusan.index')->with('success', "Perhitungan SAW selesai & {$jumlah_diterima} siswa diterima.");
    }




    public function exportPDF($nis)
    {
        $userRole = session('user_role');
        $idGuru = session('id_guru');

        $siswa = Siswa::with(['penilaian.kriteria', 'kelas'])->where('nis', $nis)->firstOrFail();

        if ($userRole === 'wali_kelas') {
            $kelasIds = Kelas::where('wali_kelas', $idGuru)->pluck('id_kelas');

            if (!in_array($siswa->id_kelas, $kelasIds->toArray())) {
                abort(403, 'Anda tidak memiliki akses ke data siswa ini.');
            }
        }

        $data = [];
        $total = 0;

        foreach ($siswa->penilaian as $penilaian) {
            $nilai = floatval($penilaian->nilai);
            $bobot = floatval($penilaian->kriteria->bobot);
            $sifat = $penilaian->kriteria->sifat;

            $max = Penilaian::where('id_kriteria', $penilaian->id_kriteria)->max('nilai') ?? 1;
            $min = Penilaian::where('id_kriteria', $penilaian->id_kriteria)->min('nilai') ?? 1;

            $normalisasi = $sifat === 'benefit'
                ? ($max > 0 ? $nilai / $max : 0)
                : ($nilai > 0 ? $min / $nilai : 0);

            $hasil = $normalisasi * $bobot;

            $data[] = [
                'kriteria'     => $penilaian->kriteria->nama_kriteria,
                'nilai'        => $nilai,
                'bobot'        => $bobot,
                'sifat'        => $sifat,
                'normalisasi'  => round($normalisasi, 4),
                'hasil'        => round($hasil, 4),
            ];

            $total += $hasil;
        }

        $waliKelas = null;
        if ($siswa->kelas && isset($siswa->kelas->wali_kelas)) {
            $waliKelas = Guru::where('id_guru', $siswa->kelas->wali_kelas)->first();
        }

        $kepalaSekolah = Guru::where('role', 'kepala_sekolah')->first();

        $pdf = Pdf::loadView('siswa.keputusan_pdf', [
            'siswa' => $siswa,
            'data' => $data,
            'total' => round($total, 4),
            'waliKelas' => $waliKelas,
            'kepalaSekolah' => $kepalaSekolah,
        ]);

        // 💡 tampilkan di browser, bukan download
        return $pdf->stream("keputusan_saw_{$siswa->nis}.pdf");
    }
}
