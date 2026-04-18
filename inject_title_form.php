<?php

$menus = [
    'sdm' => ['page_sdm_title', 'Sumber Daya Manusia'],
    'layanan' => ['page_layanan_title', 'Lingkup Layanan'],
    'galeri' => ['page_galeri_title', 'Galeri Kegiatan'],
    'klien' => ['page_klien_title', 'Klien & Mitra'],
    'testimoni' => ['page_testimoni_title', 'Testimoni'],
    'berita' => ['page_berita_title', 'Berita & Artikel'],
    'pengalaman' => ['page_pengalaman_title', 'Pengalaman Perusahaan'],
];

foreach ($menus as $folder => $data) {
    $filePath = __DIR__ . '/resources/views/admin/' . $folder . '/index.blade.php';
    if (!file_exists($filePath)) {
        echo "Missing: $filePath\n";
        continue;
    }
    
    $content = file_get_contents($filePath);
    
    if (strpos($content, 'page_'.$folder.'_title') !== false) {
        echo "Already injected: $folder\n";
        continue;
    }
    
    $key = $data[0];
    $defaultTitle = $data[1];
    
    $formHtml = <<<HTML

    <div class="admin-card mb-4" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
        <div class="admin-card-body p-3">
            <form action="{{ route('setting.update_title') }}" method="POST" class="d-flex align-items-center gap-3 flex-wrap">
                @csrf
                <div class="d-flex align-items-center" style="flex: 1; min-width:300px;">
                    <label class="mb-0 fw-bold me-3" style="white-space: nowrap; color:#374151; font-size:0.9rem;"><i class="bi bi-pencil-square me-2 text-primary"></i>Ubah Judul Halaman di Website:</label>
                    <input type="hidden" name="key" value="$key">
                    <input type="text" name="value" class="form-control-admin mb-0" 
                           value="{{ \App\Models\Setting::get('$key', '$defaultTitle') }}" 
                           placeholder="Contoh: $defaultTitle" required style="flex:1; border-radius:8px; padding:10px 15px;">
                </div>
                <button type="submit" class="btn-admin btn-primary-admin" style="padding: 10px 24px; border-radius:8px;">
                    <i class="bi bi-save-fill me-2"></i>Simpan
                </button>
            </form>
        </div>
    </div>

<div class="admin-card">
HTML;

    // We replace the FIRST occurrence of <div class="admin-card"> (which is the main list card)
    $content = preg_replace('/<div class="admin-card">/', $formHtml, $content, 1);
    
    file_put_contents($filePath, $content);
    echo "Injected: $folder\n";
}
