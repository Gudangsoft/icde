@extends('layouts.app')

@section('title', $berita->judul . ' - ' . ($settings['site_name'] ?? 'PT ICDE'))

@push('styles')
<style>
    .berita-detail-header {
        margin-bottom: 30px;
    }
    .berita-detail-header h1 {
        font-size: clamp(1.5rem, 3vw, 2.2rem);
        font-weight: 800;
        color: #1e293b;
        line-height: 1.35;
        margin-bottom: 14px;
    }
    .berita-detail-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        font-size: 0.85rem;
        color: #94a3b8;
    }
    .berita-detail-meta span { display: inline-flex; align-items: center; gap: 5px; }
    .berita-detail-meta .kategori-badge {
        background: rgba(27,108,168,0.1);
        color: #1B6CA8;
        padding: 3px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.78rem;
    }
    .berita-cover {
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }
    .berita-cover img {
        width: 100%;
        max-height: 480px;
        object-fit: cover;
        display: block;
    }
    .berita-content {
        font-size: 1rem;
        line-height: 1.9;
        color: #374151;
    }
    .berita-content p { margin-bottom: 18px; }
    .berita-content img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin: 16px 0;
    }
    .berita-share {
        margin-top: 40px;
        padding-top: 24px;
        border-top: 1.5px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .berita-share span { font-weight: 600; color: #64748b; font-size: 0.9rem; }
    .berita-share a {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1rem;
        text-decoration: none;
        transition: transform 0.2s;
    }
    .berita-share a:hover { transform: scale(1.15); }
    .berita-terkait h4 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 24px;
        font-size: 1.3rem;
    }
    .terkait-card {
        display: flex;
        gap: 14px;
        padding: 14px;
        border-radius: 12px;
        border: 1.5px solid #f1f5f9;
        transition: border-color 0.2s, box-shadow 0.2s;
        text-decoration: none;
        color: inherit;
    }
    .terkait-card:hover {
        border-color: #1B6CA8;
        box-shadow: 0 4px 15px rgba(27,108,168,0.1);
    }
    .terkait-card img {
        width: 90px;
        height: 65px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
    }
    .terkait-card h6 {
        font-size: 0.88rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 4px;
        line-height: 1.4;
    }
    .terkait-card small { color: #94a3b8; font-size: 0.75rem; }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1 data-aos="fade-right">Berita</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('berita') }}">Berita</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($berita->judul, 40) }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="berita-detail-header">
                    <h1>{{ $berita->judul }}</h1>
                    <div class="berita-detail-meta">
                        <span><i class="bi bi-calendar3"></i>{{ $berita->tanggal_publish->format('d F Y') }}</span>
                        @if($berita->penulis)
                        <span><i class="bi bi-person"></i>{{ $berita->penulis }}</span>
                        @endif
                        @if($berita->kategori)
                        <span class="kategori-badge">{{ $berita->kategori }}</span>
                        @endif
                    </div>
                </div>

                @if($berita->gambar)
                <div class="berita-cover">
                    <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}">
                </div>
                @endif

                <div class="berita-content">
                    {!! nl2br(e($berita->konten)) !!}
                </div>

                {{-- Share --}}
                <div class="berita-share">
                    <span>Bagikan:</span>
                    @php $shareUrl = urlencode(url()->current()); $shareTitle = urlencode($berita->judul); @endphp
                    <a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" style="background:#25D366;" title="WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" style="background:#1877F2;" title="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" style="background:#1DA1F2;" title="Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank" style="background:#0A66C2;" title="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
            </div>

            {{-- Sidebar berita terkait --}}
            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
                @if($terkait->isNotEmpty())
                <div class="berita-terkait" style="position:sticky;top:90px;">
                    <h4><i class="bi bi-newspaper me-2" style="color:#1B6CA8;"></i>Berita Terkait</h4>
                    <div class="d-flex flex-column gap-3">
                        @foreach($terkait as $item)
                        <a href="{{ route('berita.detail', $item->slug) }}" class="terkait-card">
                            @if($item->gambar)
                            <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->judul }}">
                            @else
                            <div style="width:90px;height:65px;background:linear-gradient(135deg,#0f172a,#1B6CA8);border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-newspaper" style="color:rgba(255,255,255,0.4);"></i>
                            </div>
                            @endif
                            <div>
                                <h6>{{ Str::limit($item->judul, 55) }}</h6>
                                <small><i class="bi bi-calendar3 me-1"></i>{{ $item->tanggal_publish->format('d M Y') }}</small>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    <a href="{{ route('berita') }}" style="display:inline-flex;align-items:center;gap:6px;color:#1B6CA8;font-weight:600;font-size:0.88rem;text-decoration:none;margin-top:20px;">
                        Lihat Semua Berita <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
