<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SeksiController extends Controller
{
    // Daftar key yang boleh diubah lewat halaman Seksi
    private array $allowedKeys = [
        // Layanan
        'section_layanan_title', 'section_layanan_subtitle',
        // Statistik
        'stat_1_num', 'stat_1_label', 'stat_2_num', 'stat_2_label',
        'stat_3_num', 'stat_3_label', 'stat_4_num', 'stat_4_label',
        // Why
        'section_why_title', 'section_why_subtitle',
        'section_why_item1_title', 'section_why_item1_desc',
        'section_why_item2_title', 'section_why_item2_desc',
        'section_why_item3_title', 'section_why_item3_desc',
        'section_why_item4_title', 'section_why_item4_desc',
        // Pengalaman
        'section_pengalaman_title', 'section_pengalaman_subtitle',
        // Klien
        'section_klien_title',
        // Testimoni
        'section_testimoni_title',
        // Galeri
        'section_galeri_badge', 'section_galeri_title',
        // Berita
        'section_berita_badge', 'section_berita_title',
        // CTA
        'section_cta_title', 'section_cta_subtitle',
        // Visibility toggles
        'show_section_slider', 'show_section_stats', 'show_section_layanan',
        'show_section_why', 'show_section_pengalaman', 'show_section_klien',
        'show_section_testimoni', 'show_section_galeri', 'show_section_berita',
    ];

    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.seksi.index', compact('settings'));
    }

    public function update(Request $request)
    {
        try {
            foreach ($this->allowedKeys as $key) {
                if ($request->has($key)) {
                    Setting::set($key, $request->input($key, ''));
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
