<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Keputusan extends Model
{
    protected $table = 'tbl_keputusan';
    protected $fillable = ['nis', 'nilai_akhir', 'status'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}
