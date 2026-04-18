<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // Identitas
            'site_name'          => 'PT ICDE',
            'site_tagline'       => 'Integrated Civil & Development Engineering',
            'site_description'   => 'PT ICDE adalah perusahaan konsultan teknik yang berpengalaman di bidang perencanaan, pengawasan, dan manajemen proyek infrastruktur.',
            'site_keywords'      => 'konsultan teknik, perencanaan infrastruktur, pengawasan proyek, manajemen konstruksi, ICDE',
            'site_email'         => 'icde.semarang@gmail.com',
            'site_email2'        => '',
            'site_phone'         => '62-24-6705577',
            'site_phone2'        => '62-24-6701321',
            'site_whatsapp'      => '',
            'site_address'       => 'Bumi Wanamukti Blok: A4 No. 27, Kelurahan Sembiroto, Kecamatan Tembalang, Kota Semarang, Kode Pos 50276',
            'site_maps_embed'    => 'https://maps.google.com/maps?q=PT+ICDE+Semarang+Bumi+Wanamukti+Tembalang&output=embed',
            'site_working_hours' => 'Senin – Jumat: 08.00 – 17.00 WIB',

            // Logo & Favicon (path relatif dari storage)
            'site_logo'          => '',
            'site_favicon'       => '',

            // Media Sosial
            'social_facebook'    => 'https://facebook.com/ptICDE',
            'social_instagram'   => 'https://instagram.com/ptICDE',
            'social_linkedin'    => 'https://linkedin.com/company/ptICDE',
            'social_youtube'     => 'https://youtube.com/@ptICDE',
            'social_twitter'     => 'https://x.com/ptICDE',

            // Footer
            'footer_copyright'   => '© ' . date('Y') . ' PT ICDE. All rights reserved.',
            'footer_text'        => 'Solusi terpercaya untuk kebutuhan konsultansi teknik dan infrastruktur Anda.',

            // SEO
            'meta_author'        => 'PT ICDE',
            'google_analytics'   => '',
        ];

        foreach ($defaults as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
