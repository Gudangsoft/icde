<?php

namespace App\Http\Controllers;

use App\Models\KontakPesan;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }

    public function kirim(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'telepon' => 'nullable|string|max:20',
            'subjek'  => 'nullable|string|max:150',
            'pesan'   => 'required|string|max:2000',
        ]);

        KontakPesan::create($request->only(['nama', 'email', 'telepon', 'subjek', 'pesan']));

        return redirect()->route('kontak')->with('sukses', 'Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
