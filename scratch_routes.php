<?php

$path = "d:/LPSSE/ICDE/icde-web/routes/web.php";
$c = file_get_contents($path);
$resources = [
    "layanan" => "LayananAdminController",
    "sdm" => "SdmAdminController",
    "pengalaman" => "PengalamanAdminController",
    "klien" => "KlienAdminController",
    "galeri" => "GaleriAdminController",
    "testimoni" => "TestimoniAdminController",
    "berita" => "BeritaAdminController",
    "slider" => "SliderAdminController",
    "struktur" => "StrukturOrganisasiAdminController",
];

foreach ($resources as $name => $ctrl) {
    if (!str_contains($c, $name . '.bulk-destroy')) {
        $search = "Route::resource('/{$name}'";
        $replace = "Route::post('/{$name}/bulk-delete', [{$ctrl}::class, 'bulkDestroy'])->name('{$name}.bulk-destroy');\n        Route::resource('/{$name}'";
        $c = str_replace($search, $replace, $c);
    }
}

file_put_contents($path, $c);
echo "Routes updated\n";
