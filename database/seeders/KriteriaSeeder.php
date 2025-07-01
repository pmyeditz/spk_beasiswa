<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $kriteria = [
            ['nama_kriteria' => 'Nilai Rapor',     'bobot' => '0.4', 'sifat' => 'benefit'],
            ['nama_kriteria' => 'Prestasi',        'bobot' => '0.3', 'sifat' => 'benefit'],
            ['nama_kriteria' => 'Kehadiran',       'bobot' => '0.2', 'sifat' => 'benefit'],
            ['nama_kriteria' => 'Penghasilan Ortu', 'bobot' => '0.1', 'sifat' => 'cost'],
        ];

        foreach ($kriteria as $item) {
            DB::table('tbl_kriteria')->insert([
                'nama_kriteria' => $item['nama_kriteria'],
                'bobot' => $item['bobot'],
                'sifat' => $item['sifat'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
