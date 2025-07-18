<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('guru')->insert([
            [
                'nama_guru' => 'Ahmad Wali',
                'nip' => '1978012312340001',
                'jenis_kelamin' => 'L',
                'no_hp' => '081234567890',
                'email' => 'ridho2.undhari@gmail.com',
                'role' => 'wali_kelas',
                'username' => 'walikelas',
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_guru' => 'Siti Kepala',
                'nip' => '1967051212340002',
                'jenis_kelamin' => 'P',
                'no_hp' => '081298765432',
                'email' => 'ridho1.undhari@gmail.com',
                'username' => 'kepalasekolah',
                'role' => 'kepala_sekolah',
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
