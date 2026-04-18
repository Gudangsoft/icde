<?php

namespace App\Http\Controllers;

use App\Models\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::where('aktif', true)->orderBy('urutan')->get();
        return view('layanan', compact('layanan'));
    }
}
