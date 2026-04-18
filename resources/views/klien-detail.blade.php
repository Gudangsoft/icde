@extends('layouts.app')

@section('title', $klien->nama . ' - Klien PT ICDE')

@push('styles')
<style>
/* ── Hero Section ── */
.klien-detail-hero {
    background: linear-gradient(135deg, #0d2c54 0%, #1B6CA8 60%, #1e88e5 100%);
    padding: 56px 0 70px;
    position: relative;
    overflow: hidden;
}
.klien-detail-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.klien-detail-hero-inner {
    position: relative;
    z-index: 1;
}
.klien-detail-logo-box {
    width: 110px;
    height: 110px;
    background: #fff;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
    padding: 10px;
    flex-shrink: 0;
}
.klien-detail-logo-box img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.klien-detail-title {
    font-size: 1.7rem;
    font-weight: 800;
    color: #fff;
    line-height: 1.35;
    margin-bottom: 14px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.2);
}
@media(max-width:768px) { .klien-detail-title { font-size: 1.25rem; } }
.hero-stat-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(255,255,255,0.9);
    color: var(--icde-primary);
    font-size: 0.85rem;
    font-weight: 800;
    padding: 8px 18px;
    border-radius: 24px;
    border: none;
}

/* ── Breadcrumb ── */
.klien-breadcrumb {
    background: #fff;
    border-bottom: 1px solid #e8edf5;
    padding: 12px 0;
    font-size: 0.82rem;
}

/* ── Project Table ── */
.proyek-table-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e8edf5;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    overflow: hidden;
}
.proyek-table-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 24px;
    border-bottom: 1px solid #f1f5f9;
    background: #f8fafc;
    flex-wrap: wrap;
    gap: 10px;
}
.proyek-table-header h3 {
    font-size: 0.85rem;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.proyek-table-header h3 i {
    color: var(--icde-primary);
    font-size: 1rem;
}
.proyek-count-badge {
    background: var(--icde-primary);
    color: #fff;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 20px;
}

.proyek-table {
    width: 100%;
    border-collapse: collapse;
}
.proyek-table thead th {
    background: #f8fafc;
    padding: 12px 16px;
    font-size: 0.72rem;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    border-bottom: 2px solid #e8edf5;
    text-align: left;
    white-space: nowrap;
}
.proyek-table tbody tr {
    transition: all 0.2s;
    cursor: pointer;
}
.proyek-table tbody tr:hover {
    background: #f0f7ff;
}
.proyek-table tbody td {
    padding: 14px 16px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.88rem;
    color: #475569;
    vertical-align: top;
}
.proyek-table tbody tr:last-child td {
    border-bottom: none;
}
.proyek-nama {
    font-weight: 700;
    color: var(--icde-dark);
    line-height: 1.4;
    transition: color 0.2s;
}
.proyek-table tbody tr:hover .proyek-nama {
    color: var(--icde-primary);
}
.proyek-tahun-badge {
    display: inline-flex;
    align-items: center;
    background: var(--icde-primary);
    color: #fff;
    font-size: 0.72rem;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 8px;
    white-space: nowrap;
}
.proyek-lokasi {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 0.82rem;
    color: #94a3b8;
}
.proyek-kategori-badge {
    display: inline-block;
    background: rgba(27,108,168,0.08);
    color: var(--icde-primary);
    font-size: 0.72rem;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 6px;
    white-space: nowrap;
}
.proyek-arrow {
    color: #cbd5e1;
    font-size: 1rem;
    transition: all 0.2s;
}
.proyek-table tbody tr:hover .proyek-arrow {
    color: var(--icde-primary);
    transform: translateX(4px);
}

/* ── Empty State ── */
.empty-state {
    text-align: center;
    padding: 60px 20px;
}
.empty-state-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #f1f5f9;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: #94a3b8;
    margin-bottom: 16px;
}
.empty-state h4 {
    font-weight: 700;
    color: var(--icde-dark);
    margin-bottom: 8px;
}
.empty-state p {
    color: #94a3b8;
    font-size: 0.9rem;
}

/* ── Back button ── */
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-size: 0.83rem;
    font-weight: 600;
    padding: 9px 18px;
    border-radius: 10px;
    text-decoration: none;
    transition: all .2s;
}
.btn-back:hover {
    background: var(--icde-primary);
    border-color: var(--icde-primary);
    color: #fff;
}

/* Responsive */
@media(max-width: 768px) {
    .proyek-table thead { display: none; }
    .proyek-table tbody tr {
        display: block;
        padding: 14px 16px;
        border-bottom: 1px solid #f1f5f9;
    }
    .proyek-table tbody td {
        display: block;
        padding: 3px 0;
        border-bottom: none;
        font-size: 0.85rem;
    }
    .proyek-table tbody td:first-child {
        padding-top: 0;
    }
    .proyek-table tbody td:last-child {
        padding-bottom: 0;
    }
    .td-arrow { display: none !important; }
}
</style>
@endpush

@section('content')

{{-- ── Breadcrumb ── --}}
<div class="klien-breadcrumb">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('klien') }}">Klien</a></li>
            <li class="breadcrumb-item active">{{ $klien->nama }}</li>
        </ol>
    </div>
</div>

{{-- ── Hero Banner ── --}}
<div class="klien-detail-hero">
    <div class="container klien-detail-hero-inner">
        <div class="d-flex flex-column flex-md-row align-items-start gap-4">

            {{-- Logo --}}
            <div class="klien-detail-logo-box" data-aos="zoom-in">
                @if($klien->logo)
                    <img src="{{ asset('storage/' . $klien->logo) }}" alt="{{ $klien->nama }}">
                @else
                    <i class="bi bi-building" style="font-size:3.2rem; color:#cbd5e1;"></i>
                @endif
            </div>

            {{-- Title & stats --}}
            <div data-aos="fade-up">
                <div class="klien-detail-title">{{ $klien->nama }}</div>
                <div>
                    <span class="hero-stat-badge">
                        <i class="bi bi-briefcase-fill"></i>
                        {{ $proyek->count() }} Proyek
                    </span>
                    @if($klien->website)
                    <a href="{{ $klien->website }}" target="_blank" rel="noopener"
                       style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.15);backdrop-filter:blur(4px);border:1px solid rgba(255,255,255,0.25);color:#fff;font-size:0.82rem;font-weight:600;padding:8px 16px;border-radius:24px;text-decoration:none;margin-left:8px;">
                        <i class="bi bi-globe2"></i> Website
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Project List ── --}}
<section style="background:#f8fafc; padding: 44px 0 60px;">
    <div class="container">

        {{-- Back button --}}
        <div class="mb-4" data-aos="fade-up">
            <a href="{{ route('klien') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Klien
            </a>
        </div>

        @if($proyek->count() > 0)
        <div class="proyek-table-card" data-aos="fade-up">
            <div class="proyek-table-header">
                <h3>
                    <i class="bi bi-list-task"></i>
                    Daftar Pekerjaan
                </h3>
                <span class="proyek-count-badge">{{ $proyek->count() }} proyek</span>
            </div>
            <table class="proyek-table">
                <thead>
                    <tr>
                        <th style="width:40px;">No</th>
                        <th>Nama Proyek</th>
                        <th style="width:80px;">Tahun</th>
                        <th>Lokasi</th>
                        <th>Kategori</th>
                        <th style="width:40px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proyek as $idx => $p)
                    <tr onclick="window.location='{{ route('pengalaman.detail', $p->id) }}'">
                        <td style="color:#94a3b8; font-weight:600;">{{ $idx + 1 }}</td>
                        <td>
                            <div class="proyek-nama">{{ $p->nama_proyek }}</div>
                        </td>
                        <td>
                            <span class="proyek-tahun-badge">{{ $p->tahun }}</span>
                        </td>
                        <td>
                            @if($p->lokasi)
                            <span class="proyek-lokasi">
                                <i class="bi bi-geo-alt"></i> {{ $p->lokasi }}
                            </span>
                            @else
                            <span style="color:#cbd5e1;">-</span>
                            @endif
                        </td>
                        <td>
                            @if($p->kategori)
                            <span class="proyek-kategori-badge">{{ $p->kategori }}</span>
                            @else
                            <span style="color:#cbd5e1;">-</span>
                            @endif
                        </td>
                        <td class="td-arrow">
                            <i class="bi bi-chevron-right proyek-arrow"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="proyek-table-card" data-aos="fade-up">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-folder2-open"></i>
                </div>
                <h4>Belum Ada Data Proyek</h4>
                <p>Data pekerjaan untuk klien ini belum tersedia.</p>
            </div>
        </div>
        @endif

    </div>
</section>

@endsection
