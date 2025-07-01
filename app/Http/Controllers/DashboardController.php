<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Keputusan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan') ?? Carbon::now()->format('m'); // Default: bulan ini

        $totalSiswa = Siswa::count();
        $totalKriteria = Kriteria::count();
        $totalDiterima = Keputusan::where('status', 'diterima')->count();
        $lastUpdated = Keputusan::latest('updated_at')->first()?->updated_at;

        // Ambil data berdasarkan bulan (pakai whereMonth & whereYear jika ingin akurat)
        $statusCounts = [
            'diterima' => Keputusan::whereMonth('updated_at', $bulan)->where('status', 'diterima')->count(),
            'diproses' => Keputusan::whereMonth('updated_at', $bulan)->where('status', 'diproses')->count(),
            'ditolak'  => Keputusan::whereMonth('updated_at', $bulan)->where('status', 'ditolak')->count(),
        ];

        return view('admin.index', compact(
            'totalSiswa',
            'totalKriteria',
            'totalDiterima',
            'lastUpdated',
            'statusCounts',
            'bulan'
        ));
    }
}
