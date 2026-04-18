<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beranda;
use App\Models\Layanan;
use App\Models\Sdm;
use App\Models\Pengalaman;
use App\Models\Klien;
use App\Models\Galeri;
use App\Models\Testimoni;
use App\Models\KontakPesan;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'layanan'       => Layanan::count(),
            'sdm'           => Sdm::count(),
            'pengalaman'    => Pengalaman::count(),
            'klien'         => Klien::count(),
            'galeri'        => Galeri::count(),
            'testimoni'     => Testimoni::count(),
            'pesan'         => KontakPesan::count(),
            'pesan_baru'    => KontakPesan::where('sudah_dibaca', false)->count(),
        ];

        $pesan_terbaru = KontakPesan::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'pesan_terbaru'));
    }
}
