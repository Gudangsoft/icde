<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'judul', 'subjudul', 'deskripsi', 'gambar',
        'teks_tombol', 'link_tombol', 'warna_teks', 'urutan', 'aktif', 'hanya_gambar',
    ];

    protected $casts = ['aktif' => 'boolean', 'hanya_gambar' => 'boolean'];
}
