<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakPesan extends Model
{
    protected $table = 'kontak_pesan';
    protected $fillable = ['nama', 'email', 'telepon', 'subjek', 'pesan', 'sudah_dibaca'];
}
