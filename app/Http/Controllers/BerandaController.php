<?php

namespace App\Http\Controllers;

use App\Models\Beranda;
use App\Models\Berita;
use App\Models\Layanan;
use App\Models\Pengalaman;
use App\Models\Klien;
use App\Models\Testimoni;
use App\Models\Slider;
use App\Models\Setting;

class BerandaController extends Controller
{
    public function index()
    {
        $beranda    = Beranda::where('aktif', true)->first();
        $sliders    = Slider::where('aktif', true)->orderBy('urutan')->get();
        $layanan    = Layanan::where('aktif', true)->orderBy('urutan')->take(6)->get();
        $pengalaman = Pengalaman::orderBy('tahun', 'desc')->take(4)->get();
        $klien      = Klien::where('aktif', true)->orderBy('urutan')->get();
        $testimoni  = Testimoni::where('aktif', true)->take(3)->get();
        $galeri     = \App\Models\Galeri::where('aktif', true)->orderBy('urutan')->take(3)->get();

        $sectionSettings = [
            'show_section_slider'     => Setting::get('show_section_slider', '1') === '1',
            'show_section_stats'      => Setting::get('show_section_stats', '1') === '1',
            'show_section_layanan'    => Setting::get('show_section_layanan', '1') === '1',
            'show_section_why'        => Setting::get('show_section_why', '1') === '1',
            'show_section_pengalaman' => Setting::get('show_section_pengalaman', '1') === '1',
            'show_section_klien'      => Setting::get('show_section_klien', '1') === '1',
            'show_section_testimoni'  => Setting::get('show_section_testimoni', '1') === '1',
            'show_section_galeri'     => Setting::get('show_section_galeri', '1') === '1',
            'show_section_berita'     => Setting::get('show_section_berita', '1') === '1',
        ];

        $contentKeys = [
            'stat_1_num', 'stat_1_label', 'stat_2_num', 'stat_2_label',
            'stat_3_num', 'stat_3_label', 'stat_4_num', 'stat_4_label',
            'section_layanan_title', 'section_layanan_subtitle',
            'section_why_title', 'section_why_subtitle',
            'section_why_item1_title', 'section_why_item1_desc',
            'section_why_item2_title', 'section_why_item2_desc',
            'section_why_item3_title', 'section_why_item3_desc',
            'section_why_item4_title', 'section_why_item4_desc',
            'section_pengalaman_title', 'section_pengalaman_subtitle',
            'section_klien_title',
            'section_testimoni_title',
            'section_galeri_badge', 'section_galeri_title',
            'section_berita_badge', 'section_berita_title',
            'section_cta_title', 'section_cta_subtitle',
        ];
        $contentSettings = [];
        foreach ($contentKeys as $key) {
            $contentSettings[$key] = Setting::get($key);
        }

        // Merge with global settings (from View::share) so footer data
        // like site_address, site_phone, site_maps_embed, social_* etc.
        // are not overwritten.
        $globalSettings = Setting::pluck('value', 'key')->toArray();
        $settings = array_merge($globalSettings, $contentSettings);

        return view('beranda', compact('beranda', 'sliders', 'layanan', 'pengalaman', 'klien', 'testimoni', 'galeri', 'sectionSettings', 'settings'));
    }
}
