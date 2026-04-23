<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaAdminController extends Controller
{
    public function index()
    {
        $berita = Berita::orderByDesc('tanggal_publish')->paginate(12);
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.form', ['berita' => new Berita()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'ringkasan'       => 'nullable|string|max:500',
            'konten'          => 'required|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'kategori'        => 'nullable|string|max:100',
            'tanggal_publish' => 'required|date',
            'penulis'         => 'nullable|string|max:150',
        ]);

        $data = $request->only(['judul', 'ringkasan', 'konten', 'kategori', 'tanggal_publish', 'penulis']);
        $data['slug']  = Berita::generateSlug($request->judul);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.form', ['berita' => $berita]);
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'ringkasan'       => 'nullable|string|max:500',
            'konten'          => 'required|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'kategori'        => 'nullable|string|max:100',
            'tanggal_publish' => 'required|date',
            'penulis'         => 'nullable|string|max:150',
        ]);

        $data = $request->only(['judul', 'ringkasan', 'konten', 'kategori', 'tanggal_publish', 'penulis']);
        $data['slug']  = Berita::generateSlug($request->judul, $berita->id);
        $data['aktif'] = $request->boolean('aktif', false);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function bulkDestroy(\Illuminate\Http\Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('error', 'Tidak ada data yang dipilih.');

        $items = \App\Models\Berita::whereIn('id', $ids)->get();
        foreach ($items as $item) {
            if ($item->gambar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($item->gambar);
            }
            $item->delete();
        }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }
}
