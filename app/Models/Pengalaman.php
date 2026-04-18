<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
    protected $table = 'pengalaman';
    protected $fillable = ['nama_proyek', 'pemberi_kerja', 'lokasi', 'tahun', 'deskripsi', 'kategori', 'urutan', 'logo', 'galeri_proyek'];
    
    protected $casts = [
        'galeri_proyek' => 'array',
    ];
}
