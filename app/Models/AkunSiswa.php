<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AkunSiswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_akun_siswa';
    protected $primaryKey = 'id_akun';

    protected $fillable = [
        'nis',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}
