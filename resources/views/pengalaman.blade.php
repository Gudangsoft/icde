@extends('layouts.app')

@section('title', 'Pengalaman - PT ICDE')

@push('styles')
<style>

/* ── Category box grid (main view) ── */
.cat-box-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 44px 0 60px;
}
@media (max-width: 991px) { .cat-box-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 575px) { .cat-box-grid { grid-template-columns: 1fr; } }

.cat-box {
    border-radius: 14px;
    padding: 24px 20px 20px;
    text-align: center;
    color: #fff;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 120px;
    transition: transform .3s, box-shadow .3s, filter .3s;
    position: relative;
    overflow: hidden;
}
.cat-box::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0);
    transition: background .3s;
    border-radius: 14px;
}
.cat-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.25);
    color: #fff;
}
.cat-box:hover::after { background: rgba(255,255,255,0.07); }
.cat-check-wrap {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.22);
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}
.cat-box .cat-name {
    font-size: 1.1rem;
    font-weight: 800;
    line-height: 1.4;
}
.cat-box .cat-count {
    font-size: 0.95rem;
    opacity: 0.95;
    font-weight: 600;
}

/* ── Filtered layout: sidebar + content ── */
.pengalaman-layout {
    display: grid;
    grid-template-columns: 270px 1fr;
    gap: 28px;
    align-items: start;
    padding: 44px 0 60px;
}
@media (max-width: 768px) {
    .pengalaman-layout {
        grid-template-columns: 1fr;
    }
}

/* ── Sidebar ── */
.sidebar-cat {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e8edf5;
    overflow: hidden;
    position: sticky;
    top: 88px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
}
.sidebar-cat-title {
    padding: 14px 20px;
    font-size: 0.85rem;
    font-weight: 800;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    border-bottom: 1px solid #f1f5f9;
    background: #f8fafc;
}
.sidebar-cat-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
    text-decoration: none;
    color: #334155;
    font-size: 0.92rem;
    font-weight: 600;
    border-bottom: 1px solid #f1f5f9;
    transition: all .2s;
    border-left: 3px solid transparent;
}
.sidebar-cat-item:last-child { border-bottom: none; }
.sidebar-cat-item:hover {
    background: #f1f5f9;
    color: var(--icde-primary);
    border-left-color: #c7ddf5;
}
.sidebar-cat-item.active {
    background: #eff6ff;
    color: var(--icde-primary);
    font-weight: 700;
    border-left-color: var(--icde-primary);
}
.sidebar-cat-item .kat-dot {
    font-size: 1rem;
    flex-shrink: 0;
    color: currentColor;
}
.sidebar-back {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    font-size: 0.8rem;
    color: #64748b;
    text-decoration: none;
    border-top: 1px solid #f1f5f9;
    transition: all .2s;
    background: #f8fafc;
}
.sidebar-back:hover { color: var(--icde-primary); background: #eff6ff; }

/* ── Category header in filtered view ── */
.cat-section-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 22px;
    border-radius: 14px;
    color: #fff;
    margin-bottom: 24px;
}
.cat-section-header h2 {
    font-size: 1.1rem;
    font-weight: 800;
    margin: 0;
    color: #fff;
}
.cat-section-header small { color: rgba(255,255,255,0.8); font-size: 0.8rem; }

/* ── Project cards (filtered view) ── */
.proyek-item {
    background: #fff;
    border-radius: 13px;
    border: 1px solid #e8edf5;
    padding: 18px 22px;
    margin-bottom: 14px;
    display: flex;
    gap: 18px;
    align-items: flex-start;
    transition: all .25s;
    position: relative;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
}
.proyek-item::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 4px;
    background: var(--hover-color, var(--icde-primary));
    opacity: 0;
    transition: opacity .25s;
}
.proyek-item:hover {
    box-shadow: 0 6px 24px rgba(27,108,168,0.12);
    border-color: #c7ddf5;
    transform: translateX(4px);
    color: inherit;
}
.proyek-item:hover::before { opacity: 1; }

.year-badge {
    background: var(--badge-bg, var(--icde-primary));
    color: #fff;
    font-weight: 800;
    font-size: 0.82rem;
    border-radius: 10px;
    padding: 7px 14px;
    white-space: nowrap;
    flex-shrink: 0;
    text-align: center;
}
.proyek-item h6 {
    font-size: 1.1rem;
    font-weight: 800;
    color: var(--icde-navy-dark);
    line-height: 1.45;
    margin-bottom: 7px;
}
.proyek-meta {
    font-size: 0.9rem;
    color: #475569;
    font-weight: 500;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}
.proyek-meta span { display: inline-flex; align-items: center; gap: 4px; }

/* ── Pagination ── */
.pagination .page-link { border-radius: 8px !important; margin: 0 2px; font-size:0.83rem; border-color:#e2e8f0; color:var(--icde-primary); }
.pagination .page-item.active .page-link { background:var(--icde-primary); border-color:var(--icde-primary); }
</style>
@endpush

@section('content')
@php $activeKat = request('kategori'); @endphp

<div class="page-header">
    <div class="container">
        <h1 data-aos="fade-right">Pengalaman</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                @if($activeKat)
                <li class="breadcrumb-item"><a href="{{ route('pengalaman') }}">Pengalaman</a></li>
                <li class="breadcrumb-item active">{{ $activeKat }}</li>
                @else
                <li class="breadcrumb-item active">Pengalaman</li>
                @endif
            </ol>
        </nav>
    </div>
</div>

@php
    use App\Models\Pengalaman;

    $katConfig = [
        'Perencanaan Pembangunan'                       => ['icon' => 'bi-building-fill-gear',      'bg' => '#1565C0'],
        'Evaluasi Pembangunan'                          => ['icon' => 'bi-journal-bookmark-fill',   'bg' => '#E65100'],
        'Analisis Pengelolaan Keuangan dan Aset Daerah' => ['icon' => 'bi-graph-up-arrow',          'bg' => '#2E7D32'],
        'Perencanaan Sektoral'                          => ['icon' => 'bi-file-earmark-gear-fill',  'bg' => '#B71C1C'],
        'Penelitian dan Pengkajian'                     => ['icon' => 'bi-search-heart-fill',       'bg' => '#00695C'],
        'Peningkatan Kapasitas SDM Aparatur'            => ['icon' => 'bi-people-fill',             'bg' => '#1A237E'],
    ];

    $countPerKat = Pengalaman::selectRaw('kategori, count(*) as total')
        ->whereNotNull('kategori')
        ->groupBy('kategori')
        ->pluck('total', 'kategori');
@endphp

{{-- ── If NO category: show colored category boxes ── --}}
@if(!$activeKat)
<section style="background:#f8fafc;">
    <div class="container">
        <div class="text-center pt-5 pb-2" data-aos="fade-up">
            <h2 style="font-size:1.5rem; font-weight:800; color:var(--icde-dark);">Pengalaman PT. ICDE</h2>
            <hr style="width:60px; border:2px solid var(--icde-primary); opacity:1; margin:10px auto 0;">
        </div>
        @if($countPerKat->isEmpty())
        <div class="text-center py-5" style="color:#94a3b8;">
            <i class="bi bi-folder2-open" style="font-size:3rem;"></i>
            <p class="mt-3">Belum ada data pengalaman.</p>
        </div>
        @else
        <div class="cat-box-grid">
            @foreach($katConfig as $kat => $cfg)
            @if(($countPerKat[$kat] ?? 0) > 0)
            <a href="{{ route('pengalaman', ['kategori' => $kat]) }}"
               class="cat-box"
               style="background: {{ $cfg['bg'] }};"
               data-aos="fade-up"
               data-aos-delay="{{ ($loop->index % 4) * 80 }}">
                <div class="cat-check-wrap mb-1">
                    <i class="bi bi-check-lg"></i>
                </div>
                <span class="cat-name">{{ $kat }}</span>
                <span class="cat-count">{{ $countPerKat[$kat] }} Proyek</span>
                <span style="font-size: 0.8rem; opacity: 0.85; margin-top: 4px; font-weight: 500;">
                    Selengkapnya <i class="bi bi-arrow-right"></i>
                </span>
            </a>
            @endif
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- ── If category SELECTED: sidebar + project list ── --}}
@else
<section style="background:#f8fafc;">
    <div class="container">
        <div class="pengalaman-layout">

            {{-- Sidebar --}}
            <div data-aos="fade-right">
                <div class="sidebar-cat">
                    <div class="sidebar-cat-title">Bidang Pekerjaan</div>
                    @foreach($katConfig as $kat => $cfg)
                    @if(($countPerKat[$kat] ?? 0) > 0)
                    <a href="{{ route('pengalaman', ['kategori' => $kat]) }}"
                       class="sidebar-cat-item {{ $activeKat == $kat ? 'active' : '' }}">
                        <i class="bi bi-chevron-right kat-dot" style="font-size:0.7rem;"></i>
                        {{ $kat }}
                    </a>
                    @endif
                    @endforeach
                    <a href="{{ route('pengalaman') }}" class="sidebar-back">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        Kembali ke Semua Bidang
                    </a>
                </div>
            </div>

            {{-- Project list --}}
            <div>
                @php
                    $cfg = $katConfig[$activeKat] ?? ['icon' => 'bi-folder-fill', 'bg' => '#1B6CA8'];
                @endphp
                <div class="cat-section-header mb-4" style="background: {{ $cfg['bg'] }};" data-aos="fade-up">
                    <i class="bi {{ $cfg['icon'] }}" style="font-size:1.6rem; flex-shrink:0;"></i>
                    <div>
                        <h2>{{ $activeKat }}</h2>
                        <small>{{ $pengalaman->total() }} proyek ditemukan</small>
                    </div>
                </div>

                @forelse($pengalaman as $idx => $exp)
                <a href="{{ route('pengalaman.detail', $exp->id) }}"
                   class="proyek-item"
                   style="--hover-color: {{ $cfg['bg'] }}; --badge-bg: {{ $cfg['bg'] }};"
                   data-aos="fade-up"
                   data-aos-delay="{{ ($idx % 5) * 50 }}">

                    <div class="year-badge">{{ $exp->tahun }}</div>

                    @if($exp->logo)
                    <img src="{{ asset('storage/' . $exp->logo) }}" alt="Logo"
                         style="width:50px;height:50px;object-fit:contain;border-radius:6px;box-shadow:0 2px 5px rgba(0,0,0,0.05);background:#fff;padding:4px;flex-shrink:0;">
                    @else
                    <div style="width:50px;height:50px;border-radius:6px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#94a3b8;flex-shrink:0;">
                        <i class="bi bi-building"></i>
                    </div>
                    @endif

                    <div class="flex-grow-1">
                        <h6>{{ $exp->nama_proyek }}</h6>
                        <div class="proyek-meta">
                            <span><i class="bi bi-building"></i> {{ $exp->pemberi_kerja }}</span>
                            @if($exp->lokasi)
                            <span><i class="bi bi-geo-alt-fill"></i> {{ $exp->lokasi }}</span>
                            @endif
                            @if($exp->galeri_proyek && count($exp->galeri_proyek) > 0)
                            <span class="ms-2 text-primary" style="font-weight:600;">
                                <i class="bi bi-images"></i> {{ count($exp->galeri_proyek) }} Foto
                            </span>
                            @endif
                        </div>
                        @if($exp->deskripsi)
                        <p class="mt-2 mb-0" style="font-size:0.95rem;color:#334155;line-height:1.55;font-weight:500;">
                            {{ Str::limit(strip_tags(html_entity_decode($exp->deskripsi)), 120) }}
                        </p>
                        @endif
                    </div>

                    <div class="ms-auto align-self-center ps-3">
                        <i class="bi bi-chevron-right text-muted" style="font-size:1.2rem;"></i>
                    </div>
                </a>
                @empty
                <div class="text-center py-5" style="color:#94a3b8;">
                    <i class="bi bi-folder2-open" style="font-size:3rem;"></i>
                    <p class="mt-3">Belum ada data untuk kategori ini.</p>
                </div>
                @endforelse

                @if($pengalaman->hasPages())
                <div class="d-flex justify-content: center mt-4">
                    {{ $pengalaman->appends(request()->query())->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endif

@endsection
