<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beranda extends Model
{
    protected $table = 'beranda';
    protected $fillable = ['judul', 'deskripsi', 'motto', 'gambar', 'aktif'];
}
