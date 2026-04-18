<?php

namespace App\Http\Controllers;

use App\Models\Pengalaman;
use Illuminate\Http\Request;

class PengalamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengalaman::orderBy('tahun', 'desc')->orderBy('urutan');

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        $pengalaman = $query->paginate(10);
        $kategori = Pengalaman::distinct()->pluck('kategori')->filter()->values();

        return view('pengalaman', compact('pengalaman', 'kategori'));
    }

    public function show($id)
    {
        $pengalaman = Pengalaman::findOrFail($id);
        // Maybe fetch related projects in same category
        $related = Pengalaman::where('kategori', $pengalaman->kategori)
            ->where('id', '!=', $pengalaman->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        return view('pengalaman-detail', compact('pengalaman', 'related'));
    }
}
