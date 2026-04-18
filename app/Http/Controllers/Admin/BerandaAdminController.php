<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beranda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerandaAdminController extends Controller
{
    public function index()
    {
        $beranda = Beranda::first();
        return view('admin.beranda.index', compact('beranda'));
    }

    public function edit()
    {
        $beranda = Beranda::first() ?? new Beranda();
        return view('admin.beranda.edit', compact('beranda'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'deskripsi'=> 'required|string',
            'motto'    => 'nullable|string|max:255',
            'gambar'   => 'nullable|image|max:2048',
        ]);

        $beranda = Beranda::first() ?? new Beranda();
        $beranda->judul     = $request->judul;
        $beranda->deskripsi = $request->deskripsi;
        $beranda->motto     = $request->motto;
        $beranda->aktif     = $request->boolean('aktif', true);

        if ($request->hasFile('gambar')) {
            if ($beranda->gambar) Storage::disk('public')->delete($beranda->gambar);
            $beranda->gambar = $request->file('gambar')->store('beranda', 'public');
        }

        $beranda->save();

        return redirect()->route('admin.beranda.index')->with('sukses', 'Data beranda berhasil disimpan.');
    }
}
