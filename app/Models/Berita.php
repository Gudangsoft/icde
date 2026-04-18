<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul', 'slug', 'ringkasan', 'konten', 'gambar',
        'kategori', 'tanggal_publish', 'penulis', 'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'tanggal_publish' => 'date',
    ];

    public static function generateSlug(string $judul, ?int $excludeId = null): string
    {
        $slug = Str::slug($judul);
        $original = $slug;
        $i = 1;
        while (static::where('slug', $slug)->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))->exists()) {
            $slug = $original . '-' . $i++;
        }
        return $slug;
    }
}
