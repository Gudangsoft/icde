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

    /* ── Client Cards ── */
    .klien-card {
        background: #fff;
        border-radius: 14px;
        padding: 22px 16px 18px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
        border: 1.5px solid #f1f5f9;
        text-decoration: none;
        color: var(--icde-dark);
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .klien-card::before {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--icde-gold), var(--icde-gold-light));
        transform: scaleX(0);
        transition: transform 0.3s;
    }
    .klien-card:hover {
        box-shadow: 0 10px 32px rgba(0,0,0,0.10);
        transform: translateY(-5px);
        border-color: var(--icde-gold);
        color: var(--icde-primary);
    }
    .klien-card:hover::before { transform: scaleX(1); }

    .klien-icon-wrap {
        width: 56px; height: 56px;
        border-radius: 14px;
        background: var(--icde-light-bg);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        color: var(--icde-gray-light);
        transition: all 0.3s;
        flex-shrink: 0;
    }
    .klien-card:hover .klien-icon-wrap {
        background: linear-gradient(135deg, var(--icde-navy-mid), var(--icde-navy));
        color: #fff;
    }
    .klien-logo {
        max-height: 55px;
        max-width: 130px;
        object-fit: contain;
        transition: transform 0.3s;
    }
    .klien-card:hover .klien-logo { transform: scale(1.06); }
    .klien-name {
        font-size: 0.83rem;
        font-weight: 700;
        line-height: 1.35;
        color: var(--icde-dark);
        transition: color 0.3s;
    }
    .klien-card:hover .klien-name { color: var(--icde-primary); }
    .klien-count {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--icde-light-bg);
        color: var(--icde-primary);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
        border: 1px solid rgba(18,102,66,0.15);
        transition: all 0.3s;
    }
    .klien-card:hover .klien-count {
        background: var(--icde-primary);
        color: #fff;
        border-color: transparent;
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
    <div class="container">

        @if($klien->isEmpty())
        {{-- Fallback placeholder data --}}
        @php
        $placeholders = [
            'Kementerian Pemberdayaan Perempuan dan Perlindungan Anak',
            'Kabupaten Banyumas', 'Kabupaten Purbalingga', 'Kabupaten Boyolali',
            'Kabupaten Magelang', 'Kabupaten Pati', 'Kabupaten Wonogiri',
            'Kabupaten Kudus', 'Kabupaten Cilacap', 'Kabupaten Demak',
            'Kabupaten Grobogan', 'Kabupaten Kendal', 'Kabupaten Sukoharjo',
            'Kota Semarang', 'Kota Tangerang', 'Provinsi Jawa Tengah',
            'Provinsi DKI Jakarta', 'Kabupaten Karanganyar', 'Kota Surakarta',
            'Kota Salatiga', 'Kota Pekalongan', 'Kota Tegal',
        ];
        @endphp
        <div class="row g-3">
            @foreach($placeholders as $idx => $nama)
            <div class="col-lg-3 col-md-4 col-sm-6 col-6" data-aos="fade-up" data-aos-delay="{{ ($idx % 4) * 50 }}">
                <a href="#" class="klien-card" onclick="event.preventDefault()">
                    <div class="klien-icon-wrap"><i class="bi bi-building"></i></div>
                    <div class="klien-name">{{ $nama }}</div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-3">
            @foreach($klien as $k)
            @php
                // Hitung jumlah proyek: exact match dulu, lalu partial match
                $jumlah = $proyekPerKlien->get($k->nama, 0);
                if ($jumlah == 0) {
                    // cari partial match
                    $jumlah = $proyekPerKlien->filter(function($v, $key) use ($k) {
                        return str_contains(strtolower($key), strtolower($k->nama))
                            || str_contains(strtolower($k->nama), strtolower($key));
                    })->sum();
                }
            @endphp
            <div class="col-lg-3 col-md-4 col-sm-6 col-6"
                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 50 }}">
                <a class="klien-card" href="{{ route('klien.detail', $k->id) }}">
                    @if($k->logo)
                    <img src="{{ asset('storage/' . $k->logo) }}" alt="{{ $k->nama }}" class="klien-logo">
                    @else
                    <div class="klien-icon-wrap"><i class="bi bi-building"></i></div>
                    @endif
                    <div class="klien-name">{{ $k->nama }}</div>
                    @if($jumlah > 0)
                    <span class="klien-count">
                        <i class="bi bi-briefcase-fill" style="font-size:0.65rem;"></i>
                        {{ $jumlah }} proyek
                    </span>
                    @endif
                </a>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</section>

@endsection
