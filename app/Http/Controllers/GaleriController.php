<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::where('aktif', true)->orderBy('album')->orderBy('urutan');

        if ($request->has('album') && $request->album) {
            $query->where('album', $request->album);
        }

        $galeri = $query->get();
        
        $albums = Galeri::where('aktif', true)
            ->whereNotNull('album')
            ->where('album', '!=', '')
            ->distinct()
            ->orderBy('album')
            ->pluck('album');

        return view('galeri', compact('galeri', 'albums', 'request'));
    }
}
