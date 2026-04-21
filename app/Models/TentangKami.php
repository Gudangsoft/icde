<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TentangKami extends Model
{
    protected $table = 'tentang_kami';
    protected $fillable = [
        // Identitas
        'nama_perusahaan', 'nama_lengkap', 'tahun_berdiri', 'profil_singkat',
        'bentuk_perusahaan', 'status_kantor', 'pengesahan_badan_hukum', 'direktur_utama',
        // Akta
        'akta_notaris', 'akta_nomor', 'akta_tanggal',
        // Legalitas
        'npwp', 'nib', 'kbli', 'siup_tanggal',
        // Keanggotaan
        'kadin_nomor', 'kadin_berlaku', 'inkindo_nomor', 'inkindo_berlaku',
        // Konten
        'visi', 'misi',
        // Kontak
        'alamat', 'telepon', 'email', 'fax', 'website',
        // Media
        'logo', 'gambar',
        // Legacy
        'judul', 'deskripsi',
        'legalitas_dinamis'
    ];

    protected $casts = [
        'legalitas_dinamis' => 'array',
    ];
}
