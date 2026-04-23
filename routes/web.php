<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\SdmController;
use App\Http\Controllers\PengalamanController;
use App\Http\Controllers\KlienController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\BerandaAdminController;
use App\Http\Controllers\Admin\TentangKamiAdminController;
use App\Http\Controllers\Admin\LayananAdminController;
use App\Http\Controllers\Admin\SdmAdminController;
use App\Http\Controllers\Admin\PengalamanAdminController;
use App\Http\Controllers\Admin\KlienAdminController;
use App\Http\Controllers\Admin\GaleriAdminController;
use App\Http\Controllers\Admin\TestimoniAdminController;
use App\Http\Controllers\Admin\KontakAdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BeritaAdminController;
use App\Http\Controllers\Admin\SliderAdminController;
use App\Http\Controllers\Admin\StrukturOrganisasiAdminController;
use App\Http\Controllers\Admin\SeksiController;

Route::middleware('maintenance')->group(function () {
    Route::get('/', [BerandaController::class, 'index'])->name('beranda');
    Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('tentang-kami');
    Route::get('/lingkup-layanan', [LayananController::class, 'index'])->name('layanan');
    Route::get('/sdm', [SdmController::class, 'index'])->name('sdm');
    Route::get('/pengalaman', [PengalamanController::class, 'index'])->name('pengalaman');
    Route::get('/pengalaman/{id}', [PengalamanController::class, 'show'])->name('pengalaman.detail');
    Route::get('/klien', [KlienController::class, 'index'])->name('klien');
    Route::get('/klien/{klien}', [KlienController::class, 'show'])->name('klien.detail');
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
    Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
    Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.detail');
    Route::get('/kontak-kami', [KontakController::class, 'index'])->name('kontak');
    Route::post('/kontak-kami/kirim', [KontakController::class, 'kirim'])->name('kontak.kirim');
});

// ====================== ADMIN ROUTES ======================
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth (unauthenticated)
    Route::get('/login', [AdminAuth::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuth::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuth::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        // Beranda (single record)
        Route::get('/beranda', [BerandaAdminController::class, 'index'])->name('beranda.index');
        Route::get('/beranda/edit', [BerandaAdminController::class, 'edit'])->name('beranda.edit');
        Route::put('/beranda/update', [BerandaAdminController::class, 'update'])->name('beranda.update');

        // Tentang Kami (single record)
        Route::get('/tentang/edit', [TentangKamiAdminController::class, 'edit'])->name('tentang.edit');
        Route::put('/tentang/update', [TentangKamiAdminController::class, 'update'])->name('tentang.update');

        // CRUD Resources
        Route::post('/layanan/bulk-delete', [LayananAdminController::class, 'bulkDestroy'])->name('layanan.bulk-destroy');
        Route::resource('/layanan', LayananAdminController::class)->names([
            'index' => 'layanan.index', 'create' => 'layanan.create', 'store' => 'layanan.store',
            'edit' => 'layanan.edit', 'update' => 'layanan.update', 'destroy' => 'layanan.destroy',
        ]);
        Route::get('/sdm/export', [SdmAdminController::class, 'export'])->name('sdm.export');
        Route::get('/sdm/import/template', [SdmAdminController::class, 'importTemplate'])->name('sdm.import.template');
        Route::post('/sdm/import', [SdmAdminController::class, 'import'])->name('sdm.import');
        Route::post('/sdm/bulk-delete', [SdmAdminController::class, 'bulkDestroy'])->name('sdm.bulk-destroy');
        Route::resource('/sdm', SdmAdminController::class)->names([
            'index' => 'sdm.index', 'create' => 'sdm.create', 'store' => 'sdm.store',
            'edit' => 'sdm.edit', 'update' => 'sdm.update', 'destroy' => 'sdm.destroy',
        ]);
        // Pengalaman
        Route::post('/pengalaman/bulk-delete', [PengalamanAdminController::class, 'bulkDestroy'])->name('pengalaman.bulk-destroy');
        Route::get('/pengalaman/export', [PengalamanAdminController::class, 'export'])->name('pengalaman.export');
        Route::get('/pengalaman/import/template', [PengalamanAdminController::class, 'importTemplate'])->name('pengalaman.import.template');
        Route::post('/pengalaman/import', [PengalamanAdminController::class, 'import'])->name('pengalaman.import');
        Route::resource('/pengalaman', PengalamanAdminController::class)->names([
            'index' => 'pengalaman.index', 'create' => 'pengalaman.create', 'store' => 'pengalaman.store',
            'edit' => 'pengalaman.edit', 'update' => 'pengalaman.update', 'destroy' => 'pengalaman.destroy',
        ]);
        // Klien
        Route::get('/klien/export', [KlienAdminController::class, 'export'])->name('klien.export');
        Route::get('/klien/import/template', [KlienAdminController::class, 'importTemplate'])->name('klien.import.template');
        Route::post('/klien/import', [KlienAdminController::class, 'import'])->name('klien.import');
        Route::post('/klien/bulk-delete', [KlienAdminController::class, 'bulkDestroy'])->name('klien.bulk-destroy');
        Route::post('/klien/{klien}/logo', [KlienAdminController::class, 'updateLogo'])->name('klien.update-logo');
        Route::resource('/klien', KlienAdminController::class)->names([
            'index' => 'klien.index', 'create' => 'klien.create', 'store' => 'klien.store',
            'edit' => 'klien.edit', 'update' => 'klien.update', 'destroy' => 'klien.destroy',
        ]);
        Route::post('/galeri/bulk-delete', [GaleriAdminController::class, 'bulkDestroy'])->name('galeri.bulk-destroy');
        Route::resource('/galeri', GaleriAdminController::class)->names([
            'index' => 'galeri.index', 'create' => 'galeri.create', 'store' => 'galeri.store',
            'edit' => 'galeri.edit', 'update' => 'galeri.update', 'destroy' => 'galeri.destroy',
        ]);
        Route::post('/galeri/import-proyek', [GaleriAdminController::class, 'importFromProyek'])->name('galeri.import-proyek');
        Route::post('/testimoni/bulk-delete', [TestimoniAdminController::class, 'bulkDestroy'])->name('testimoni.bulk-destroy');
        Route::resource('/testimoni', TestimoniAdminController::class)->names([
            'index' => 'testimoni.index', 'create' => 'testimoni.create', 'store' => 'testimoni.store',
            'edit' => 'testimoni.edit', 'update' => 'testimoni.update', 'destroy' => 'testimoni.destroy',
        ]);

        // Kontak (read + delete only)
        Route::get('/kontak', [KontakAdminController::class, 'index'])->name('kontak.index');
        Route::get('/kontak/{kontak}', [KontakAdminController::class, 'show'])->name('kontak.show');
        Route::delete('/kontak/{kontak}', [KontakAdminController::class, 'destroy'])->name('kontak.destroy');

        // Setting Web
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/setting', [SettingController::class, 'update'])->name('setting.update');
        Route::post('/setting/title', [SettingController::class, 'updateTitle'])->name('setting.update_title');

        // Judul Seksi Homepage
        Route::get('/seksi', [SeksiController::class, 'index'])->name('seksi.index');
        Route::put('/seksi/update', [SeksiController::class, 'update'])->name('seksi.update');

        // Berita
        Route::post('/berita/bulk-delete', [BeritaAdminController::class, 'bulkDestroy'])->name('berita.bulk-destroy');
        Route::resource('/berita', BeritaAdminController::class)->except(['show'])->parameters(['berita' => 'berita'])->names([
            'index' => 'berita.index', 'create' => 'berita.create', 'store' => 'berita.store',
            'edit' => 'berita.edit', 'update' => 'berita.update', 'destroy' => 'berita.destroy',
        ]);

        // Slider / Banner
        Route::post('/slider/bulk-delete', [SliderAdminController::class, 'bulkDestroy'])->name('slider.bulk-destroy');
        Route::resource('/slider', SliderAdminController::class)->except(['show'])->names([
            'index' => 'slider.index', 'create' => 'slider.create', 'store' => 'slider.store',
            'edit' => 'slider.edit', 'update' => 'slider.update', 'destroy' => 'slider.destroy',
        ]);
        Route::post('/slider/{slider}/toggle', [SliderAdminController::class, 'toggleAktif'])->name('slider.toggle');

        // Struktur Organisasi
        Route::post('/struktur/bulk-delete', [StrukturOrganisasiAdminController::class, 'bulkDestroy'])->name('struktur.bulk-destroy');
        Route::resource('/struktur', StrukturOrganisasiAdminController::class)->names([
            'index' => 'struktur.index', 'create' => 'struktur.create', 'store' => 'struktur.store',
            'edit' => 'struktur.edit', 'update' => 'struktur.update', 'destroy' => 'struktur.destroy',
        ]);
    });
});
