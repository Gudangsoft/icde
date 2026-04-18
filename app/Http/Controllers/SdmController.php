<?php

namespace App\Http\Controllers;

use App\Models\Sdm;

class SdmController extends Controller
{
    public function index()
    {
        $sdm = Sdm::where('aktif', true)->orderBy('urutan')->get();
        return view('sdm', compact('sdm'));
    }
}
