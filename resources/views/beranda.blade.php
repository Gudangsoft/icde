@extends('layouts.app')

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
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(6, 49, 30, 0.15);
        padding: 40px 30px;
        transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
        background: linear-gradient(135deg, var(--icde-primary), var(--icde-navy-dark));
        color: white;
        height: 100%;
        position: relative;
        overflow: hidden;
        text-align: center;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .service-card::before {
        content: '';
        position: absolute;
        top: -30px; right: -20px;
        width: 140px; height: 140px;
        background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, transparent 70%);
        border-radius: 50%;
        z-index: -1;
    }
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(6, 49, 30, 0.3);
    }
    .service-icon-box {
        width: 70px; height: 70px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--icde-gold), var(--icde-gold-light));
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 28px auto;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(132, 204, 22, 0.35);
        transform: rotate(-3deg);
    }
    .service-card:hover .service-icon-box {
        transform: scale(1.1) rotate(0deg);
        box-shadow: 0 10px 30px rgba(132, 204, 22, 0.5);
    }
    .service-card h5 { 
        font-family: 'Poppins', sans-serif; 
        font-weight: 800; 
        font-size: 1.25rem; 
        color: #fff; 
        margin-bottom: 0px; 
        letter-spacing: 0.5px;
        line-height: 1.4;
    }

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
        background: linear-gradient(135deg, var(--icde-primary), var(--icde-navy-dark));
        color: white;
        border-radius: 24px;
        padding: 30px 24px;
        box-shadow: 0 8px 32px rgba(6, 49, 30, 0.15);
        transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
        border: none;
        position: relative;
        overflow: hidden;
        z-index: 1;
        height: 100%;
    }
    .exp-card::after {
        content: '';
        position: absolute;
        top: -20px; right: -20px;
        width: 100px; height: 100px;
        background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, transparent 70%);
        border-radius: 50%;
        z-index: -1;
    }
    .exp-card:hover {
        box-shadow: 0 20px 50px rgba(6, 49, 30, 0.3);
        transform: translateY(-6px);
    }
    .exp-card h6 { font-weight:800; font-size:1.15rem; color: #fff; margin-bottom: 0; }
    .exp-card .text-muted { color: rgba(255,255,255,0.85) !important; }
    .exp-card p { color: rgba(255,255,255,0.9) !important; }
    .exp-year {
        font-size: 0.75rem;
        font-weight: 700;
        color: #fff;
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.25);
        padding: 4px 14px;
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
        display: flex;
        align-items: center;
        justify-content: center;
        height: 72px;
        transition: all 0.3s ease;
    }
    .klien-item:hover {
        transform: scale(1.1);
    }
    .klien-item img { max-height: 45px; max-width: 130px; object-fit: contain; }

    /* ===== TESTIMONI ===== */
    .testimoni-card {
        background: linear-gradient(135deg, var(--icde-primary), var(--icde-navy-dark));
        color: white;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 8px 32px rgba(6, 49, 30, 0.15);
        transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
        border: none;
        position: relative;
        overflow: hidden;
        height: 100%;
        z-index: 1;
    }
    .testimoni-card::after {
        content: '';
        position: absolute;
        bottom: -20px; left: -20px;
        width: 120px; height: 120px;
        background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
        border-radius: 50%;
        z-index: -1;
    }
    .testimoni-card:hover {
        box-shadow: 0 20px 50px rgba(6, 49, 30, 0.3);
        transform: translateY(-8px);
    }
    .testimoni-card::before {
        content: '\201C';
        position: absolute;
        top: 10px; left: 18px;
        font-size: 5rem;
        color: rgba(255,255,255,0.1);
        font-family: Georgia, serif;
        line-height: 1;
        z-index: -1;
    }
    .star-rating { color: var(--icde-gold); font-size: 1rem; }
    .testimoni-avatar {
        width: 52px; height: 52px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        border: 2px solid rgba(255,255,255,0.2);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.3rem;
        flex-shrink: 0;
    }
    .testimoni-text { color: rgba(255,255,255,0.95); font-size: 0.95rem; line-height: 1.8; position: relative; z-index: 1; }
    .testimoni-name { font-weight: 700; font-size: 1rem; color: #fff; margin-bottom: 2px; }
    .testimoni-job { font-size: 0.8rem; color: rgba(255,255,255,0.8); }
    .testimoni-company { font-size: 0.8rem; color: var(--icde-gold-light); font-weight: 600; }

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
@php
    $iconSvgs = [
        'bi-diagram-3-fill' => '<path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1.5h1h3.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1a1.5 1.5 0 0 1 1.5-1.5h-1.5V7.5h-3.5h-1V6A1.5 1.5 0 0 1 10 4.5v-1zM8.5 4.5V3.5h-1v1h1zM11 9.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4.5 10a1.5 1.5 0 0 1-1.5-1.5v-1A1.5 1.5 0 0 1 4.5 6h1A1.5 1.5 0 0 1 7 7.5v1A1.5 1.5 0 0 1 5.5 10h-1zM4 8.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1zM9 13.5a1.5 1.5 0 0 1-1.5-1.5v-1A1.5 1.5 0 0 1 9 9.5h1A1.5 1.5 0 0 1 11.5 11v1A1.5 1.5 0 0 1 10 13.5H9zm.5-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>',
        'bi-clipboard2-check-fill' => '<path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/> <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5Zm6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z"/>',
        'bi-bank2' => '<path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h15a.5.5 0 0 0 .277-.916l-7.5-5zM12.354 5 8 2.097 3.646 5h8.708zM5 14.5a.5.5 0 0 1 .5.5v.474a.5.5 0 0 1-1 0V15a.5.5 0 0 1 .5-.5zM8 14.5a.5.5 0 0 1 .5.5v.474a.5.5 0 0 1-1 0V15a.5.5 0 0 1 .5-.5zM11 14.5a.5.5 0 0 1 .5.5v.474a.5.5 0 0 1-1 0V15a.5.5 0 0 1 .5-.5zM2 14h12v.5a.5.5 0 0 1-1 0V14H3v.5a.5.5 0 0 1-1 0V14zM1 15h14v.5a.5.5 0 0 1-1 0H2a.5.5 0 0 1-1 0V15zM2 6h1.25L3 14H2V6zm11 0h1v8h-1l-.25-8zM9.5 6h.75l.25 8h-1.25l.25-8zM5.75 6h.75l.25 8h-1.25l.25-8z"/>',
        'bi-layers-half' => '<path d="M8.235 1.559a.5.5 0 0 0-.47 0l-7.5 4a.5.5 0 0 0 0 .882L3.188 8 .264 9.559a.5.5 0 0 0 0 .882l7.5 4a.5.5 0 0 0 .47 0l7.5-4a.5.5 0 0 0 0-.882L12.812 8l2.924-1.559a.5.5 0 0 0 0-.882l-7.5-4zM8 9.433 1.562 6 8 2.567 14.438 6 8 9.433z"/>',
        'bi-search' => '<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>',
        'bi-people-fill' => '<path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>',
        'bi-clipboard-data' => '<path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 1 1 2 0v3a1 1 0 1 1-2 0V9z"/> <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/> <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3z"/>',
        
        // Database mappings (Fixing circles in screenshot)
        'bi-cloud-download-fill' => '<path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.5a.5.5 0 0 1 1 0V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0m-.354 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V11h-1v3.293l-2.146-2.147a.5.5 0 0 0-.708.708z"/>',
        'bi-journal-bookmark-fill' => '<path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/> <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/> <path d="M6 1h6v7l-3-2-3 2V1z"/>',
        'bi-graph-up-arrow' => '<path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.707l-5.364 5.364a.5.5 0 0 1-.708 0L5.293 7.929l-3.647 3.646a.5.5 0 1 1-.708-.708l4-4a.5.5 0 0 1 .708 0L8.293 9.071l4.646-4.647H10.5a.5.5 0 0 1-.5-.5Z"/>',
        'bi-file-earmark-gear-fill' => '<path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8 8.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> <path d="M12.933 9.046c.147-.52.147-1.072 0-1.592l-1.424-.475c-.156-.052-.294-.15-.393-.284l-.847-1.129c-.117-.156-.168-.344-.146-.534l.178-1.53c.061-.527-.272-1.002-.743-1.114l-1.424-.316c-.516-.115-1.054-.115-1.57 0L5.14 2.391c-.47.112-.804.587-.743 1.114l.178 1.53c.022.19-.029.378-.146.534l-.847 1.129a.628.628 0 0 1-.393.284l-1.424.475c-.496.165-.824.636-.782 1.156l.115 1.442a1.012 1.012 0 0 0 .11 1.592l1.24 1.115c.137.123.238.283.288.46l.475 1.636c.165.568.746.903 1.285.743l1.442-.433a1.006 1.006 0 0 0 1.57-.146l1.21-1.614a.63.63 0 0 1 .46-.22l1.635.178c.527.057 1.002-.272 1.114-.743l.433-1.442a1.012 1.012 0 0 0-.11-1.592l-1.24-1.115zM8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/>',
        'bi-search-heart-fill' => '<path d="M6.5 13a5.5 5.5 0 1 1 4.546-2.392L14.154 15a1 1 0 0 1-1.414 1.414l-3.21-3.21A5.5 5.5 0 0 1 6.5 13zM6.5 4a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7zM2.5 5.5a4 4 0 0 1 7.07-2.61l.66.66-.66.66a4 4 0 0 1-7.07 1.29z"/>',

        // Common fallbacks
        'bi-box-seam' => '<path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.722V6.838L1 4.24v7.922l6.5 2.6zM2.847 3.5l2.454.982L8 5.438l2.699-1.08L13.153 3.5 8 1.439 2.847 3.5z"/>',
    ];
    $fallbackIcon = '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>';
@endphp
<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center">{{ $settings['section_layanan_title'] ?? 'Lingkup Layanan' }}</h2>
        </div>
        <div class="row g-4">
            @forelse($layanan as $item)
            @php
                $currentIcon = $item->ikon ?? 'bi-clipboard-data';
                if(!str_contains($currentIcon, 'bi-')) $currentIcon = 'bi-'.$currentIcon;
            @endphp
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="service-card">
                    <div class="service-icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 16 16" fill="var(--icde-navy-dark)" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
                            {!! $iconSvgs[$currentIcon] ?? $fallbackIcon !!}
                        </svg>
                    </div>
                    <h5>{{ $item->judul }}</h5>
                    @if($item->deskripsi)
                    <p class="mb-0 mt-3" style="font-size:0.9rem;opacity:0.9;">{{ Str::limit(strip_tags(html_entity_decode($item->deskripsi)), 120) }}</p>
                    @endif
                </div>
            </div>
            @empty
            @foreach([
                ['ikon' => 'bi-diagram-3-fill', 'judul' => 'Perencanaan Pembangunan'],
                ['ikon' => 'bi-clipboard2-check-fill', 'judul' => 'Evaluasi Pembangunan'],
                ['ikon' => 'bi-bank2', 'judul' => 'Analisis Keuangan'],
                ['ikon' => 'bi-layers-half', 'judul' => 'Perencanaan Sektoral'],
                ['ikon' => 'bi-search', 'judul' => 'Penelitian & Kajian'],
                ['ikon' => 'bi-people-fill', 'judul' => 'Peningkatan Kapasitas SDM'],
            ] as $idx => $def)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                <div class="service-card">
                    <div class="service-icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 16 16" fill="var(--icde-navy-dark)" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
                            {!! $iconSvgs[$def['ikon']] ?? $fallbackIcon !!}
                        </svg>
                    </div>
                    <h5>{{ $def['judul'] }}</h5>
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
                        <h6 class="mb-0 fw-700">{{ $exp->nama_proyek }}</h6>
                        <span class="exp-year">{{ $exp->tahun }}</span>
                    </div>
                    <div class="text-muted mb-2">
                        <i class="bi bi-building me-1"></i>{{ $exp->pemberi_kerja }}
                        @if($exp->lokasi)
                        <span class="mx-1">|</span>
                        <i class="bi bi-geo-alt me-1"></i>{{ $exp->lokasi }}
                        @endif
                    </div>
                    {{-- Deskripsi dihapus sesuai permintaan --}}
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
        <h2 class="section-title text-center">{{ $settings['section_klien_title'] ?? 'Klien & Mitra' }}</h2>
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
                    <div class="testimoni-text">
                        {!! $t->isi !!}
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="testimoni-avatar">
                            @if($t->foto)
                            <img src="{{ asset('storage/' . $t->foto) }}" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                            @else
                            <i class="bi bi-person-fill"></i>
                            @endif
                        </div>
                        <div>
                            <div class="testimoni-name">{{ $t->nama }}</div>
                            @if($t->jabatan)<div class="testimoni-job">{{ $t->jabatan }}</div>@endif
                            @if($t->instansi)<div class="testimoni-company">{{ $t->instansi }}</div>@endif
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
            <h2 class="section-title text-center">{{ $settings['section_galeri_title'] ?? 'Dokumentasi Kegiatan' }}</h2>
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
