<?php
// app/Models/Siswa.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'tbl_siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nis', 'nama_lengkap', 'jenis_kelamin', 'nilai_rapor', 'id_kelas'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'nis', 'nis');
    }

    public function keputusan()
    {
        return $this->hasOne(Keputusan::class, 'nis', 'nis');
    }
}
