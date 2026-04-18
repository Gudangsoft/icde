@extends('admin.layouts.app')
@section('title', 'Judul Seksi Homepage')
@section('page_title', 'Pengaturan Judul Seksi Homepage')

@push('styles')
<style>
/* Premium Section Management Layout */
.section-wrapper {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.04);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    min-height: 480px;
    display: flex;
    flex-direction: row;
}
.sidebar-menu {
    background: #f8fafc;
    border-right: 1px solid #e2e8f0;
    padding: 20px 14px;
    width: 320px;
    flex-shrink: 0;
}
.menu-item-btn {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 16px;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid transparent;
    margin-bottom: 8px;
    background: transparent;
    width: 100%;
    text-align: left;
}
.menu-item-btn:hover {
    background: #fff;
    border-color: #e2e8f0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.menu-item-btn.active {
    background: #fff;
    border-color: rgba(18,102,66,0.2);
    box-shadow: 0 4px 15px rgba(18,102,66,0.08);
    position: relative;
    z-index: 10;
}
.menu-item-btn.active::before {
    content: '';
    position: absolute;
    left: -14px;
    top: 50%;
    transform: translateY(-50%);
    height: 60%;
    width: 4px;
    background: var(--icde-primary);
    border-radius: 0 4px 4px 0;
}
.menu-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    background: rgba(11,44,95,0.06);
    color: var(--icde-navy-mid);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    flex-shrink: 0;
}
.menu-item-btn.active .menu-icon {
    background: var(--icde-primary);
    color: #fff;
    transform: scale(1.05);
}
.menu-text h6 { margin: 0 0 2px; font-size: 0.88rem; font-weight: 700; color: #1e293b; }
.menu-text small { color: #64748b; font-size: 0.72rem; display: block; line-height: 1.3; }

.content-area-main {
    flex: 1;
    background: #fff;
    min-width: 0;
}
.content-pane {
    padding: 32px;
    display: none;
    animation: fadeIn 0.4s ease forwards;
}
.content-pane.active { display: block; }
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.pane-header {
    display: flex; justify-content: space-between; align-items: flex-start;
    padding-bottom: 20px;
    border-bottom: 1px dashed #e2e8f0;
    margin-bottom: 24px;
    gap: 15px;
}
.pane-title { display: flex; flex-direction: column; gap: 6px; }
.pane-title h4 { margin: 0; font-weight: 800; color: #1e293b; font-size: 1.3rem; display: flex; align-items: center; gap: 10px; }
.pane-title p { margin: 0; color: #64748b; font-size: 0.85rem; }

/* Custom Switch */
.switch-wrapper {
    display: flex; align-items: center; gap: 10px;
    background: #f8fafc; padding: 10px 18px; border-radius: 30px; border: 1px solid #e2e8f0;
}
.switch-wrapper span { font-weight: 700; font-size: 0.82rem; color: #374151; }

/* Field Styles */
.custom-field-group {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px 18px;
    margin-bottom: 16px;
    transition: all 0.2s;
}
.custom-field-group:focus-within {
    background: #fff;
    border-color: rgba(18,102,66,0.4);
    box-shadow: 0 4px 15px rgba(18,102,66,0.06);
}
.custom-label {
    display: block; font-size: 0.74rem; font-weight: 700; color: #64748b;
    text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px;
}
.custom-input {
    width: 100%; border: none; background: transparent;
    font-size: 0.95rem; color: #1e293b; font-weight: 600;
    font-family: 'Inter', sans-serif; padding: 0;
}
.custom-input:focus { outline: none; }
.custom-input::placeholder { color: #cbd5e1; font-weight: 400; }

.btn-save-modern {
    background: linear-gradient(135deg, var(--icde-primary), var(--icde-primary-dark));
    color: #fff; border: none; padding: 12px 30px; border-radius: 10px;
    font-size: 0.9rem; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;
    cursor: pointer; transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(18,102,66,0.25);
}
.btn-save-modern:hover {
    transform: translateY(-2px); box-shadow: 0 6px 20px rgba(18,102,66,0.35); color: #fff;
}
.btn-save-modern.saving { opacity: 0.7; pointer-events: none; }
.feedback-msg { display: none; align-items: center; gap: 6px; font-weight: 600; font-size: 0.85rem; padding: 10px 18px; border-radius: 10px; }
.feedback-success { background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.2); }
.feedback-error { background: rgba(239,68,68,0.1); color: #ef4444; border: 1px solid rgba(239,68,68,0.2); }

@media (max-width: 991px) {
    .section-wrapper { flex-direction: column; }
    .sidebar-menu { width: 100%; border-right: none; border-bottom: 1px solid #e2e8f0; display: flex; overflow-x: auto; padding: 16px; gap: 12px; }
    .menu-item-btn { width: auto; flex-shrink: 0; min-width: 240px; margin-bottom: 0; }
    .menu-item-btn.active::before { left: 50%; top: auto; bottom: -16px; width: 40%; height: 4px; transform: translateX(-50%); border-radius: 4px 4px 0 0; }
    .content-pane { padding: 24px 20px; }
    .pane-header { flex-direction: column; align-items: stretch; }
    .switch-wrapper { justify-content: space-between; }
}
</style>
@endpush

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h4 style="font-weight:800;color:#1e293b;margin:0;"><i class="bi bi-layout-text-window-reverse me-2" style="color:var(--icde-primary);"></i>Manajemen Tampilan Seksi</h4>
        <p style="font-size:0.85rem;color:#64748b;margin:4px 0 0;">Ubah judul dan visibilitas setiap area pada halaman beranda utama.</p>
    </div>
    <a href="{{ route('beranda') }}" target="_blank" class="btn-save-modern" style="background:#fff;color:var(--icde-primary);border:1px solid #e2e8f0;box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <i class="bi bi-box-arrow-up-right"></i> Lihat Website
    </a>
</div>

@php
$sections = [
    [
        'key'   => 'layanan',
        'icon'  => 'bi-briefcase-fill',
        'label' => 'Lingkup Layanan',
        'desc'  => 'Kartu daftar layanan kami',
        'show_key' => 'show_section_layanan',
        'fields' => [
            ['key' => 'section_layanan_title',    'label' => 'Teks Judul',    'ph' => 'Lingkup Layanan'],
            ['key' => 'section_layanan_subtitle',  'label' => 'Teks Subjudul', 'ph' => 'Kami menyediakan...'],
        ],
    ],
    [
        'key'   => 'stats',
        'icon'  => 'bi-bar-chart-fill',
        'label' => 'Statistik Pencapaian',
        'desc'  => 'Strip angka penting (Tahun, Proyek, dll)',
        'show_key' => 'show_section_stats',
        'fields' => [
            ['key' => 'stat_1_num',   'label' => 'Angka Kotak 1',  'ph' => '25+'],
            ['key' => 'stat_1_label', 'label' => 'Label Kotak 1',  'ph' => 'Tahun Berpengalaman'],
            ['key' => 'stat_2_num',   'label' => 'Angka Kotak 2',  'ph' => '500+'],
            ['key' => 'stat_2_label', 'label' => 'Label Kotak 2',  'ph' => 'Proyek Diselesaikan'],
            ['key' => 'stat_3_num',   'label' => 'Angka Kotak 3',  'ph' => '100+'],
            ['key' => 'stat_3_label', 'label' => 'Label Kotak 3',  'ph' => 'Klien Pemerintah & Swasta'],
            ['key' => 'stat_4_num',   'label' => 'Angka Kotak 4',  'ph' => '50+'],
            ['key' => 'stat_4_label', 'label' => 'Label Kotak 4',  'ph' => 'Tenaga Ahli Bersertifikat'],
        ],
    ],
    [
        'key'   => 'why',
        'icon'  => 'bi-patch-check-fill',
        'label' => 'Mengapa Memilih Kami',
        'desc'  => 'Empat alasan keunggulan',
        'show_key' => 'show_section_why',
        'fields' => [
            ['key' => 'section_why_title',        'label' => 'Judul Seksi',    'ph' => 'Mengapa Memilih PT ICDE?'],
            ['key' => 'section_why_subtitle',     'label' => 'Penjelasan Singkat', 'ph' => 'Kami berkomitmen...'],
            ['key' => 'section_why_item1_title',  'label' => 'Keunggulan 1',   'ph' => 'Pengalaman 25+ Tahun'],
            ['key' => 'section_why_item1_desc',   'label' => 'Deskripsi 1',  'ph' => 'Lebih dari dua dekade...'],
            ['key' => 'section_why_item2_title',  'label' => 'Keunggulan 2',   'ph' => 'Tenaga Ahli Bersertifikasi'],
            ['key' => 'section_why_item2_desc',   'label' => 'Deskripsi 2',  'ph' => 'Tim multidisiplin...'],
            ['key' => 'section_why_item3_title',  'label' => 'Keunggulan 3',   'ph' => 'Berbasis Data & Analitik'],
            ['key' => 'section_why_item3_desc',   'label' => 'Deskripsi 3',  'ph' => 'Setiap rekomendasi...'],
            ['key' => 'section_why_item4_title',  'label' => 'Keunggulan 4',   'ph' => 'Terpercaya & Independen'],
            ['key' => 'section_why_item4_desc',   'label' => 'Deskripsi 4',  'ph' => 'Menjaga independensi...'],
        ],
    ],
    [
        'key'   => 'pengalaman',
        'icon'  => 'bi-clock-history',
        'label' => 'Pengalaman Terbaru',
        'desc'  => 'Daftar proyek terkini',
        'show_key' => 'show_section_pengalaman',
        'fields' => [
            ['key' => 'section_pengalaman_title',    'label' => 'Teks Judul',    'ph' => 'Pengalaman Terbaru'],
            ['key' => 'section_pengalaman_subtitle', 'label' => 'Teks Subjudul', 'ph' => 'Beberapa proyek terkini...'],
        ],
    ],
    [
        'key'   => 'klien',
        'icon'  => 'bi-building-fill',
        'label' => 'Klien & Mitra',
        'desc'  => 'Logo carousel klien (slider)',
        'show_key' => 'show_section_klien',
        'fields' => [
            ['key' => 'section_klien_title', 'label' => 'Teks Judul', 'ph' => 'Klien & Mitra Kami'],
        ],
    ],
    [
        'key'   => 'testimoni',
        'icon'  => 'bi-chat-quote-fill',
        'label' => 'Testimoni',
        'desc'  => 'Ulasan dari klien/mitra',
        'show_key' => 'show_section_testimoni',
        'fields' => [
            ['key' => 'section_testimoni_title', 'label' => 'Teks Judul', 'ph' => 'Apa Kata Klien Kami'],
        ],
    ],
    [
        'key'   => 'galeri',
        'icon'  => 'bi-images',
        'label' => 'Galeri ICDE',
        'desc'  => 'Foto dokumentasi & kegiatan',
        'show_key' => 'show_section_galeri',
        'fields' => [
            ['key' => 'section_galeri_badge', 'label' => 'Teks Kotak Label (Badge)', 'ph' => 'Galeri ICDE'],
            ['key' => 'section_galeri_title', 'label' => 'Teks Judul', 'ph' => 'Dokumentasi & Kegiatan'],
        ],
    ],
    [
        'key'   => 'berita',
        'icon'  => 'bi-newspaper',
        'label' => 'Berita Terkini',
        'desc'  => 'Blog dan artikel perusahaan',
        'show_key' => 'show_section_berita',
        'fields' => [
            ['key' => 'section_berita_badge', 'label' => 'Teks Kotak Label (Badge)',  'ph' => 'Berita & Informasi'],
            ['key' => 'section_berita_title', 'label' => 'Teks Judul',  'ph' => 'Berita Terbaru'],
        ],
    ],
    [
        'key'   => 'cta',
        'icon'  => 'bi-megaphone-fill',
        'label' => 'Call to Action (CTA)',
        'desc'  => 'Ajakan aksi di area footer',
        'show_key' => 'show_section_cta',
        'fields' => [
            ['key' => 'section_cta_title',    'label' => 'Judul CTA',    'ph' => 'Siap Bermitra?'],
            ['key' => 'section_cta_subtitle', 'label' => 'Deskripsi Singkat', 'ph' => 'Hubungi kami sekarang...'],
        ],
    ],
];
@endphp

<div class="section-wrapper">
    <!-- Left Navigation -->
    <div class="sidebar-menu">
        @foreach($sections as $index => $sec)
        <button class="menu-item-btn {{ $index == 0 ? 'active' : '' }}" data-target="pane-{{ $sec['key'] }}">
            <div class="menu-icon"><i class="bi {{ $sec['icon'] }}"></i></div>
            <div class="menu-text">
                <h6>{{ $sec['label'] }}</h6>
                <small>{{ $sec['desc'] }}</small>
            </div>
        </button>
        @endforeach
    </div>

    <!-- Right Content Area -->
    <div class="content-area-main">
        @foreach($sections as $index => $sec)
        <div class="content-pane {{ $index == 0 ? 'active' : '' }}" id="pane-{{ $sec['key'] }}">
            <div class="pane-header">
                <div class="pane-title">
                    <h4>{{ $sec['label'] }}</h4>
                    <p>{{ $sec['desc'] }}</p>
                </div>
                
                <div class="switch-wrapper">
                    <span>Tampilkan Seksi Ini</span>
                    <label class="form-check form-switch mb-0" style="padding-left:0;">
                        <input type="checkbox" class="form-check-input form-check-switch toggle-visibility"
                               data-key="{{ $sec['show_key'] }}"
                               {{ ($settings[$sec['show_key']] ?? '1') === '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>

            <form class="form-seksi" data-section="{{ $sec['key'] }}">
                @csrf
                <div class="row g-3">
                    @foreach($sec['fields'] as $f)
                    <div class="{{ in_array($sec['key'], ['stats', 'why']) ? 'col-md-6' : 'col-12' }}">
                        <div class="custom-field-group">
                            <span class="custom-label">{{ $f['label'] }}</span>
                            <input type="text" class="custom-input" name="{{ $f['key'] }}"
                                   value="{{ $settings[$f['key']] ?? '' }}"
                                   placeholder="{{ $f['ph'] ?? '' }}">
                        </div>
                    </div>
                    @endforeach
                </div>

                <div style="display:flex;align-items:center;gap:15px;margin-top:20px;padding-top:20px;border-top:1px dashed #e2e8f0;">
                    <button type="submit" class="btn-save-modern">
                        <i class="bi bi-save2-fill"></i> Simpan Perubahan
                    </button>
                    <div class="feedback-msg feedback-success">
                        <i class="bi bi-check-circle-fill"></i> Tersimpan sukses!
                    </div>
                    <div class="feedback-msg feedback-error">
                        <i class="bi bi-exclamation-octagon-fill"></i> Gagal menyimpan!
                    </div>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>

@endsection

@push('scripts')
<script>
// Tab Switching Logic
document.querySelectorAll('.menu-item-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Remove active class from all buttons and panes
        document.querySelectorAll('.menu-item-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.content-pane').forEach(p => p.classList.remove('active'));

        // Add active class to clicked button and corresponding pane
        this.classList.add('active');
        const targetId = this.dataset.target;
        document.getElementById(targetId).classList.add('active');
    });
});

// AJAX save per section
document.querySelectorAll('.form-seksi').forEach(function(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = form.querySelector('.btn-save-modern');
        const statusOk  = form.querySelector('.feedback-success');
        const statusErr = form.querySelector('.feedback-error');

        btn.classList.add('saving');
        btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';
        statusOk.style.display = 'none';
        statusErr.style.display = 'none';

        const formData = new FormData(form);
        formData.append('_method', 'PUT');

        fetch('{{ route("admin.seksi.update") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
            body: formData,
        })
        .then(r => r.json())
        .then(data => {
            btn.classList.remove('saving');
            btn.innerHTML = '<i class="bi bi-save2-fill"></i> Simpan Perubahan';
            if (data.success) {
                statusOk.style.display = 'inline-flex';
                setTimeout(() => { statusOk.style.display = 'none'; }, 2500);
            } else {
                statusErr.style.display = 'inline-flex';
            }
        })
        .catch(() => {
            btn.classList.remove('saving');
            btn.innerHTML = '<i class="bi bi-save2-fill"></i> Simpan Perubahan';
            statusErr.style.display = 'inline-flex';
        });
    });
});

// Toggle visibility
document.querySelectorAll('.toggle-visibility').forEach(function(chk) {
    chk.addEventListener('change', function() {
        const key = this.dataset.key;
        const val = this.checked ? '1' : '0';

        const fd = new FormData();
        fd.append('_method', 'PUT');
        fd.append(key, val);

        fetch('{{ route("admin.seksi.update") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
            body: fd,
        })
        .then(r => r.json())
        .then(data => {
            if (!data.success) { this.checked = !this.checked; }
        })
        .catch(() => { this.checked = !this.checked; });
    });
});
</script>
@endpush
