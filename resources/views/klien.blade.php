@extends('layouts.app')

@section('title', 'Klien - PT ICDE')

@push('styles')
<style>
    /* ── Hero banner mini ── */
    .klien-hero {
        background: linear-gradient(135deg, var(--icde-navy-dark) 0%, var(--icde-navy) 60%, var(--icde-navy-mid) 100%);
        padding: 56px 0 60px;
        position: relative;
        overflow: hidden;
    }
    .klien-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .klien-hero-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 10px;
    }
    .klien-hero-sub {
        color: rgba(255,255,255,0.75);
        font-size: 0.95rem;
        max-width: 520px;
    }

    /* ── Stat strip ── */
    .klien-stats {
        background: #fff;
        border-bottom: 1px solid #e8edf5;
        padding: 22px 0;
    }
    .kstat-item {
        text-align: center;
    }
    .kstat-num {
        font-family: 'Poppins', sans-serif;
        font-size: 2rem;
        font-weight: 900;
        color: var(--icde-primary);
        line-height: 1;
    }
    .kstat-lbl {
        font-size: 0.78rem;
        color: #94a3b8;
        font-weight: 600;
        margin-top: 4px;
    }

    /* ── Client Grid 10 Kolom Seamless ── */
    .klien-grid-10 {
        display: grid;
        grid-template-columns: repeat(10, 1fr);
        gap: 16px;
    }
    @media (max-width: 1400px) { .klien-grid-10 { grid-template-columns: repeat(8, 1fr); } }
    @media (max-width: 1200px) { .klien-grid-10 { grid-template-columns: repeat(6, 1fr); } }
    @media (max-width: 991px)  { .klien-grid-10 { grid-template-columns: repeat(4, 1fr); } }
    @media (max-width: 575px)  { .klien-grid-10 { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 400px)  { .klien-grid-10 { grid-template-columns: repeat(2, 1fr); } }

    .klien-seamless {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        text-decoration: none;
        color: var(--icde-dark);
        transition: transform 0.3s;
        padding: 12px 8px;
    }
    .klien-seamless:hover {
        transform: translateY(-5px);
    }
    .klien-logo-seamless {
        max-height: 50px;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s, filter 0.3s;
        filter: grayscale(100%) opacity(80%);
    }
    .klien-seamless:hover .klien-logo-seamless {
        transform: scale(1.1);
        filter: grayscale(0%) opacity(100%);
    }
    .klien-name-seamless {
        font-size: 0.72rem;
        font-weight: 700;
        line-height: 1.3;
        color: var(--icde-navy-dark);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s;
    }
    .klien-seamless:hover .klien-name-seamless {
        color: var(--icde-primary);
    }
    .klien-icon-seamless {
        width: 50px; height: 50px;
        border-radius: 12px;
        background: #f1f5f9;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        color: #94a3b8;
        transition: all 0.3s;
    }
    .klien-seamless:hover .klien-icon-seamless {
        background: var(--icde-primary-light);
        color: var(--icde-primary);
    }
    .klien-selanjutnya {
        font-size: 0.68rem;
        font-weight: 800;
        color: #94a3b8;
        transition: color 0.3s, transform 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }
    .klien-seamless:hover .klien-selanjutnya {
        color: var(--icde-primary);
        transform: translateX(3px);
    }
</style>
@endpush

@section('content')

{{-- ── Section Title ── --}}
<section class="section" style="padding-bottom:0;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center">Klien & Mitra</h2>
        </div>
    </div>
</section>

{{-- ── Client Grid ── --}}
<section class="section" style="background:#f8fafc;">
    <div class="container-fluid px-4 px-lg-5">

        @if($klien->isEmpty())
        {{-- Fallback placeholder data --}}
        @php
        $placeholders = [
            'Kementerian PPPA', 'Bappenas RI', 'Kementerian Desa PDTT', 'Bappeda Jawa Tengah',
            'Kabupaten Banyumas', 'Kabupaten Purbalingga', 'Kabupaten Boyolali', 'Kabupaten Magelang', 
            'Kabupaten Pati', 'Kabupaten Wonogiri',
        ];
        @endphp
        <div class="klien-grid-10">
            @foreach($placeholders as $idx => $nama)
            <a href="#" class="klien-seamless" data-aos="fade-up" data-aos-delay="{{ ($idx % 10) * 40 }}" onclick="event.preventDefault()">
                <div class="klien-icon-seamless"><i class="bi bi-building"></i></div>
                <div class="klien-name-seamless">{{ $nama }}</div>
            </a>
            @endforeach
        </div>
        @else
        <div class="klien-grid-10">
            @foreach($klien as $idx => $k)
            <a class="klien-seamless" href="{{ route('klien.detail', $k->id) }}" data-aos="fade-up" data-aos-delay="{{ ($idx % 10) * 30 }}">
                @if($k->logo)
                <img src="{{ asset('storage/' . $k->logo) }}" alt="{{ $k->nama }}" class="klien-logo-seamless">
                @else
                <div class="klien-icon-seamless"><i class="bi bi-building"></i></div>
                @endif
                <div class="klien-name-seamless">{{ $k->nama }}</div>
                <div class="klien-selanjutnya">Selanjutnya <i class="bi bi-arrow-right"></i></div>
            </a>
            @endforeach
        </div>
        @endif

    </div>
</section>

@endsection
