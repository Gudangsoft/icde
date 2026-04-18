<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = ['judul', 'deskripsi', 'gambar', 'kategori', 'album', 'pengalaman_id', 'urutan', 'aktif'];

    public function pengalaman()
    {
        return $this->belongsTo(\App\Models\Pengalaman::class, 'pengalaman_id');
    }
}
