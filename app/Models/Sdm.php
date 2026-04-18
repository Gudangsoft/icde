<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sdm extends Model
{
    protected $table = 'sdm';
    protected $fillable = ['nama', 'jabatan', 'deskripsi', 'keahlian', 'pendidikan', 'foto', 'urutan', 'aktif'];
}
