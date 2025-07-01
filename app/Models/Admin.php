<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama_admin',
        'username',
        'password',
        'email',
    ];

    protected $hidden = [
        'password',
    ];
}
