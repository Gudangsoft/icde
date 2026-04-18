@extends('layouts.app')

@section('title', 'Berita - ' . ($settings['site_name'] ?? 'PT ICDE'))

@push('styles')
<style>
    .berita-card {
        border-radius: 14px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .berita-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 35px rgba(27,108,168,0.15);
    }
    .berita-card-img {
        aspect-ratio: 16/9;
        overflow: hidden;
        position: relative;
    }
    .berita-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .berita-card:hover .berita-card-img img { transform: scale(1.06); }
    .berita-card-img .berita-kategori {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(27,108,168,0.9);
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .berita-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .berita-meta {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .berita-card-body h5 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
        line-height: 1.4;
    }
    .berita-card-body h5 a {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s;
    }
    .berita-card-body h5 a:hover { color: #1B6CA8; }
    .berita-card-body p {
        font-size: 0.87rem;
        color: #64748b;
        line-height: 1.7;
        margin-bottom: 0;
        flex: 1;
    }
    .berita-read-more {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #1B6CA8;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        margin-top: 14px;
        transition: gap 0.2s;
    }
    .berita-read-more:hover { gap: 10px; color: #155a8a; }
    .search-form {
        display: flex;
        gap: 10px;
        max-width: 420px;
    }
    .search-form input {
        flex: 1;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 0.9rem;
        outline: none;
        transition: border-color 0.2s;
    }
    .search-form input:focus { border-color: #1B6CA8; }
    .search-form button {
        background: #1B6CA8;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 0.87rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .search-form button:hover { background: #155a8a; }
    .filter-badges { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 30px; }
    .filter-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        border: 1.5px solid #e2e8f0;
        color: #64748b;
        transition: all 0.2s;
    }
    .filter-badge:hover, .filter-badge.active {
        background: #1B6CA8;
        color: #fff;
        border-color: #1B6CA8;
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1 data-aos="fade-right">Berita</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Berita</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">

        {{-- Search + Filter --}}
        <div class="row mb-4 align-items-center" data-aos="fade-up">
            <div class="col-md-6 mb-3 mb-md-0">
                <form class="search-form" method="GET" action="{{ route('berita') }}">
                    @if(request('kategori'))<input type="hidden" name="kategori" value="{{ request('kategori') }}">@endif
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari berita...">
                    <button type="submit"><i class="bi bi-search me-1"></i>Cari</button>
                </form>
            </div>
            <div class="col-md-6">
                @if($kategori->isNotEmpty())
                <div class="filter-badges justify-content-md-end">
                    <a href="{{ route('berita') }}" class="filter-badge {{ !request('kategori') ? 'active' : '' }}">Semua</a>
                    @foreach($kategori as $kat)
                    <a href="{{ route('berita', ['kategori' => $kat]) }}" class="filter-badge {{ request('kategori') === $kat ? 'active' : '' }}">{{ $kat }}</a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        @if($berita->isEmpty())
        <div class="text-center py-5" data-aos="fade-up">
            <i class="bi bi-newspaper" style="font-size:3.5rem;color:#cbd5e1;"></i>
            <p class="mt-3" style="color:#94a3b8;font-size:1rem;">Belum ada berita{{ request('cari') ? ' untuk pencarian "'.request('cari').'"' : '' }}.</p>
        </div>
        @else
        <div class="row g-4">
            @foreach($berita as $item)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 100 }}">
                <div class="berita-card">
                    <div class="berita-card-img">
                        @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->judul }}">
                        @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#0f172a,#1B6CA8);display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-newspaper" style="font-size:2.5rem;color:rgba(255,255,255,0.3);"></i>
                        </div>
                        @endif
                        @if($item->kategori)
                        <span class="berita-kategori">{{ $item->kategori }}</span>
                        @endif
                    </div>
                    <div class="berita-card-body">
                        <div class="berita-meta">
                            <span><i class="bi bi-calendar3 me-1"></i>{{ $item->tanggal_publish->format('d M Y') }}</span>
                            @if($item->penulis)
                            <span><i class="bi bi-person me-1"></i>{{ $item->penulis }}</span>
                            @endif
                        </div>
                        <h5><a href="{{ route('berita.detail', $item->slug) }}">{{ $item->judul }}</a></h5>
                        @if($item->ringkasan)
                        <p>{{ Str::limit($item->ringkasan, 120) }}</p>
                        @endif
                        <a href="{{ route('berita.detail', $item->slug) }}" class="berita-read-more">
                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($berita->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $berita->appends(request()->query())->links() }}
        </div>
        @endif
        @endif
    </div>
</section>
@endsection
