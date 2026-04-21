<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangKamiAdminController extends Controller
{
    public function edit()
    {
        $tentang = TentangKami::first() ?? new TentangKami();
        return view('admin.tentang.edit', compact('tentang'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan'      => 'required|string|max:255',
            'nama_lengkap'         => 'nullable|string|max:255',
            'tahun_berdiri'        => 'nullable|string|max:10',
            'profil_singkat'       => 'required|string',

            'akta_notaris'         => 'nullable|string|max:150',
            'akta_nomor'           => 'nullable|string|max:50',
            'akta_tanggal'         => 'nullable|string|max:50',
            'npwp'                 => 'nullable|string|max:50',
            'nib'                  => 'nullable|string|max:50',
            'kbli'                 => 'nullable|string|max:100',
            'siup_tanggal'         => 'nullable|string|max:50',
            'kadin_nomor'          => 'nullable|string|max:100',
            'kadin_berlaku'        => 'nullable|string|max:50',
            'inkindo_nomor'        => 'nullable|string|max:100',
            'inkindo_berlaku'      => 'nullable|string|max:50',
            'visi'                 => 'nullable|string',
            'misi'                 => 'nullable|string',
            'alamat'               => 'nullable|string',
            'telepon'              => 'nullable|string|max:50',
            'email'                => 'nullable|email|max:100',
            'fax'                  => 'nullable|string|max:50',
            'website'              => 'nullable|url|max:255',
            'gambar'               => 'nullable|image|max:2048',
        ]);

        $tentang = TentangKami::first() ?? new TentangKami();

        $tentang->fill(array_merge(
            collect($validated)->except(['logo', 'gambar'])->toArray(),
            [
                'judul'     => $validated['nama_perusahaan'],
                'deskripsi' => $validated['profil_singkat'],
            ]
        ));

        // Handle legalitas dinamis
        $legalitasLabels = $request->input('legalitas_dinamis_label', []);
        $legalitasValues = $request->input('legalitas_dinamis_value', []);
        $legalitasDinamis = [];
        foreach ($legalitasLabels as $index => $label) {
            if (!empty($label)) {
                $legalitasDinamis[] = [
                    'label' => $label,
                    'value' => $legalitasValues[$index] ?? '',
                ];
            }
        }
        $tentang->legalitas_dinamis = $legalitasDinamis;

        // Handle keanggotaan dinamis
        $keanggotaanLabels = $request->input('keanggotaan_dinamis_label', []);
        $keanggotaanValues = $request->input('keanggotaan_dinamis_value', []);
        $keanggotaanDinamis = [];
        foreach ($keanggotaanLabels as $index => $label) {
            if (!empty($label)) {
                $keanggotaanDinamis[] = [
                    'label' => $label,
                    'value' => $keanggotaanValues[$index] ?? '',
                ];
            }
        }
        $tentang->keanggotaan_dinamis = $keanggotaanDinamis;

        if ($request->hasFile('gambar')) {
            if ($tentang->gambar) Storage::disk('public')->delete($tentang->gambar);
            $tentang->gambar = $request->file('gambar')->store('tentang', 'public');
        }

        $tentang->save();

        return redirect()->route('admin.tentang.edit')->with('sukses', 'Data Tentang Kami berhasil disimpan.');
    }
}
