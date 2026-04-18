<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimoni = Testimoni::where('aktif', true)->paginate(9);
        return view('testimoni', compact('testimoni'));
    }
}
