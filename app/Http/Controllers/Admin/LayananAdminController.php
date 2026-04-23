<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananAdminController extends Controller
{
    public function index()
    {
        $layanan = Layanan::orderBy('urutan')->get();
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.form', ['layanan' => new Layanan(), 'action' => 'create']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon'      => 'nullable|string|max:50',
            'urutan'    => 'nullable|integer',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'ikon', 'urutan']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        Layanan::create($data);

        return redirect()->route('admin.layanan.index')->with('sukses', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.form', ['layanan' => $layanan, 'action' => 'edit']);
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon'      => 'nullable|string|max:50',
            'urutan'    => 'nullable|integer',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'ikon', 'urutan']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('gambar')) {
            if ($layanan->gambar) Storage::disk('public')->delete($layanan->gambar);
            $data['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')->with('sukses', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->gambar) Storage::disk('public')->delete($layanan->gambar);
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('sukses', 'Layanan berhasil dihapus.');
    }

        public function bulkDestroy(\Illuminate\Http\Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('error', 'Tidak ada data yang dipilih.');

        $items = \App\Models\Layanan::whereIn('id', $ids)->get();
        foreach ($items as $item) {
            if ($item->gambar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($item->gambar);
            }
            $item->delete();
        }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }
}
