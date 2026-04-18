<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$t = App\Models\TentangKami::first() ?? new App\Models\TentangKami();
$t->akta_notaris = 'Tri Isdiyanti, SH';
$t->akta_nomor = '05 (lima)';
$t->akta_tanggal = '9 April 2010';
$t->npwp = '31.315.457.7-517.000';
$t->nib = '9120005752888';
$t->kbli = '70209, 62019, 62012, 62090';
$t->siup_tanggal = '28 Juli 2019';
$t->kadin_nomor = '20301-25093146511';
$t->kadin_berlaku = '03 Januari 2026';
$t->inkindo_nomor = '15323/P/0673.JT';
$t->inkindo_berlaku = '31 Desember 2025';
$t->save();

echo "Data Legalitas Tersimpan!\n";
