<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;
use App\Models\StrukturOrganisasi;

class TentangKamiController extends Controller
{
    public function index()
    {
        $tentang  = TentangKami::first();
        $struktur = StrukturOrganisasi::with('children.children')
            ->whereNull('parent_id')
            ->where('aktif', true)
            ->orderBy('urutan')
            ->get();
        return view('tentang-kami', compact('tentang', 'struktur'));
    }
}
