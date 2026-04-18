<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakPesan;

class KontakAdminController extends Controller
{
    public function index()
    {
        $pesan = KontakPesan::latest()->get();
        $pesanBaru = KontakPesan::where('sudah_dibaca', false)->count();
        return view('admin.kontak.index', compact('pesan', 'pesanBaru'));
    }

    public function show(KontakPesan $kontak)
    {
        $kontak->update(['sudah_dibaca' => true]);
        return view('admin.kontak.show', compact('kontak'));
    }

    public function destroy(KontakPesan $kontak)
    {
        $kontak->delete();
        return redirect()->route('admin.kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
