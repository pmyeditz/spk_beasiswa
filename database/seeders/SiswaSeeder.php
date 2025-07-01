<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = [
            [
                'nis' => '1230000001',
                'nama_lengkap' => 'Karsa Haryanti, S.Pd',
                'jenis_kelamin' => 'Perempuan',
                'nilai_rapor' => 87.50,
                'id_kelas' => 1,
            ],
            [
                'nis' => '1230000002',
                'nama_lengkap' => 'Bayu Wirawan',
                'jenis_kelamin' => 'Laki-laki',
                'nilai_rapor' => 85.20,
                'id_kelas' => 1,
            ],
            [
                'nis' => '1230000003',
                'nama_lengkap' => 'Siti Marwah',
                'jenis_kelamin' => 'Perempuan',
                'nilai_rapor' => 90.10,
                'id_kelas' => 1,
            ],
            [
                'nis' => '1230000004',
                'nama_lengkap' => 'Rudi Hartono',
                'jenis_kelamin' => 'Laki-laki',
                'nilai_rapor' => 88.90,
                'id_kelas' => 2,
            ],
            [
                'nis' => '1230000005',
                'nama_lengkap' => 'Dewi Aulia',
                'jenis_kelamin' => 'Perempuan',
                'nilai_rapor' => 82.40,
                'id_kelas' => 2,
            ],
            [
                'nis' => '1230000006',
                'nama_lengkap' => 'Fajar Nugraha',
                'jenis_kelamin' => 'Laki-laki',
                'nilai_rapor' => 78.75,
                'id_kelas' => 2,
            ],
            [
                'nis' => '1230000007',
                'nama_lengkap' => 'Nuraini Zahra',
                'jenis_kelamin' => 'Perempuan',
                'nilai_rapor' => 91.25,
                'id_kelas' => 3,
            ],
            [
                'nis' => '1230000008',
                'nama_lengkap' => 'Rangga Saputra',
                'jenis_kelamin' => 'Laki-laki',
                'nilai_rapor' => 76.00,
                'id_kelas' => 3,
            ],
            [
                'nis' => '1230000009',
                'nama_lengkap' => 'Vina Melati',
                'jenis_kelamin' => 'Perempuan',
                'nilai_rapor' => 89.50,
                'id_kelas' => 3,
            ],
            [
                'nis' => '1230000010',
                'nama_lengkap' => 'Agung Rahmat',
                'jenis_kelamin' => 'Laki-laki',
                'nilai_rapor' => 84.60,
                'id_kelas' => 1,
            ],
        ];

        foreach ($siswa as $item) {
            DB::table('tbl_siswa')->insert([
                'nis' => $item['nis'],
                'nama_lengkap' => $item['nama_lengkap'],
                'jenis_kelamin' => $item['jenis_kelamin'],
                'nilai_rapor' => $item['nilai_rapor'],
                'id_kelas' => $item['id_kelas'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
