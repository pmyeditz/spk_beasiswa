<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_admin')->insert([
            'nama_admin' => 'Super Admin',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'email' => 'admin@example.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
