@extends('layouts.app')

@section('title', 'Galeri - PT ICDE')

@push('styles')
<style>
    .galeri-item {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .galeri-item img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.4s ease;
        display: block;
    }
    .galeri-item:hover img { transform: scale(1.08); }
    .galeri-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(transparent 40%, rgba(27,108,168,0.85));
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        align-items: flex-end;
        padding: 20px;
    }
    .galeri-item:hover .galeri-overlay { opacity: 1; }
    .galeri-overlay-content { color: #fff; }
    .galeri-overlay-content h6 { font-weight:800; font-size: 1.15rem; margin:0; margin-bottom: 4px; }
    .galeri-overlay-content small { opacity:0.95; font-size: 0.95rem; font-weight: 500; }
    .galeri-placeholder {
        width: 100%;
        height: 220px;
        background: linear-gradient(135deg, rgba(27,108,168,0.1), rgba(27,108,168,0.2));
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--icde-primary);
        gap: 10px;
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1 data-aos="fade-right">Galeri</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Galeri</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center">Galeri Kegiatan</h2>
        </div>

        <!-- Filter Album -->
        @if($albums->count() > 0)
        <div class="d-flex flex-wrap gap-2 mb-5 justify-content-center" data-aos="fade-up">
            <a href="{{ route('galeri') }}" class="filter-btn {{ !request('album') ? 'active' : '' }}">Semua Album</a>
            @foreach($albums as $albumName)
            <a href="{{ route('galeri', ['album' => $albumName]) }}" class="filter-btn {{ request('album') == $albumName ? 'active' : '' }}">{{ $albumName }}</a>
            @endforeach
        </div>
        @endif

        @if($galeri->isEmpty())
        <!-- Default placeholder gallery -->
        <div class="row g-3">
            @foreach([
                ['judul' => 'Workshop Perencanaan Pembangunan', 'kategori' => 'Kegiatan'],
                ['judul' => 'FGD Evaluasi Program Daerah', 'kategori' => 'Kegiatan'],
                ['judul' => 'Survei Lapangan Jawa Tengah', 'kategori' => 'Survei'],
                ['judul' => 'Presentasi Laporan Akhir', 'kategori' => 'Kegiatan'],
                ['judul' => 'Pelatihan Enumerator', 'kategori' => 'Pelatihan'],
                ['judul' => 'Pemetaan Kawasan Industri', 'kategori' => 'Pemetaan'],
                ['judul' => 'Rapat Koordinasi Tim', 'kategori' => 'Kegiatan'],
                ['judul' => 'Kunjungan Lapangan', 'kategori' => 'Survei'],
                ['judul' => 'Seminar Kebijakan Publik', 'kategori' => 'Seminar'],
        ] as $idx => $item)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($idx % 3) * 80 }}">
                <div class="galeri-item">
                    <div class="galeri-placeholder">
                        <i class="bi bi-image" style="font-size:3rem;"></i>
                        <span style="font-size:0.82rem;font-weight:600;">{{ $item['judul'] }}</span>
                    </div>
                    <div class="galeri-overlay">
                        <div class="galeri-overlay-content">
                            <h6>{{ $item['judul'] }}</h6>
                            <small><i class="bi bi-tag me-1"></i>{{ $item['kategori'] }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-3">
            @foreach($galeri as $item)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                <div class="galeri-item" data-bs-toggle="modal" data-bs-target="#galeriModal{{ $item->id }}">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                    <div class="galeri-overlay">
                        <div class="galeri-overlay-content">
                            <h6>{{ $item->judul }}</h6>
                            @if($item->album)<small><i class="bi bi-folder2 me-1"></i>{{ Str::limit($item->album, 30) }}</small>@endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="galeriModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">{{ $item->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-0">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" style="width:100%;max-height:500px;object-fit:contain;">
                        </div>
                        @if($item->deskripsi)
                        <div class="modal-footer">
                            <div class="text-muted w-100" style="font-size:0.95rem;font-weight:500;color:#334155!important;">{!! $item->deskripsi !!}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .filter-btn {
        border: 2px solid var(--icde-primary);
        color: var(--icde-primary);
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.95rem;
        font-weight: 700;
        background: transparent;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    .filter-btn:hover, .filter-btn.active {
        background: var(--icde-primary);
        color: #fff;
    }
</style>
@endpush

@endsection
