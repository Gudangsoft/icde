<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'judul'       => 'Solusi Konsultansi Teknik Terpercaya',
                'subjudul'    => 'PT Integrated Civil & Development Engineering',
                'deskripsi'   => 'Kami hadir sebagai mitra strategis dalam perencanaan, pengawasan, dan manajemen proyek infrastruktur di seluruh Indonesia.',
                'teks_tombol' => 'Lihat Layanan Kami',
                'link_tombol' => '/lingkup-layanan',
                'warna_teks'  => 'light',
                'urutan'      => 1,
                'aktif'       => true,
            ],
            [
                'judul'       => 'Pengalaman Lebih dari 100+ Proyek Nasional',
                'subjudul'    => 'Rekam Jejak yang Teruji',
                'deskripsi'   => 'Didukung tenaga ahli bersertifikat dan pengalaman panjang di berbagai sektor infrastruktur, jalan, jembatan, dan sumber daya air.',
                'teks_tombol' => 'Lihat Pengalaman',
                'link_tombol' => '/pengalaman',
                'warna_teks'  => 'light',
                'urutan'      => 2,
                'aktif'       => true,
            ],
            [
                'judul'       => 'Tim Profesional & Bersertifikat',
                'subjudul'    => 'Sumber Daya Manusia Unggul',
                'deskripsi'   => 'Tenaga ahli multi-disiplin kami siap memberikan solusi teknis terbaik untuk setiap tantangan proyek Anda.',
                'teks_tombol' => 'Kenali Tim Kami',
                'link_tombol' => '/sdm',
                'warna_teks'  => 'light',
                'urutan'      => 3,
                'aktif'       => true,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::updateOrCreate(
                ['judul' => $slider['judul']],
                $slider
            );
        }
    }
}
