<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiAdminController extends Controller
{
    public function index()
    {
        $items = StrukturOrganisasi::with('parent')->orderBy('urutan')->get();
        return view('admin.struktur.index', compact('items'));
    }

    public function create()
    {
        $parents = StrukturOrganisasi::orderBy('nama')->get();
        $model = new StrukturOrganisasi();
        return view('admin.struktur.form', compact('model', 'parents'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatedData($request);
        $model = new StrukturOrganisasi($this->fillData($validated));

        if ($request->hasFile('foto')) {
            $model->foto = $request->file('foto')->store('struktur', 'public');
        }
        $model->save();

        return redirect()->route('admin.struktur.index')->with('sukses', 'Data berhasil ditambahkan.');
    }

    public function edit(StrukturOrganisasi $struktur)
    {
        $parents = StrukturOrganisasi::where('id', '!=', $struktur->id)->orderBy('nama')->get();
        $model = $struktur;
        return view('admin.struktur.form', compact('model', 'parents'));
    }

    public function update(Request $request, StrukturOrganisasi $struktur)
    {
        $validated = $this->validatedData($request);
        $struktur->fill($this->fillData($validated));

        if ($request->hasFile('foto')) {
            if ($struktur->foto) Storage::disk('public')->delete($struktur->foto);
            $struktur->foto = $request->file('foto')->store('struktur', 'public');
        }
        $struktur->save();

        return redirect()->route('admin.struktur.index')->with('sukses', 'Data berhasil diperbarui.');
    }

    public function destroy(StrukturOrganisasi $struktur)
    {
        // move children up to parent
        StrukturOrganisasi::where('parent_id', $struktur->id)
            ->update(['parent_id' => $struktur->parent_id]);

        if ($struktur->foto) Storage::disk('public')->delete($struktur->foto);
        $struktur->delete();

        return redirect()->route('admin.struktur.index')->with('sukses', 'Data berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nama'      => 'required|string|max:150',
            'jabatan'   => 'required|string|max:150',
            'gelar'     => 'nullable|string|max:100',
            'parent_id' => 'nullable|exists:struktur_organisasi,id',
            'urutan'    => 'nullable|integer|min:0',
            'aktif'     => 'nullable|boolean',
            'foto'      => 'nullable|image|max:2048',
        ]);
    }

    private function fillData(array $v): array
    {
        return [
            'nama'      => $v['nama'],
            'jabatan'   => $v['jabatan'],
            'gelar'     => $v['gelar'] ?? null,
            'parent_id' => $v['parent_id'] ?? null,
            'urutan'    => $v['urutan'] ?? 0,
            'aktif'     => isset($v['aktif']) ? (bool)$v['aktif'] : false,
        ];
    }

        public function bulkDestroy(\Illuminate\Http\Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('error', 'Tidak ada data yang dipilih.');

        $items = \App\Models\StrukturOrganisasi::whereIn('id', $ids)->get();
        foreach ($items as $item) {
            if ($item->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($item->foto);
            }
            $item->delete();
        }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }
}
