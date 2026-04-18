<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::where('aktif', true)->orderByDesc('tanggal_publish');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('cari')) {
            $search = $request->cari;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%");
            });
        }

        $berita = $query->paginate(9);
        $kategori = Berita::where('aktif', true)->distinct()->pluck('kategori')->filter()->values();

        return view('berita', compact('berita', 'kategori'));
    }

    public function show(string $slug)
    {
        $berita = Berita::where('slug', $slug)->where('aktif', true)->firstOrFail();
        $terkait = Berita::where('aktif', true)
            ->where('id', '!=', $berita->id)
            ->when($berita->kategori, fn($q) => $q->where('kategori', $berita->kategori))
            ->orderByDesc('tanggal_publish')
            ->limit(3)
            ->get();

        return view('berita-detail', compact('berita', 'terkait'));
    }
}
