<?php

function replaceInFile($file, $search, $replace) {
    if(!file_exists($file)) return;
    $content = file_get_contents($file);
    $content = str_replace($search, $replace, $content);
    file_put_contents($file, $content);
}

$v = __DIR__ . '/resources/views/';

// 1. Struktur Organisasi in tentang-kami
replaceInFile($v.'tentang-kami.blade.php', 
    '<h2 class="section-title text-center">Struktur Organisasi</h2>', 
    '<h2 class="section-title text-center">{{ \App\Models\Setting::get(\'page_struktur_title\', \'Struktur Organisasi\') }}</h2>'
);
replaceInFile($v.'tentang-kami.blade.php', 
    '<h2 class="section-title text-center" style="color: var(--icde-primary); font-weight: 800;">Struktur Organisasi</h2>', 
    '<h2 class="section-title text-center" style="color: var(--icde-primary); font-weight: 800;">{{ \App\Models\Setting::get(\'page_struktur_title\', \'Struktur Organisasi\') }}</h2>'
);

// 2. SDM
replaceInFile($v.'sdm.blade.php', 
    '<h1 data-aos="fade-right">Sumber Daya Manusia</h1>', 
    '<h1 data-aos="fade-right">{{ \App\Models\Setting::get(\'page_sdm_title\', \'Sumber Daya Manusia\') }}</h1>'
);
replaceInFile($v.'sdm.blade.php', 
    '<li class="breadcrumb-item active">SDM</li>', 
    '<li class="breadcrumb-item active">{{ \App\Models\Setting::get(\'page_sdm_title\', \'Sumber Daya Manusia\') }}</li>'
);

// 3. Layanan
replaceInFile($v.'layanan.blade.php', 
    '<h1 data-aos="fade-right">Lingkup Layanan</h1>', 
    '<h1 data-aos="fade-right">{{ \App\Models\Setting::get(\'page_layanan_title\', \'Lingkup Layanan\') }}</h1>'
);

// 4. Galeri
replaceInFile($v.'galeri.blade.php', 
    '<h1 data-aos="fade-right">Galeri Kegiatan</h1>', 
    '<h1 data-aos="fade-right">{{ \App\Models\Setting::get(\'page_galeri_title\', \'Galeri Kegiatan\') }}</h1>'
);

// 5. Klien
replaceInFile($v.'klien.blade.php', 
    '<h1 data-aos="fade-right">Klien & Mitra</h1>', 
    '<h1 data-aos="fade-right">{{ \App\Models\Setting::get(\'page_klien_title\', \'Klien & Mitra\') }}</h1>'
);

// 6. Testimoni (Testimoni usually only on homepage, but if it has a page)
replaceInFile($v.'testimoni.blade.php', 
    '<h1 data-aos="fade-right">Testimoni</h1>', 
    '<h1 data-aos="fade-right">{{ \App\Models\Setting::get(\'page_testimoni_title\', \'Testimoni\') }}</h1>'
);

// 7. Berita
replaceInFile($v.'berita.blade.php', 
    '<h1 data-aos="fade-right">Berita & Artikel</h1>', 
    '<h1 data-aos="fade-right">{{ \App\Models\Setting::get(\'page_berita_title\', \'Berita & Artikel\') }}</h1>'
);

echo "Titles replaced in views.\n";
