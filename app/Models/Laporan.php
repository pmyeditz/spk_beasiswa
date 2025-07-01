<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'tbl_laporan';

    protected $fillable = ['nis', 'nama_siswa', 'nilai_akhir', 'status'];
}
