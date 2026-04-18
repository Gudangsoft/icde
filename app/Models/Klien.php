<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    protected $table = 'klien';
    protected $fillable = ['nama', 'logo', 'website', 'urutan', 'aktif'];
}
