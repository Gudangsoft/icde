<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimoniAdminController extends Controller
{
    public function index()
    {
        $testimoni = Testimoni::latest()->get();
        return view('admin.testimoni.index', compact('testimoni'));
    }

    public function create()
    {
        return view('admin.testimoni.form', ['testimoni' => new Testimoni(), 'action' => 'create']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:150',
            'jabatan'  => 'nullable|string|max:150',
            'instansi' => 'nullable|string|max:150',
            'isi'      => 'required|string',
            'bintang'  => 'required|integer|min:1|max:5',
            'foto'     => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'jabatan', 'instansi', 'isi', 'bintang']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('testimoni', 'public');
        }

        Testimoni::create($data);

        return redirect()->route('admin.testimoni.index')->with('sukses', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimoni $testimoni)
    {
        return view('admin.testimoni.form', ['testimoni' => $testimoni, 'action' => 'edit']);
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $request->validate([
            'nama'     => 'required|string|max:150',
            'jabatan'  => 'nullable|string|max:150',
            'instansi' => 'nullable|string|max:150',
            'isi'      => 'required|string',
            'bintang'  => 'required|integer|min:1|max:5',
            'foto'     => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'jabatan', 'instansi', 'isi', 'bintang']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('foto')) {
            if ($testimoni->foto) Storage::disk('public')->delete($testimoni->foto);
            $data['foto'] = $request->file('foto')->store('testimoni', 'public');
        }

        $testimoni->update($data);

        return redirect()->route('admin.testimoni.index')->with('sukses', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimoni $testimoni)
    {
        if ($testimoni->foto) Storage::disk('public')->delete($testimoni->foto);
        $testimoni->delete();
        return redirect()->route('admin.testimoni.index')->with('sukses', 'Testimoni berhasil dihapus.');
    }

    public function bulkDestroy(\Illuminate\Http\Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('error', 'Tidak ada data yang dipilih.');

        $items = \App\Models\Testimoni::whereIn('id', $ids)->get();
        foreach ($items as $item) {
                if ($item->foto) \Illuminate\Support\Facades\Storage::disk('public')->delete($item->foto);
            $item->delete();
        }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }
}
