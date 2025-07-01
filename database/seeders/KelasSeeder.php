<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = [
            ['nama_kelas' => 'X IPA 1', 'wali_kelas' => 'Bu Rini'],
            ['nama_kelas' => 'X IPA 2', 'wali_kelas' => 'Pak Andi'],
            ['nama_kelas' => 'XI IPS 1', 'wali_kelas' => 'Bu Siti'],
            ['nama_kelas' => 'XI IPS 2', 'wali_kelas' => 'Pak Budi'],
            ['nama_kelas' => 'XII Bahasa', 'wali_kelas' => 'Bu Dewi'],
        ];

        foreach ($kelas as $data) {
            DB::table('tbl_kelas')->insert([
                'nama_kelas' => $data['nama_kelas'],
                'wali_kelas' => $data['wali_kelas'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
