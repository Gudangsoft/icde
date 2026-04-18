<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sdm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SdmAdminController extends Controller
{
    public function index()
    {
        $sdm = Sdm::orderBy('urutan')->get();
        return view('admin.sdm.index', compact('sdm'));
    }

    public function create()
    {
        return view('admin.sdm.form', ['sdm' => new Sdm(), 'action' => 'create']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:150',
            'jabatan'    => 'required|string|max:150',
            'deskripsi'  => 'nullable|string',
            'keahlian'   => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'urutan'     => 'nullable|integer',
            'foto'       => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'jabatan', 'deskripsi', 'keahlian', 'pendidikan', 'urutan']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('sdm', 'public');
        }

        Sdm::create($data);

        return redirect()->route('admin.sdm.index')->with('sukses', 'Tenaga ahli berhasil ditambahkan.');
    }

    public function edit(Sdm $sdm)
    {
        return view('admin.sdm.form', ['sdm' => $sdm, 'action' => 'edit']);
    }

    public function update(Request $request, Sdm $sdm)
    {
        $request->validate([
            'nama'       => 'required|string|max:150',
            'jabatan'    => 'required|string|max:150',
            'deskripsi'  => 'nullable|string',
            'keahlian'   => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'urutan'     => 'nullable|integer',
            'foto'       => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'jabatan', 'deskripsi', 'keahlian', 'pendidikan', 'urutan']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('foto')) {
            if ($sdm->foto) Storage::disk('public')->delete($sdm->foto);
            $data['foto'] = $request->file('foto')->store('sdm', 'public');
        }

        $sdm->update($data);

        return redirect()->route('admin.sdm.index')->with('sukses', 'Tenaga ahli berhasil diperbarui.');
    }

    public function destroy(Sdm $sdm)
    {
        if ($sdm->foto) Storage::disk('public')->delete($sdm->foto);
        $sdm->delete();
        return redirect()->route('admin.sdm.index')->with('sukses', 'Tenaga ahli berhasil dihapus.');
    }
}
