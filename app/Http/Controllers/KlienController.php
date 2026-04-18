<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\Pengalaman;
use Illuminate\Support\Facades\DB;

class KlienController extends Controller
{
    public function index()
    {
        $klien = Klien::where('aktif', true)->orderBy('urutan')->get();

        // Hitung jumlah proyek per klien berdasarkan kecocokan nama pemberi_kerja
        $proyekPerKlien = DB::table('pengalaman')
            ->select('pemberi_kerja', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('pemberi_kerja')
            ->pluck('jumlah', 'pemberi_kerja');

        return view('klien', compact('klien', 'proyekPerKlien'));
    }

    public function show(Klien $klien)
    {
        // Cari proyek yang terkait dengan klien ini (exact match atau partial match)
        $proyek = Pengalaman::where(function ($query) use ($klien) {
            $query->where('pemberi_kerja', $klien->nama)
                  ->orWhere('pemberi_kerja', 'LIKE', '%' . $klien->nama . '%')
                  ->orWhere(DB::raw('LOWER(pemberi_kerja)'), 'LIKE', '%' . strtolower($klien->nama) . '%');
        })
        ->orderBy('tahun', 'desc')
        ->get();

        return view('klien-detail', compact('klien', 'proyek'));
    }
}
