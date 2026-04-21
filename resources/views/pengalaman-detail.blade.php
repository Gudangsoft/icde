@extends('layouts.app')

@section('title', $pengalaman->nama_proyek . ' - Pengalaman PT ICDE')

@push('styles')
<style>
/* ── Hero Banner ── */
.detail-hero {
    background: var(--hero-bg, linear-gradient(135deg, #0d2c54 0%, #1B6CA8 60%, #1e88e5 100%));
    padding: 32px 0 40px;
    position: relative;
    overflow: hidden;
}
.detail-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.detail-hero-inner {
    position: relative;
    z-index: 1;
}
.hero-logo-box {
    width: 90px;
    height: 90px;
    background: #fff;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
    padding: 10px;
    flex-shrink: 0;
}
.hero-logo-box img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.hero-title {
    font-size: 1.7rem;
    font-weight: 800;
    color: #fff;
    line-height: 1.35;
    margin-bottom: 14px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.2);
}
@media(max-width:768px) { .hero-title { font-size: 1.25rem; } }

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(4px);
    border: 1px solid rgba(255,255,255,0.25);
    color: #fff;
    font-size: 0.8rem;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 20px;
    margin: 4px 6px 4px 0;
}
.hero-badge.accent {
    background: rgba(255,255,255,0.9);
    color: var(--icde-primary);
    border-color: transparent;
    font-weight: 800;
}

/* ── Breadcrumb area ── */
.detail-breadcrumb {
    background: #fff;
    border-bottom: 1px solid #e8edf5;
    padding: 12px 0;
    font-size: 0.82rem;
}

/* ── Content layout ── */
.detail-layout {
    display: flex;
    flex-direction: column;
    gap: 24px;
    padding: 24px 0 60px;
}

/* ── Section card ── */
.section-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e8edf5;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    margin-bottom: 24px;
    overflow: hidden;
}
.section-card-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 16px 22px;
    border-bottom: 1px solid #f1f5f9;
    background: #f8fafc;
}
.section-card-header h3 {
    font-size: 0.82rem;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    margin: 0;
}
.section-card-header i {
    color: var(--icde-primary);
    font-size: 1rem;
}
.section-card-body {
    padding: 22px;
}

/* ── Description text ── */
.proyek-deskripsi {
    font-size: 0.95rem;
    color: #475569;
    line-height: 1.85;
}
.proyek-deskripsi p { margin-bottom: 1rem; }

/* ── Gallery grid ── */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}
@media(max-width:575px) { .gallery-grid { grid-template-columns: repeat(2,1fr); } }

.gallery-thumb {
    position: relative;
    aspect-ratio: 4/3;
    border-radius: 10px;
    overflow: hidden;
    cursor: zoom-in;
    background: #f1f5f9;
}
.gallery-thumb img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .35s;
}
.gallery-thumb:hover img { transform: scale(1.08); }
.gallery-thumb-overlay {
    position: absolute; inset: 0;
    background: rgba(27,108,168,0);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1.4rem;
    opacity: 0;
    transition: all .3s;
}
.gallery-thumb:hover .gallery-thumb-overlay {
    background: rgba(27,108,168,0.45);
    opacity: 1;
}

/* ── Sidebar info card ── */
.info-row {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.85rem;
}
.info-row:last-child { border-bottom: none; padding-bottom: 0; }
.info-row i {
    color: var(--icde-primary);
    font-size: 1rem;
    flex-shrink: 0;
    margin-top: 2px;
}
.info-row .info-label {
    font-size: 0.72rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    display: block;
    margin-bottom: 2px;
}
.info-row .info-value {
    font-weight: 600;
    color: var(--icde-dark);
    line-height: 1.4;
}

/* ── Back button ── */
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    border: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    color: var(--icde-primary);
    font-size: 0.88rem;
    font-weight: 700;
    padding: 10px 24px;
    border-radius: 30px;
    text-decoration: none;
    transition: all .2s;
    margin-bottom: 0;
}
.btn-back i {
    font-size: 1rem;
    transition: transform .2s;
}
.btn-back:hover {
    background: var(--icde-primary);
    color: #fff;
    box-shadow: 0 6px 16px rgba(27,108,168,0.25);
    transform: translateY(-2px);
}
.btn-back:hover i {
    transform: translateX(-4px);
}

/* ── Related projects ── */
.related-card {
    display: flex;
    gap: 14px;
    align-items: flex-start;
    padding: 14px 0;
    border-bottom: 1px solid #f1f5f9;
    text-decoration: none;
    color: inherit;
    transition: all .2s;
}
.related-card:last-child { border-bottom: none; padding-bottom: 0; }
.related-card:hover { color: var(--icde-primary); }
.related-card:hover .related-title { color: var(--icde-primary); }
.related-year {
    background: var(--related-bg, var(--icde-primary));
    color: #fff;
    font-size: 0.72rem;
    font-weight: 800;
    border-radius: 8px;
    padding: 4px 10px;
    flex-shrink: 0;
    align-self: flex-start;
    margin-top: 2px;
}
.related-title {
    font-size: 0.83rem;
    font-weight: 700;
    color: var(--icde-dark);
    line-height: 1.4;
    margin-bottom: 4px;
    transition: color .2s;
}
.related-meta {
    font-size: 0.75rem;
    color: #94a3b8;
}

/* ── Lightbox ── */
.lightbox-overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.92);
    z-index: 1200;
    display: flex; align-items: center; justify-content: center;
    opacity: 0; pointer-events: none;
    transition: opacity .3s;
}
.lightbox-overlay.show { opacity: 1; pointer-events: all; }
.lightbox-img {
    max-width: 92vw;
    max-height: 86vh;
    border-radius: 10px;
    object-fit: contain;
    transform: scale(0.93);
    transition: transform .3s;
}
.lightbox-overlay.show .lightbox-img { transform: scale(1); }
.lightbox-close {
    position: absolute; top: 20px; right: 24px;
    color: #fff; font-size: 2rem; cursor: pointer;
    background: rgba(255,255,255,.1); border: none;
    width: 44px; height: 44px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    transition: background .2s;
}
.lightbox-close:hover { background: rgba(255,255,255,.22); }
.lightbox-nav {
    position: absolute; top: 50%; transform: translateY(-50%);
    background: rgba(255,255,255,.12);
    border: none; color: #fff; font-size: 1.5rem;
    width: 48px; height: 48px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: background .2s;
}
.lightbox-nav:hover { background: rgba(255,255,255,.26); }
.lightbox-nav.prev { left: 16px; }
.lightbox-nav.next { right: 16px; }
.lightbox-counter {
    position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);
    color: rgba(255,255,255,.65); font-size: 0.82rem;
    background: rgba(0,0,0,.35); padding: 4px 14px; border-radius: 20px;
}
</style>
@endpush

@section('content')
@php
    use App\Models\Layanan;
    
    $katBgColors = [
        '#1565C0', '#E65100', '#2E7D32', '#B71C1C', '#00695C', '#1A237E', 
        '#6A1B9A', '#D84315', '#283593', '#0277BD', '#558B2F', '#4E342E'
    ];

    $layanans = Layanan::where('aktif', true)->orderBy('urutan')->get();
    
    $katConfig = [];
    foreach($layanans as $idx => $lyn) {
        $katConfig[$lyn->judul] = $katBgColors[$idx % count($katBgColors)];
    }
    $catColor = isset($pengalaman->kategori) && isset($katConfig[$pengalaman->kategori]) ? $katConfig[$pengalaman->kategori] : null;
@endphp

{{-- ── Breadcrumb strip ── --}}
<div class="detail-breadcrumb">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pengalaman') }}">Pengalaman</a></li>
            @if($pengalaman->kategori)
            <li class="breadcrumb-item">
                <a href="{{ route('pengalaman', ['kategori' => $pengalaman->kategori]) }}">
                    {{ $pengalaman->kategori }}
                </a>
            </li>
            @endif
            <li class="breadcrumb-item active">{{ Str::limit($pengalaman->nama_proyek, 40) }}</li>
        </ol>
    </div>
</div>

{{-- ── Hero Banner ── --}}
<div class="detail-hero" {!! $catColor ? 'style="--hero-bg: '.$catColor.';"' : '' !!}>
    <div class="container detail-hero-inner">
        <div class="d-flex flex-column flex-md-row align-items-start gap-4">

            {{-- Logo --}}
            <div class="hero-logo-box" data-aos="zoom-in">
                @if($pengalaman->logo)
                    <img src="{{ asset('storage/' . $pengalaman->logo) }}"
                         alt="Logo {{ $pengalaman->pemberi_kerja }}">
                @else
                    <i class="bi bi-building" style="font-size:3.2rem; color:#cbd5e1;"></i>
                @endif
            </div>

            {{-- Title & badges --}}
            <div data-aos="fade-up">
                <div class="hero-title">{{ $pengalaman->nama_proyek }}</div>
                <div>
                    <span class="hero-badge accent">
                        <i class="bi bi-calendar-event"></i> {{ $pengalaman->tahun }}
                    </span>
                    <span class="hero-badge">
                        <i class="bi bi-person-workspace"></i> {{ $pengalaman->pemberi_kerja }}
                    </span>
                    @if($pengalaman->lokasi)
                    <span class="hero-badge">
                        <i class="bi bi-geo-alt-fill"></i> {{ $pengalaman->lokasi }}
                    </span>
                    @endif
                    @if($pengalaman->kategori)
                    <span class="hero-badge">
                        <i class="bi bi-bookmark-fill"></i> {{ $pengalaman->kategori }}
                    </span>
                    @endif
                    @if($pengalaman->galeri_proyek && count($pengalaman->galeri_proyek) > 0)
                    <span class="hero-badge">
                        <i class="bi bi-images"></i> {{ count($pengalaman->galeri_proyek) }} Foto
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Main Content ── --}}
<section style="background:#f8fafc;">
    <div class="container">
        <div class="detail-layout">

            {{-- ── LEFT: Description + Gallery ── --}}
            <div>

                {{-- Back button --}}
                <div class="mt-0 mb-3" data-aos="fade-right">
                    <a href="{{ route('pengalaman', ['kategori' => $pengalaman->kategori]) }}"
                       class="btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pekerjaan
                    </a>
                </div>

                {{-- Description --}}
                @if($pengalaman->deskripsi)
                <div class="card border-0 shadow-lg mb-4" data-aos="fade-up" style="border-radius: 24px; overflow: hidden; background: {{ $catColor ?? 'linear-gradient(135deg, #0d2c54 0%, #1B6CA8 60%, #1e88e5 100%)' }}; color: white; position: relative;">
                    <!-- Dekorasi Background -->
                    <i class="bi bi-file-text position-absolute" style="font-size: 14rem; opacity: 0.05; top: -30px; right: -20px; transform: rotate(-10deg);"></i>
                    <i class="bi bi-stars position-absolute" style="font-size: 3rem; opacity: 0.15; bottom: 20px; left: 30px;"></i>
                    
                    <div class="p-4 p-md-5 position-relative z-1">
                        <div class="d-inline-flex align-items-center justify-content-center mb-4" style="width: 60px; height: 60px; background: rgba(255,255,255,0.1); border-radius: 50%; border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(0,0,0,0.1);">
                            <i class="bi bi-file-text-fill text-white fs-3"></i>
                        </div>
                        <h3 class="fw-bold mb-4" style="letter-spacing: 1px; color: #fff;">Deskripsi Pekerjaan</h3>
                        
                        <div class="proyek-deskripsi text-white" style="font-size: 1.05rem; line-height: 1.8; color: rgba(255,255,255,0.95) !important;">
                            {!! $pengalaman->deskripsi !!}
                        </div>
                        <style>
                            .proyek-deskripsi.text-white p, .proyek-deskripsi.text-white span, .proyek-deskripsi.text-white div, .proyek-deskripsi.text-white li { 
                                color: rgba(255,255,255,0.95) !important;
                            }
                        </style>
                    </div>
                </div>
                @endif

                {{-- Gallery --}}
                @if($pengalaman->galeri_proyek && count($pengalaman->galeri_proyek) > 0)
                <div class="section-card" data-aos="fade-up">
                    <div class="section-card-header">
                        <i class="bi bi-images"></i>
                        <h3>Galeri Proyek &nbsp;<span style="color:#94a3b8;font-weight:500;text-transform:none;letter-spacing:0;">{{ count($pengalaman->galeri_proyek) }} foto</span></h3>
                    </div>
                    <div class="section-card-body">
                        <div class="gallery-grid">
                            @foreach($pengalaman->galeri_proyek as $i => $foto)
                            <div class="gallery-thumb" onclick="openLightbox({{ $i }})">
                                <img src="{{ asset('storage/' . $foto) }}"
                                     alt="Galeri Proyek {{ $i + 1 }}"
                                     loading="lazy">
                                <div class="gallery-thumb-overlay">
                                    <i class="bi bi-zoom-in"></i>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

            </div>

            {{-- ── RIGHT: Info sidebar ── --}}
            <div>

                {{-- Project Info --}}


                {{-- Related projects --}}
                @if($related && $related->count() > 0)
                <div class="section-card" data-aos="fade-up">
                    <div class="section-card-header">
                        <i class="bi bi-layers-fill"></i>
                        <h3>Proyek Terkait</h3>
                    </div>
                    <div class="section-card-body" style="padding:14px 22px;">
                        @foreach($related as $rel)
                        @php
                            $relColor = isset($rel->kategori) && isset($katConfig[$rel->kategori]) ? $katConfig[$rel->kategori] : 'var(--icde-primary)';
                        @endphp
                        <a href="{{ route('pengalaman.detail', $rel->id) }}" class="related-card" style="--related-bg: {{ $relColor }};">
                            <span class="related-year">{{ $rel->tahun }}</span>
                            <div>
                                <div class="related-title">{{ $rel->nama_proyek }}</div>
                                <div class="related-meta">
                                    <i class="bi bi-building"></i> {{ $rel->pemberi_kerja }}
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

{{-- ── Lightbox ── --}}
<div id="lightboxOverlay" class="lightbox-overlay" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()"><i class="bi bi-x"></i></button>
    <button class="lightbox-nav prev" onclick="event.stopPropagation();lightboxPrev()">
        <i class="bi bi-chevron-left"></i>
    </button>
    <img id="lightbox-img" class="lightbox-img" src="" alt="Galeri">
    <button class="lightbox-nav next" onclick="event.stopPropagation();lightboxNext()">
        <i class="bi bi-chevron-right"></i>
    </button>
    <span id="lightbox-counter" class="lightbox-counter"></span>
</div>

@push('scripts')
<script>
// Gallery images from PHP
const galleryImages = @json(
    collect($pengalaman->galeri_proyek ?? [])->map(fn($p) => asset('storage/'.$p))->values()
);

let lbIndex = 0;

function openLightbox(idx) {
    lbIndex = idx;
    updateLightbox();
    document.getElementById('lightboxOverlay').classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightboxOverlay').classList.remove('show');
    document.body.style.overflow = '';
}
function lightboxPrev() {
    lbIndex = (lbIndex - 1 + galleryImages.length) % galleryImages.length;
    updateLightbox();
}
function lightboxNext() {
    lbIndex = (lbIndex + 1) % galleryImages.length;
    updateLightbox();
}
function updateLightbox() {
    document.getElementById('lightbox-img').src = galleryImages[lbIndex];
    document.getElementById('lightbox-counter').textContent =
        (lbIndex + 1) + ' / ' + galleryImages.length;
}

document.addEventListener('keydown', e => {
    const lb = document.getElementById('lightboxOverlay');
    if (!lb.classList.contains('show')) return;
    if (e.key === 'Escape')      closeLightbox();
    if (e.key === 'ArrowLeft')   lightboxPrev();
    if (e.key === 'ArrowRight')  lightboxNext();
});
</script>
@endpush
@endsection
