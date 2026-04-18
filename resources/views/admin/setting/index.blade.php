@extends('admin.layouts.app')
@section('title', 'Setting Website')
@section('page_title', 'Setting Website')

@section('content')

<form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <strong><i class="bi bi-exclamation-triangle-fill me-1"></i>Terdapat kesalahan:</strong>
        <ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Tab Navigation -->
    <ul class="nav nav-pills mb-4 gap-1" id="settingTabs" role="tablist" style="flex-wrap:wrap;">
        @foreach([
            ['id'=>'identitas',   'icon'=>'bi-building',        'label'=>'Identitas'],
            ['id'=>'kontak',      'icon'=>'bi-telephone-fill',  'label'=>'Kontak & Lokasi'],
            ['id'=>'sosmed',      'icon'=>'bi-share-fill',      'label'=>'Media Sosial'],
            ['id'=>'tampilan',    'icon'=>'bi-image-fill',      'label'=>'Logo & Tampilan'],
            ['id'=>'seo',         'icon'=>'bi-search',          'label'=>'SEO & Meta'],
            ['id'=>'maintenance', 'icon'=>'bi-tools',           'label'=>'Maintenance'],
        ] as $tab)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                id="{{ $tab['id'] }}-tab" data-bs-toggle="pill"
                data-bs-target="#{{ $tab['id'] }}" type="button" role="tab"
                style="font-size:0.83rem;font-weight:600;border-radius:8px;padding:8px 16px;">
                <i class="bi {{ $tab['icon'] }} me-1"></i>{{ $tab['label'] }}
            </button>
        </li>
        @endforeach
    </ul>

    <div class="tab-content" id="settingTabContent">

        {{-- TAB: IDENTITAS --}}
        <div class="tab-pane fade show active" id="identitas" role="tabpanel">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5><i class="bi bi-building me-2" style="color:#1B6CA8;"></i>Identitas Perusahaan</h5>
                </div>
                <div class="admin-card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Nama Website / Perusahaan <span class="text-danger">*</span></label>
                                <input type="text" name="site_name" class="form-control-admin @error('site_name') is-invalid @enderror"
                                    value="{{ old('site_name', $settings['site_name'] ?? 'PT ICDE') }}" required>
                                @error('site_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Tagline</label>
                                <input type="text" name="site_tagline" class="form-control-admin"
                                    value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}"
                                    placeholder="Integrated Civil & Development Engineering">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Deskripsi Perusahaan</label>
                                <textarea name="site_description" class="form-control-admin" rows="4"
                                    placeholder="Deskripsi singkat perusahaan untuk mesin pencari...">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                                <small style="color:#94a3b8;font-size:0.75rem;">Idealnya 150–160 karakter untuk SEO.</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label>Tahun Berdiri</label>
                                <input type="number" name="site_founded" class="form-control-admin" min="1900" max="{{ date('Y') }}"
                                    value="{{ old('site_founded', $settings['site_founded'] ?? '') }}" placeholder="{{ date('Y') - 10 }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label>Jam Operasional</label>
                                <input type="text" name="site_working_hours" class="form-control-admin"
                                    value="{{ old('site_working_hours', $settings['site_working_hours'] ?? '') }}"
                                    placeholder="Senin – Jumat: 08:00 – 17:00 WIB">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label>Teks Copyright Footer</label>
                                <input type="text" name="footer_copyright" class="form-control-admin"
                                    value="{{ old('footer_copyright', $settings['footer_copyright'] ?? '') }}"
                                    placeholder="© 2024 PT ICDE. All rights reserved.">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Teks Footer</label>
                                <textarea name="footer_text" class="form-control-admin" rows="2">{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB: KONTAK & LOKASI --}}
        <div class="tab-pane fade" id="kontak" role="tabpanel">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5><i class="bi bi-telephone-fill me-2" style="color:#1B6CA8;"></i>Kontak & Lokasi</h5>
                </div>
                <div class="admin-card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Email Utama</label>
                                <div style="position:relative;">
                                    <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="site_email" class="form-control-admin @error('site_email') is-invalid @enderror"
                                        style="padding-left:36px;"
                                        value="{{ old('site_email', $settings['site_email'] ?? '') }}"
                                        placeholder="info@icde.id">
                                    @error('site_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Email Alternatif</label>
                                <div style="position:relative;">
                                    <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="site_email2" class="form-control-admin"
                                        style="padding-left:36px;"
                                        value="{{ old('site_email2', $settings['site_email2'] ?? '') }}"
                                        placeholder="hrd@icde.id">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label>Telepon Utama</label>
                                <div style="position:relative;">
                                    <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;"><i class="bi bi-telephone"></i></span>
                                    <input type="text" name="site_phone" class="form-control-admin"
                                        style="padding-left:36px;"
                                        value="{{ old('site_phone', $settings['site_phone'] ?? '') }}"
                                        placeholder="+62 21 1234 5678">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label>Telepon Alternatif</label>
                                <div style="position:relative;">
                                    <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;"><i class="bi bi-telephone"></i></span>
                                    <input type="text" name="site_phone2" class="form-control-admin"
                                        style="padding-left:36px;"
                                        value="{{ old('site_phone2', $settings['site_phone2'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label>Nomor WhatsApp <small style="color:#94a3b8;">(tanpa tanda + atau spasi)</small></label>
                                <div style="position:relative;">
                                    <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#25d366;"><i class="bi bi-whatsapp"></i></span>
                                    <input type="text" name="site_whatsapp" class="form-control-admin"
                                        style="padding-left:36px;"
                                        value="{{ old('site_whatsapp', $settings['site_whatsapp'] ?? '') }}"
                                        placeholder="6281234567890">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Alamat Lengkap</label>
                                <textarea name="site_address" class="form-control-admin" rows="3">{{ old('site_address', $settings['site_address'] ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>URL Embed Google Maps</label>
                                <input type="url" name="site_maps_embed" class="form-control-admin"
                                    value="{{ old('site_maps_embed', $settings['site_maps_embed'] ?? '') }}"
                                    placeholder="https://maps.google.com/maps?q=...&output=embed">
                                <small style="color:#94a3b8;font-size:0.75rem;">
                                    Buka <a href="https://maps.google.com" target="_blank" style="color:#1B6CA8;">Google Maps</a> → Bagikan → Sematkan Peta → salin URL dari atribut <code>src</code>.
                                </small>
                                @if(!empty($settings['site_maps_embed'] ?? ''))
                                <div class="mt-2" style="border-radius:10px;overflow:hidden;border:1px solid #e2e8f0;">
                                    <iframe src="{{ $settings['site_maps_embed'] }}" width="100%" height="200" style="border:0;" allowfullscreen loading="lazy"></iframe>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB: MEDIA SOSIAL --}}
        <div class="tab-pane fade" id="sosmed" role="tabpanel">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5><i class="bi bi-share-fill me-2" style="color:#1B6CA8;"></i>Media Sosial</h5>
                </div>
                <div class="admin-card-body p-4">
                    <div class="row g-4">
                        @foreach([
                            ['key'=>'social_facebook',  'label'=>'Facebook',  'icon'=>'bi-facebook',  'color'=>'#1877f2', 'ph'=>'https://facebook.com/ptICDE'],
                            ['key'=>'social_instagram', 'label'=>'Instagram', 'icon'=>'bi-instagram', 'color'=>'#e1306c', 'ph'=>'https://instagram.com/ptICDE'],
                            ['key'=>'social_linkedin',  'label'=>'LinkedIn',  'icon'=>'bi-linkedin',  'color'=>'#0a66c2', 'ph'=>'https://linkedin.com/company/ptICDE'],
                            ['key'=>'social_youtube',   'label'=>'YouTube',   'icon'=>'bi-youtube',   'color'=>'#ff0000', 'ph'=>'https://youtube.com/@ptICDE'],
                            ['key'=>'social_twitter',   'label'=>'X (Twitter)','icon'=>'bi-twitter-x','color'=>'#000',    'ph'=>'https://x.com/ptICDE'],
                        ] as $s)
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label><i class="bi {{ $s['icon'] }} me-1" style="color:{{ $s['color'] }};"></i>{{ $s['label'] }}</label>
                                <input type="url" name="{{ $s['key'] }}" class="form-control-admin"
                                    value="{{ old($s['key'], $settings[$s['key']] ?? '') }}"
                                    placeholder="{{ $s['ph'] }}">
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Preview badges --}}
                    <div class="mt-4" style="background:#f8fafc;border-radius:12px;padding:20px;border:1px solid #e2e8f0;">
                        <div style="font-size:0.78rem;color:#94a3b8;margin-bottom:12px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Preview Ikon Sosial</div>
                        <div class="d-flex gap-2 flex-wrap" id="socialPreview">
                            @foreach(['social_facebook'=>['bi-facebook','#1877f2'],'social_instagram'=>['bi-instagram','#e1306c'],'social_linkedin'=>['bi-linkedin','#0a66c2'],'social_youtube'=>['bi-youtube','#ff0000'],'social_twitter'=>['bi-twitter-x','#000']] as $k=>[$icon,$color])
                            @if(!empty($settings[$k] ?? ''))
                            <a href="{{ $settings[$k] }}" target="_blank" style="width:40px;height:40px;border-radius:10px;background:{{ $color }};display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.1rem;text-decoration:none;">
                                <i class="bi {{ $icon }}"></i>
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB: LOGO & TAMPILAN --}}
        <div class="tab-pane fade" id="tampilan" role="tabpanel">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5><i class="bi bi-image-fill me-2" style="color:#1B6CA8;"></i>Logo & Favicon</h5>
                </div>
                <div class="admin-card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Logo Perusahaan</label>
                                <input type="file" name="site_logo" class="form-control-admin @error('site_logo') is-invalid @enderror"
                                    accept="image/png,image/jpg,image/jpeg,image/svg+xml,image/webp" id="logoInput" onchange="previewFile(this,'logoPreview')">
                                @error('site_logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small style="color:#94a3b8;font-size:0.75rem;">Format: PNG, JPG, SVG, WebP. Maks 2MB. Rekomendasi: PNG transparan, lebar min. 300px.</small>
                            </div>
                            <div class="mt-3" style="background:#f8fafc;border-radius:12px;padding:20px;border:1px solid #e2e8f0;min-height:100px;display:flex;align-items:center;justify-content:center;">
                                @if(!empty($settings['site_logo'] ?? ''))
                                <img id="logoPreview" src="{{ asset('storage/'.$settings['site_logo']) }}" style="max-height:80px;max-width:100%;object-fit:contain;">
                                @else
                                <img id="logoPreview" src="" style="max-height:80px;max-width:100%;object-fit:contain;display:none;">
                                <span id="logoPlaceholder" style="color:#cbd5e1;font-size:0.85rem;"><i class="bi bi-image me-1"></i>Belum ada logo</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Favicon <small style="color:#94a3b8;">(ikon tab browser)</small></label>
                                <input type="file" name="site_favicon" class="form-control-admin @error('site_favicon') is-invalid @enderror"
                                    accept="image/png,image/x-icon,image/jpg" id="faviconInput" onchange="previewFile(this,'faviconPreview','faviconPlaceholder')">
                                @error('site_favicon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small style="color:#94a3b8;font-size:0.75rem;">Format: PNG, ICO, JPG. Maks 512KB. Ukuran rekomendasi: 32×32px atau 64×64px.</small>
                            </div>
                            <div class="mt-3" style="background:#f8fafc;border-radius:12px;padding:20px;border:1px solid #e2e8f0;min-height:100px;display:flex;align-items:center;justify-content:center;">
                                @if(!empty($settings['site_favicon'] ?? ''))
                                <img id="faviconPreview" src="{{ asset('storage/'.$settings['site_favicon']) }}" style="max-height:64px;max-width:64px;">
                                @else
                                <img id="faviconPreview" src="" style="max-height:64px;max-width:64px;display:none;">
                                <span id="faviconPlaceholder" style="color:#cbd5e1;font-size:0.85rem;"><i class="bi bi-star me-1"></i>Belum ada favicon</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB: SEO --}}
        <div class="tab-pane fade" id="seo" role="tabpanel">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5><i class="bi bi-search me-2" style="color:#1B6CA8;"></i>SEO & Analitik</h5>
                </div>
                <div class="admin-card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Meta Author</label>
                                <input type="text" name="meta_author" class="form-control-admin"
                                    value="{{ old('meta_author', $settings['meta_author'] ?? '') }}"
                                    placeholder="PT ICDE">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Meta Keywords</label>
                                <input type="text" name="site_keywords" class="form-control-admin"
                                    value="{{ old('site_keywords', $settings['site_keywords'] ?? '') }}"
                                    placeholder="konsultan teknik, perencanaan infrastruktur, ...">
                                <small style="color:#94a3b8;font-size:0.75rem;">Pisahkan dengan koma. Maks 10 kata kunci.</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Google Analytics ID / Kode Tracking</label>
                                <input type="text" name="google_analytics" class="form-control-admin font-monospace"
                                    value="{{ old('google_analytics', $settings['google_analytics'] ?? '') }}"
                                    placeholder="G-XXXXXXXXXX atau UA-XXXXXXXX-X">
                                <small style="color:#94a3b8;font-size:0.75rem;">Kosongkan jika tidak menggunakan Google Analytics.</small>
                            </div>
                        </div>

                        {{-- SEO Preview --}}
                        <div class="col-12">
                            <div style="background:#f8fafc;border-radius:12px;padding:20px;border:1px solid #e2e8f0;">
                                <div style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px;">Pratinjau Search Engine</div>
                                <div style="font-family:Arial,sans-serif;max-width:600px;">
                                    <div style="font-size:1rem;color:#1a0dab;cursor:pointer;">
                                        {{ $settings['site_name'] ?? 'PT ICDE' }} – {{ $settings['site_tagline'] ?? 'Konsultan Teknik' }}
                                    </div>
                                    <div style="font-size:0.82rem;color:#006621;margin:2px 0;">www.icde.id</div>
                                    <div style="font-size:0.85rem;color:#545454;line-height:1.5;">
                                        {{ Str::limit($settings['site_description'] ?? 'Deskripsi perusahaan akan muncul di sini...', 160) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB: MAINTENANCE --}}
        <div class="tab-pane fade" id="maintenance" role="tabpanel">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5><i class="bi bi-tools me-2" style="color:#1B6CA8;"></i>Mode Maintenance</h5>
                </div>
                <div class="admin-card-body p-4">
                    <div style="background:#fff7ed;border:1px solid #fed7aa;border-radius:12px;padding:14px 16px;margin-bottom:22px;color:#9a3412;font-size:0.84rem;">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        Saat mode maintenance aktif, semua halaman publik akan menampilkan halaman maintenance. Halaman admin tetap bisa diakses.
                    </div>

                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-check form-switch" style="display:flex;align-items:center;gap:10px;padding-left:0;">
                                <input type="hidden" name="maintenance_mode" value="0">
                                <input class="form-check-input" type="checkbox" name="maintenance_mode" value="1"
                                    style="width:48px;height:25px;margin:0;"
                                    {{ old('maintenance_mode', $settings['maintenance_mode'] ?? '0') === '1' ? 'checked' : '' }}>
                                <span style="font-size:0.9rem;font-weight:600;color:#1f2937;">Aktifkan Mode Maintenance</span>
                            </label>
                            @error('maintenance_mode')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Judul Halaman Maintenance</label>
                                <input type="text" name="maintenance_title" class="form-control-admin @error('maintenance_title') is-invalid @enderror"
                                    value="{{ old('maintenance_title', $settings['maintenance_title'] ?? 'Website Sedang Maintenance') }}"
                                    placeholder="Website Sedang Maintenance">
                                @error('maintenance_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Pesan Maintenance</label>
                                <textarea name="maintenance_message" class="form-control-admin @error('maintenance_message') is-invalid @enderror" rows="4"
                                    placeholder="Mohon maaf, website sedang dalam proses pemeliharaan. Silakan coba kembali beberapa saat lagi.">{{ old('maintenance_message', $settings['maintenance_message'] ?? 'Mohon maaf, website sedang dalam proses pemeliharaan. Silakan coba kembali beberapa saat lagi.') }}</textarea>
                                @error('maintenance_message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- end tab-content --}}

    {{-- Sticky Save Button --}}
    <div style="position:sticky;bottom:24px;z-index:100;margin-top:24px;">
        <div style="background:#fff;border-radius:14px;padding:16px 24px;box-shadow:0 8px 30px rgba(0,0,0,0.12);border:1px solid #e2e8f0;display:flex;align-items:center;gap:12px;">
            <button type="submit" class="btn-admin btn-primary-admin" style="font-size:0.9rem;padding:11px 28px;">
                <i class="bi bi-save-fill me-2"></i>Simpan Semua Pengaturan
            </button>
            <span style="font-size:0.8rem;color:#94a3b8;"><i class="bi bi-info-circle me-1"></i>Perubahan akan langsung diterapkan ke website.</span>
        </div>
    </div>
</form>

@push('scripts')
<script>
function previewFile(input, previewId, placeholderId) {
    const preview = document.getElementById(previewId);
    const placeholder = placeholderId ? document.getElementById(placeholderId) : null;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    if (!window.location.hash) return;

    const hash = window.location.hash;
    const trigger = document.querySelector(`[data-bs-target="${hash}"]`);
    if (trigger) {
        const tab = new bootstrap.Tab(trigger);
        tab.show();
    }
});
</script>
@endpush
@endsection
