<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasi';

    protected $fillable = ['nama', 'jabatan', 'gelar', 'foto', 'parent_id', 'urutan', 'aktif'];

    protected $casts = ['aktif' => 'boolean'];

    public function parent()
    {
        return $this->belongsTo(StrukturOrganisasi::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(StrukturOrganisasi::class, 'parent_id')->orderBy('urutan');
    }

    public function getNamaLengkapAttribute(): string
    {
        return trim($this->nama . ($this->gelar ? ', ' . $this->gelar : ''));
    }
}
