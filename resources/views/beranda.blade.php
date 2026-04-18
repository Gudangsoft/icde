@extends('layouts.app')

@section('title', 'Beranda - PT ICDE Konsultan Profesional')

@push('styles')
<style>
    /* ===== HERO ===== */
    .hero-section {
        background: linear-gradient(135deg, var(--icde-navy-dark) 0%, var(--icde-navy) 45%, var(--icde-navy-mid) 100%);
        min-height: 88vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: -80px; right: -80px;
        width: 520px; height: 520px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(232,169,0,0.06) 0%, transparent 70%);
        animation: pulse-glow 6s ease-in-out infinite;
    }
    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -120px; left: -80px;
        width: 450px; height: 450px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(30,144,212,0.07) 0%, transparent 70%);
        animation: pulse-glow 8s ease-in-out infinite reverse;
    }

    /* Ornamental geometric shapes */
    .hero-section .hero-geo-1 {
        position: absolute;
        top: 15%; right: 8%;
        width: 180px; height: 180px;
        border: 1px solid rgba(232,169,0,0.12);
        border-radius: 24px;
        transform: rotate(20deg);
        animation: float-gentle 7s ease-in-out infinite;
    }
    .hero-section .hero-geo-2 {
        position: absolute;
        bottom: 18%; left: 6%;
        width: 100px; height: 100px;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 50%;
        animation: float-gentle 5s ease-in-out infinite reverse;
    }
    @keyframes pulse-glow {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.1); }
    }
    @keyframes float-gentle {
        0%, 100% { transform: translateY(0) rotate(20deg); }
        50% { transform: translateY(-16px) rotate(25deg); }
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(132,204,22,0.15);
        border: 1px solid rgba(132,204,22,0.4);
        color: var(--icde-gold-light);
        padding: 7px 20px;
        border-radius: 30px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        margin-bottom: 22px;
    }
    .hero-badge i { color: var(--icde-gold); }
    .hero-section h1 {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-size: clamp(1.8rem, 4vw, 3rem);
        font-weight: 800;
        color: #fff;
        line-height: 1.25;
    }
    .hero-section h1 .highlight {
        background: linear-gradient(90deg, var(--icde-gold), var(--icde-gold-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-section .motto {
        font-size: 1.25rem;
        font-style: italic;
        color: var(--icde-gold-light);
        font-weight: 700;
    }
    .hero-desc { color: rgba(255,255,255,0.95); font-size: 1.1rem; font-weight: 500; line-height: 1.85; }

    .hero-stats {
        background: rgba(255,255,255,0.07);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 18px;
        padding: 28px;
        margin-top: 32px;
    }
    .stat-item { text-align: center; padding: 0 8px; }
    .stat-item .number {
        font-family: 'Poppins', sans-serif;
        font-size: 2.2rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--icde-gold), var(--icde-gold-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
    }
    .stat-item .label { color: rgba(255,255,255,0.7); font-size: 0.78rem; margin-top: 4px; }

    .hero-visual {
        width: 100%;
        max-width: 460px;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 30px 80px rgba(0,0,0,0.4), 0 0 0 1px rgba(232,169,0,0.15);
    }
    .hero-card-float {
        position: absolute;
        background: #fff;
        border-radius: 14px;
        padding: 14px 20px;
        box-shadow: 0 12px 35px rgba(0,0,0,0.20);
        font-size: 0.85rem;
    }
    .hero-card-float.card-1 { bottom: 30px; left: -20px; }
    .hero-card-float.card-2 { top: 30px; right: -20px; }

    /* ===== STATS STRIP ===== */
    .stats-strip {
        background: linear-gradient(135deg, var(--icde-gold-dark) 0%, var(--icde-gold) 50%, var(--icde-gold-light) 100%);
        padding: 32px 0;
        position: relative;
        overflow: hidden;
    }
    .stats-strip::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .stats-strip .stat-box { text-align: center; color: var(--icde-navy); position: relative; }
    .stats-strip .stat-box .num { font-family: 'Poppins', sans-serif; font-size: 2.3rem; font-weight: 900; }
    .stats-strip .stat-box .lbl { font-size: 0.82rem; font-weight: 600; opacity: 0.8; }

    /* ===== SERVICE CARD ===== */
    .service-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(11,44,95,0.07);
        padding: 32px 26px;
        transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
        background: #fff;
        height: 100%;
        border-top: 4px solid transparent;
        position: relative;
        overflow: hidden;
    }
    .service-card::before {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--icde-navy), var(--icde-sky));
        transform: scaleX(0);
        transition: transform 0.3s ease;
        transform-origin: left;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(11,44,95,0.14);
        border-top-color: var(--icde-gold);
    }
    .service-card:hover::before { transform: scaleX(1); }
    .service-icon {
        width: 68px; height: 68px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(11,44,95,0.07), rgba(30,144,212,0.1));
        display: flex; align-items: center; justify-content: center;
        font-size: 1.65rem;
        color: var(--icde-navy-mid);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .service-card:hover .service-icon {
        background: linear-gradient(135deg, var(--icde-navy), var(--icde-sky));
        color: #fff;
        transform: scale(1.05) rotate(-5deg);
    }
    .service-card h5 { font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 1.2rem; color: var(--icde-navy-dark); margin-bottom: 12px; }
    .service-card p { font-size: 1rem; color: #334155; line-height: 1.75; font-weight: 500; }

    /* ===== WHY CHOOSE US ===== */
    .why-item { display: flex; gap: 18px; margin-bottom: 28px; align-items: flex-start; }
    .why-icon {
        width: 52px; height: 52px; flex-shrink: 0;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--icde-navy-mid), var(--icde-sky));
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.3rem;
        box-shadow: 0 6px 16px rgba(11,44,95,0.25);
        transition: transform 0.3s ease;
    }
    .why-item:hover .why-icon { transform: scale(1.1) rotate(-5deg); }
    .why-item h6 { font-family: 'Poppins', sans-serif; font-size: 1.15rem; font-weight: 800; margin-bottom: 8px; color: var(--icde-navy-dark); }
    .why-item p { font-size: 1rem; font-weight: 500; color: #334155; margin: 0; line-height: 1.7; }

    /* ===== PENGALAMAN ===== */
    .exp-card {
        border-left: 4px solid var(--icde-gold);
        background: #fff;
        border-radius: 12px;
        padding: 22px 24px;
        box-shadow: 0 3px 16px rgba(11,44,95,0.06);
        transition: all 0.3s ease;
    }
    .exp-card:hover {
        box-shadow: 0 10px 30px rgba(11,44,95,0.12);
        transform: translateX(5px);
        border-left-color: var(--icde-navy-mid);
    }
    .exp-year {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--icde-gold-dark);
        background: rgba(232,169,0,0.1);
        border: 1px solid rgba(232,169,0,0.3);
        padding: 3px 12px;
        border-radius: 20px;
        display: inline-block;
    }

    /* ===== KLIEN CAROUSEL ===== */
    .klien-strip {
        background: var(--icde-light-bg);
        padding: 55px 0;
        overflow: hidden;
    }
    .klien-track {
        display: flex;
        gap: 40px;
        animation: scrollKlien 28s linear infinite;
    }
    .klien-track:hover { animation-play-state: paused; }
    @keyframes scrollKlien {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .klien-item {
        flex-shrink: 0;
        background: #fff;
        padding: 16px 28px;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(11,44,95,0.07);
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 160px;
        height: 72px;
        font-weight: 700;
        color: var(--icde-gray);
        font-size: 0.85rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(11,44,95,0.06);
    }
    .klien-item:hover {
        border-color: var(--icde-gold);
        box-shadow: 0 6px 22px rgba(232,169,0,0.15);
    }
    .klien-item img { max-height: 45px; max-width: 130px; object-fit: contain; }

    /* ===== TESTIMONI ===== */
    .testimoni-card {
        background: #fff;
        border-radius: 18px;
        padding: 32px;
        box-shadow: 0 4px 24px rgba(11,44,95,0.07);
        position: relative;
        height: 100%;
        border: 1px solid rgba(11,44,95,0.05);
        transition: all 0.3s ease;
    }
    .testimoni-card:hover {
        box-shadow: 0 16px 40px rgba(11,44,95,0.12);
        transform: translateY(-4px);
        border-color: rgba(232,169,0,0.2);
    }
    .testimoni-card::before {
        content: '\201C';
        position: absolute;
        top: 10px; left: 18px;
        font-size: 5rem;
        color: rgba(11,44,95,0.06);
        font-family: Georgia, serif;
        line-height: 1;
    }
    .star-rating { color: var(--icde-gold); font-size: 1rem; }
    .testimoni-avatar {
        width: 52px; height: 52px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--icde-navy-mid), var(--icde-sky));
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.3rem;
        flex-shrink: 0;
    }

    /* ===== CTA ===== */
    .cta-section {
        background: linear-gradient(135deg, var(--icde-navy-dark) 0%, var(--icde-navy) 50%, var(--icde-navy-mid) 100%);
        color: #fff;
        padding: 90px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%; left: -10%;
        width: 600px; height: 600px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(232,169,0,0.08) 0%, transparent 60%);
    }
    .cta-section::after {
        content: '';
        position: absolute;
        bottom: -60%; right: -10%;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(30,144,212,0.1) 0%, transparent 60%);
    }
    .cta-section h2 { font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 2rem; }
    .cta-gold-line {
        width: 60px; height: 3px;
        background: linear-gradient(90deg, var(--icde-gold), var(--icde-gold-light));
        border-radius: 2px;
        margin: 16px auto;
    }

    /* ===== HERO CAROUSEL FIXES ===== */
    #heroCarousel .carousel-inner { min-height: 88vh; }
    #heroCarousel .carousel-item  { min-height: 88vh; }
    #heroCarousel .carousel-indicators button {
        background-color: rgba(255,255,255,0.5);
        border-radius: 3px;
        width: 24px;
        height: 3px;
        transition: all 0.3s;
    }
    #heroCarousel .carousel-indicators button.active {
        background-color: var(--icde-gold);
        opacity: 1;
        width: 36px;
    }
    #heroCarousel .carousel-item > div[style*="position:absolute;inset:0"] { z-index: 1; }
    #heroCarousel .carousel-item > div[style*="position:absolute;top:50%"]  { z-index: 2; }
</style>
@endpush

@section('content')

<!-- HERO SECTION -->
@if($sectionSettings['show_section_slider'] && $sliders->isNotEmpty())
{{-- ===== HERO CAROUSEL ===== --}}
<section style="position:relative;overflow:hidden;">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            @foreach($sliders as $i => $slide)
            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}" style="position:relative;min-height:88vh;">
                {{-- Background --}}
                @if($slide->gambar)
                <img src="{{ asset('storage/'.$slide->gambar) }}" alt="{{ $slide->judul }}"
                     style="width:100%;height:88vh;object-fit:cover;display:block;">
                @else
                <div style="width:100%;height:88vh;background:linear-gradient(135deg,#0f172a 0%,#1B6CA8 50%,#2196a8 100%);"></div>
                @endif
                @unless($slide->hanya_gambar)
                {{-- Overlay --}}
                <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(0,0,0,0.68) 0%,rgba(0,0,0,0.25) 55%,transparent 100%);"></div>
                {{-- Caption --}}
                <div style="position:absolute;top:50%;left:8%;right:40%;transform:translateY(-50%);">
                    @if($slide->subjudul)
                    <div style="display:inline-block;background:rgba(132,204,22,0.18);border:1px solid var(--icde-gold);color:var(--icde-gold);padding:5px 18px;border-radius:20px;font-size:0.78rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;margin-bottom:14px;">
                        <i class="bi bi-award-fill me-1"></i>{{ $slide->subjudul }}
                    </div>
                    @endif
                    <h1 style="font-size:clamp(2rem,4vw,3.5rem);font-weight:900;line-height:1.22;margin-bottom:16px;color:{{ $slide->warna_teks === 'dark' ? '#0f172a' : '#fff' }};">
                        {!! nl2br(e($slide->judul)) !!}
                    </h1>
                    @if($slide->deskripsi)
                    <div style="font-size:1.1rem;font-weight:500;line-height:1.8;max-width:600px;margin-bottom:28px;color:{{ $slide->warna_teks === 'dark' ? '#334155' : 'rgba(255,255,255,0.95)' }};">
                        {!! $slide->deskripsi !!}
                    </div>
                    @endif
                    <div class="d-flex gap-3 flex-wrap">
                        @if($slide->teks_tombol)
                        <a href="{{ $slide->link_tombol ?? '#' }}"
                           style="display:inline-flex;align-items:center;gap:8px;background:var(--icde-gold);color:var(--icde-navy-dark);font-weight:700;padding:14px 34px;border-radius:8px;font-size:0.9rem;text-decoration:none;transition:all .3s;"
                           onmouseover="this.style.background='var(--icde-gold-light)'" onmouseout="this.style.background='var(--icde-gold)'">
                            {{ $slide->teks_tombol }} <i class="bi bi-arrow-right"></i>
                        </a>
                        @endif
                        <a href="{{ route('kontak') }}"
                           style="display:inline-flex;align-items:center;gap:8px;background:transparent;color:#fff;font-weight:600;padding:14px 28px;border-radius:8px;font-size:0.9rem;text-decoration:none;border:1.5px solid rgba(255,255,255,0.5);transition:border-color .2s;"
                           onmouseover="this.style.borderColor='#fff'" onmouseout="this.style.borderColor='rgba(255,255,255,0.5)'">
                            <i class="bi bi-telephone"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
                @endunless
            </div>
            @endforeach
        </div>
        @if($sliders->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" style="width:2.5rem;height:2.5rem;background-color:rgba(0,0,0,0.4);border-radius:50%;background-size:60%;"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" style="width:2.5rem;height:2.5rem;background-color:rgba(0,0,0,0.4);border-radius:50%;background-size:60%;"></span>
        </button>
        <div class="carousel-indicators" style="bottom:24px;margin-bottom:0;">
            @foreach($sliders as $i => $slide)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                    @if($i === 0) class="active" aria-current="true" @endif
                    aria-label="{{ $slide->judul }}"
                    style="width:10px;height:10px;border-radius:50%;"></button>
            @endforeach
        </div>
        @endif
    </div>
</section>
@elseif($sectionSettings['show_section_slider'])
{{-- ===== FALLBACK STATIC HERO (no slider data) ===== --}}
<section class="hero-section">
    <div class="container position-relative z-1">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="hero-badge"><i class="bi bi-award-fill me-1"></i>Konsultan Terpercaya</span>
                <h1>{{ $beranda->judul ?? 'Konsultan Profesional Perencanaan & Evaluasi Pembangunan' }}</h1>
                <p class="hero-desc mt-3">
                    {{ $beranda->deskripsi ?? 'PT. ICDE adalah konsultan profesional di bidang perencanaan, evaluasi pembangunan, penelitian dan kajian berbasis data.' }}
                </p>
                @if($beranda && $beranda->motto)
                <p class="motto mt-3">{{ $beranda->motto }}</p>
                @else
                <p class="motto mt-3">"Mitra Cerdas untuk Pembangunan Berkualitas dan Berkelanjutan"</p>
                @endif
                <div class="d-flex gap-3 mt-4 flex-wrap">
                    <a href="{{ route('layanan') }}" class="btn-icde-secondary">
                        <i class="bi bi-briefcase-fill me-2"></i>Lingkup Layanan
                    </a>
                    <a href="{{ route('kontak') }}" class="btn-outline-icde" style="border-color:rgba(255,255,255,0.5);color:#fff;">
                        <i class="bi bi-telephone me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-flex justify-content-center" data-aos="fade-left">
                <div style="width:420px;height:320px;background:rgba(255,255,255,0.1);border-radius:20px;backdrop-filter:blur(5px);border:1px solid rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-building" style="font-size:6rem;color:rgba(255,255,255,0.25);"></i>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- STATS STRIP -->
@if($sectionSettings['show_section_stats'])
<div class="stats-strip">
    <div class="container">
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <div class="num">{{ $settings['stat_1_num'] ?? '25+' }}</div>
                    <div class="lbl">{{ $settings['stat_1_label'] ?? 'Tahun Berpengalaman' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <div class="num">{{ $settings['stat_2_num'] ?? '500+' }}</div>
                    <div class="lbl">{{ $settings['stat_2_label'] ?? 'Proyek Diselesaikan' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <div class="num">{{ $settings['stat_3_num'] ?? '100+' }}</div>
                    <div class="lbl">{{ $settings['stat_3_label'] ?? 'Klien Pemerintah & Swasta' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-box">
                    <div class="num">{{ $settings['stat_4_num'] ?? '50+' }}</div>
                    <div class="lbl">{{ $settings['stat_4_label'] ?? 'Tenaga Ahli Bersertifikat' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- LAYANAN SECTION -->
@if($sectionSettings['show_section_layanan'])
<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center">{{ $settings['section_layanan_title'] ?? 'Lingkup Layanan' }}</h2>
        </div>
        <div class="row g-4">
            @forelse($layanan->take(3) as $item)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="bi {{ $item->ikon ?? 'bi-clipboard-data' }}"></i>
                    </div>
                    <h5>{{ $item->judul }}</h5>
                    <p>{{ Str::limit(strip_tags(html_entity_decode($item->deskripsi)), 120) }}</p>
                </div>
            </div>
            @empty
            @foreach([
                ['ikon' => 'bi-bar-chart-line', 'judul' => 'Perencanaan Pembangunan', 'deskripsi' => 'Penyusunan dokumen perencanaan pembangunan daerah yang komprehensif dan berbasis data.'],
                ['ikon' => 'bi-search', 'judul' => 'Evaluasi Program', 'deskripsi' => 'Evaluasi pelaksanaan program dan kebijakan pembangunan secara independen dan objektif.'],
                ['ikon' => 'bi-graph-up', 'judul' => 'Penelitian & Kajian', 'deskripsi' => 'Penelitian berbasis data untuk mendukung pengambilan keputusan yang tepat dan terukur.'],
            ] as $idx => $def)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="bi {{ $def['ikon'] }}"></i>
                    </div>
                    <h5>{{ $def['judul'] }}</h5>
                    <p>{{ $def['deskripsi'] }}</p>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('layanan') }}" class="btn-icde-primary">
                <i class="bi bi-arrow-right-circle me-2"></i>Lihat Semua Layanan
            </a>
        </div>
    </div>
</section>
@endif

<!-- WHY CHOOSE US -->
@if($sectionSettings['show_section_why'])
<section class="section section-alt">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="section-title">{{ $settings['section_why_title'] ?? 'Mengapa Memilih PT ICDE?' }}</h2>
                <p class="text-muted mt-3 mb-4">{{ $settings['section_why_subtitle'] ?? 'Kami berkomitmen untuk memberikan solusi terbaik dengan dukungan tim ahli berpengalaman dan metodologi yang terbukti efektif.' }}</p>
                <div class="why-item">
                    <div class="why-icon"><i class="bi bi-award-fill"></i></div>
                    <div>
                        <h6>{{ $settings['section_why_item1_title'] ?? 'Pengalaman 25+ Tahun' }}</h6>
                        <p>{{ $settings['section_why_item1_desc'] ?? 'Lebih dari dua dekade melayani klien pemerintah dan swasta di seluruh Indonesia.' }}</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><i class="bi bi-people-fill"></i></div>
                    <div>
                        <h6>{{ $settings['section_why_item2_title'] ?? 'Tenaga Ahli Bersertifikasi' }}</h6>
                        <p>{{ $settings['section_why_item2_desc'] ?? 'Tim multidisiplin dengan sertifikasi nasional dan internasional yang kompeten di bidangnya.' }}</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <div>
                        <h6>{{ $settings['section_why_item3_title'] ?? 'Berbasis Data & Analitik' }}</h6>
                        <p>{{ $settings['section_why_item3_desc'] ?? 'Setiap rekomendasi didasarkan pada analisis data yang mendalam dan metodologi ilmiah.' }}</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><i class="bi bi-shield-check-fill"></i></div>
                    <div>
                        <h6>{{ $settings['section_why_item4_title'] ?? 'Terpercaya & Independen' }}</h6>
                        <p>{{ $settings['section_why_item4_desc'] ?? 'Menjaga independensi dan integritas dalam setiap penugasan konsultansi.' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="row g-3">
                    <div class="col-6">
                        <div style="background:linear-gradient(135deg,var(--icde-navy),var(--icde-navy-mid));color:#fff;border-radius:18px;padding:30px;text-align:center;box-shadow:0 8px 24px rgba(11,44,95,0.25);">
                            <i class="bi bi-building" style="font-size:2rem;opacity:0.7;"></i>
                            <div style="font-family:'Poppins',sans-serif;font-size:2.1rem;font-weight:900;margin:8px 0;">{{ $settings['stat_1_num'] ?? '25+' }}</div>
                            <div style="font-size:0.82rem;opacity:0.85;">{{ $settings['stat_1_label'] ?? 'Tahun Pengalaman' }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:linear-gradient(135deg,var(--icde-gold-dark),var(--icde-gold));color:var(--icde-navy);border-radius:18px;padding:30px;text-align:center;box-shadow:0 8px 24px rgba(232,169,0,0.3);">
                            <i class="bi bi-file-earmark-text" style="font-size:2rem;opacity:0.7;"></i>
                            <div style="font-family:'Poppins',sans-serif;font-size:2.1rem;font-weight:900;margin:8px 0;">{{ $settings['stat_2_num'] ?? '500+' }}</div>
                            <div style="font-size:0.82rem;font-weight:600;opacity:0.85;">{{ $settings['stat_2_label'] ?? 'Proyek Selesai' }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:var(--icde-light-bg);border-radius:18px;padding:30px;text-align:center;border:2px solid rgba(11,44,95,0.08);">
                            <i class="bi bi-people" style="font-size:2rem;color:var(--icde-navy-mid);opacity:0.8;"></i>
                            <div style="font-family:'Poppins',sans-serif;font-size:2.1rem;font-weight:900;color:var(--icde-navy);margin:8px 0;">{{ $settings['stat_4_num'] ?? '50+' }}</div>
                            <div style="font-size:0.82rem;color:var(--icde-gray);">{{ $settings['stat_4_label'] ?? 'Tenaga Ahli' }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:var(--icde-light-bg);border-radius:18px;padding:30px;text-align:center;border:2px solid rgba(232,169,0,0.2);">
                            <i class="bi bi-hand-thumbs-up" style="font-size:2rem;color:var(--icde-gold);"></i>
                            <div style="font-family:'Poppins',sans-serif;font-size:2.1rem;font-weight:900;color:var(--icde-navy);margin:8px 0;">100%</div>
                            <div style="font-size:0.82rem;color:var(--icde-gray);">Kepuasan Klien</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- PENGALAMAN TERBARU -->
@if($sectionSettings['show_section_pengalaman'] && $pengalaman->count() > 0)
<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center">{{ $settings['section_pengalaman_title'] ?? 'Pengalaman Terbaru' }}</h2>
        </div>
        <div class="row g-3">
            @foreach($pengalaman as $exp)
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="exp-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="mb-0 fw-700" style="font-weight:800;font-size:1.1rem;color:var(--icde-navy-dark);">{{ $exp->nama_proyek }}</h6>
                        <span class="exp-year">{{ $exp->tahun }}</span>
                    </div>
                    <div class="text-muted" style="font-size:0.9rem;font-weight:500;">
                        <i class="bi bi-building me-1"></i>{{ $exp->pemberi_kerja }}
                        @if($exp->lokasi)
                        <span class="mx-1">|</span>
                        <i class="bi bi-geo-alt me-1"></i>{{ $exp->lokasi }}
                        @endif
                    </div>
                    @if($exp->deskripsi)
                    <p class="mt-2 mb-0" style="font-size:0.95rem;font-weight:500;color:#334155;">{{ Str::limit(strip_tags(html_entity_decode($exp->deskripsi)), 120) }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('pengalaman') }}" class="btn-icde-primary">
                <i class="bi bi-arrow-right-circle me-2"></i>Lihat Semua Pengalaman
            </a>
        </div>
    </div>
</section>
@endif

<!-- KLIEN -->
@if($sectionSettings['show_section_klien'] && $klien->count() > 0)
<div class="klien-strip">
    <div class="container mb-4 text-center" data-aos="fade-up">
        <h5 style="font-weight:700;color:var(--icde-dark);">{{ $settings['section_klien_title'] ?? 'Klien & Mitra Kami' }}</h5>
    </div>
    <div style="overflow:hidden;">
        <div class="klien-track">
            @foreach(array_merge($klien->toArray(), $klien->toArray()) as $k)
            <div class="klien-item">
                @if(!empty($k['logo']))
                    <img src="{{ asset('storage/' . $k['logo']) }}" alt="{{ $k['nama'] }}">
                @else
                    {{ $k['nama'] }}
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- TESTIMONI -->
@if($sectionSettings['show_section_testimoni'] && $testimoni->count() > 0)
<section class="section section-alt">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center">{{ $settings['section_testimoni_title'] ?? 'Apa Kata Klien Kami' }}</h2>
        </div>
        <div class="row g-4">
            @foreach($testimoni as $t)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="testimoni-card">
                    <div class="star-rating mb-3">
                        @for($i = 0; $i < $t->bintang; $i++)
                        <i class="bi bi-star-fill"></i>
                        @endfor
                    </div>
                    <div style="font-size:0.9rem;color:#555;line-height:1.8;position:relative;z-index:1;">
                        {!! $t->isi !!}
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <div class="testimoni-avatar">
                            @if($t->foto)
                            <img src="{{ asset('storage/' . $t->foto) }}" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                            @else
                            <i class="bi bi-person-fill"></i>
                            @endif
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:0.9rem;">{{ $t->nama }}</div>
                            @if($t->jabatan)<div style="font-size:0.78rem;color:var(--icde-gray);">{{ $t->jabatan }}</div>@endif
                            @if($t->instansi)<div style="font-size:0.78rem;color:var(--icde-primary);font-weight:600;">{{ $t->instansi }}</div>@endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- GALERI -->
@if(!isset($sectionSettings['show_section_galeri']) || $sectionSettings['show_section_galeri'])
@if($galeri->count() > 0)
<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge"><i class="bi bi-images me-1"></i>{{ $settings['section_galeri_badge'] ?? 'Galeri ICDE' }}</span>
            <h2 class="section-title text-center">{{ $settings['section_galeri_title'] ?? 'Dokumentasi & Kegiatan' }}</h2>
        </div>
        
        <div class="row g-4">
            @foreach($galeri as $item)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div style="border-radius:14px;overflow:hidden;background:#fff;box-shadow:0 4px 20px rgba(0,0,0,0.06);height:100%;">
                    <div style="aspect-ratio:4/3;overflow:hidden;position:relative;">
                        <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->judul }}" style="width:100%;height:100%;object-fit:cover;transition:transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        @if($item->kategori)
                        <span style="position:absolute;top:12px;left:12px;background:rgba(27,108,168,0.9);color:#fff;font-size:0.7rem;font-weight:700;padding:4px 12px;border-radius:20px;text-transform:uppercase;">{{ $item->kategori }}</span>
                        @endif
                    </div>
                    <div style="padding:16px 20px;">
                        <h6 style="font-weight:800;font-size:1.1rem;color:var(--icde-navy-dark);margin-bottom:8px;">{{ Str::limit($item->judul, 60) }}</h6>
                        @if($item->deskripsi)
                        <p style="font-size:0.95rem;font-weight:500;color:#334155;margin:0;">{{ Str::limit(strip_tags(html_entity_decode($item->deskripsi)), 80) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-5 text-center" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('galeri') }}" class="btn-icde-primary">
                Lihat Semua Galeri <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>
@endif
@endif


@endsection

@push('scripts')
<script>
    // Explicit carousel initialization ensures autoplay is always active,
    // even if the user interacted with the page before JS finished loading.
    (function () {
        var el = document.getElementById('heroCarousel');
        if (!el) return;
        var carousel = bootstrap.Carousel.getOrCreateInstance(el, {
            interval: 5000,
            ride: 'carousel',
            wrap: true
        });
        // Restart cycling after any button click (prevents Bootstrap from pausing)
        el.addEventListener('click', function () {
            carousel.cycle();
        });
    })();
</script>
@endpush
