@extends('admin.layouts.app')
@section('title', 'Kelola Beranda')
@section('page_title', 'Beranda')

@section('content')
@if(session('success') || session('sukses'))
<div class="alert-success-admin mb-4 d-flex align-items-center gap-2">
    <i class="bi bi-check-circle-fill"></i> {{ session('success') ?? session('sukses') }}
</div>
@endif

{{-- Info banner --}}
<div style="background:linear-gradient(135deg,#1B6CA8 0%,#144F7F 100%);border-radius:14px;padding:20px 28px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <div>
        <div style="color:rgba(255,255,255,0.7);font-size:0.78rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;margin-bottom:4px;">
            <i class="bi bi-house-fill me-1"></i>Halaman Beranda
        </div>
        <div style="color:#fff;font-size:1rem;font-weight:700;">Kelola konten yang tampil di halaman utama website</div>
        <div style="color:rgba(255,255,255,0.65);font-size:0.82rem;margin-top:2px;">Hero section, statistik perusahaan, gambar latar, dan tombol CTA</div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('tentang-kami') }}" target="_blank"
           style="background:rgba(255,255,255,0.15);color:#fff;padding:9px 18px;border-radius:8px;font-size:0.83rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:6px;border:1px solid rgba(255,255,255,0.25);">
            <i class="bi bi-box-arrow-up-right"></i>Lihat Website
        </a>
        <a href="{{ route('admin.beranda.edit') }}"
           style="background:#fff;color:#1B6CA8;padding:9px 18px;border-radius:8px;font-size:0.83rem;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
            <i class="bi bi-pencil-fill"></i>Edit Beranda
        </a>
    </div>
</div>

@if($beranda)

{{-- Hero Section Preview --}}
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <div>
            <h5 style="margin:0;"><i class="bi bi-card-heading me-2" style="color:#1B6CA8;"></i>Hero Section</h5>
            <div style="font-size:0.76rem;color:#94a3b8;margin-top:2px;">Teks utama yang muncul paling atas di halaman beranda</div>
        </div>
    </div>
    <div class="p-4">
        {{-- Live Hero Preview --}}
        <div style="border-radius:12px;overflow:hidden;position:relative;background:linear-gradient(135deg,#0f172a,#1B6CA8);min-height:160px;display:flex;align-items:flex-end;padding:28px 32px;margin-bottom:20px;">
            @if($beranda->gambar_hero)
            <img src="{{ asset('storage/'.$beranda->gambar_hero) }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0.35;">
            @endif
            <div style="position:relative;z-index:1;">
                @if($beranda->subjudul_hero)
                <div style="font-size:0.72rem;font-weight:700;color:rgba(255,255,255,0.7);letter-spacing:.08em;text-transform:uppercase;margin-bottom:6px;">
                    {{ $beranda->subjudul_hero }}
                </div>
                @endif
                <div style="font-size:1.4rem;font-weight:800;color:#fff;line-height:1.3;margin-bottom:8px;">
                    {{ $beranda->judul_hero ?: '(Judul belum diisi)' }}
                </div>
                @if($beranda->deskripsi)
                <div style="font-size:0.83rem;color:rgba(255,255,255,0.75);max-width:600px;line-height:1.6;margin-bottom:12px;">
                    {{ Str::limit($beranda->deskripsi, 120) }}
                </div>
                @endif
                @if($beranda->teks_cta)
                <span style="background:#F5A623;color:#fff;font-size:0.78rem;font-weight:700;padding:7px 18px;border-radius:20px;display:inline-block;">
                    {{ $beranda->teks_cta }}
                </span>
                @endif
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <div style="background:#f8fafc;border-radius:10px;padding:14px 18px;border:1px solid #e2e8f0;">
                    <div style="font-size:0.7rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px;">
                        <i class="bi bi-type-h1 me-1"></i>Judul Hero
                    </div>
                    <div style="font-weight:600;color:#1e293b;font-size:0.9rem;">{{ $beranda->judul_hero ?: '—' }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div style="background:#f8fafc;border-radius:10px;padding:14px 18px;border:1px solid #e2e8f0;">
                    <div style="font-size:0.7rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px;">
                        <i class="bi bi-type-h2 me-1"></i>Subjudul Hero
                    </div>
                    <div style="font-weight:600;color:#1e293b;font-size:0.9rem;">{{ $beranda->subjudul_hero ?: '—' }}</div>
                </div>
            </div>
            <div class="col-12">
                <div style="background:#f8fafc;border-radius:10px;padding:14px 18px;border:1px solid #e2e8f0;">
                    <div style="font-size:0.7rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px;">
                        <i class="bi bi-text-paragraph me-1"></i>Deskripsi
                    </div>
                    <div style="color:#374151;font-size:0.87rem;line-height:1.6;">{{ $beranda->deskripsi ?: '—' }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div style="background:#f8fafc;border-radius:10px;padding:14px 18px;border:1px solid #e2e8f0;">
                    <div style="font-size:0.7rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px;">
                        <i class="bi bi-cursor-fill me-1"></i>Teks Tombol CTA
                    </div>
                    <div style="font-weight:600;color:#1e293b;font-size:0.9rem;">{{ $beranda->teks_cta ?: '—' }}</div>
                </div>
            </div>
            @if($beranda->gambar_hero)
            <div class="col-md-6">
                <div style="background:#f8fafc;border-radius:10px;padding:14px 18px;border:1px solid #e2e8f0;">
                    <div style="font-size:0.7rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px;">
                        <i class="bi bi-image me-1"></i>Gambar Hero
                    </div>
                    <img src="{{ asset('storage/'.$beranda->gambar_hero) }}" style="height:60px;border-radius:6px;object-fit:cover;">
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Statistik --}}
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <div>
            <h5 style="margin:0;"><i class="bi bi-bar-chart-fill me-2" style="color:#1B6CA8;"></i>Statistik Perusahaan</h5>
            <div style="font-size:0.76rem;color:#94a3b8;margin-top:2px;">Angka yang ditampilkan di bagian "Mengapa Kami" pada beranda</div>
        </div>
    </div>
    <div class="p-4">
        <div class="row g-3">
            @php
            $stats = [
                ['val' => $beranda->jumlah_proyek,      'label' => 'Proyek Selesai',  'icon' => 'bi-folder-check',    'suffix' => '+', 'color' => '#1B6CA8', 'bg' => '#eff6ff'],
                ['val' => $beranda->jumlah_klien,        'label' => 'Klien Puas',      'icon' => 'bi-people-fill',     'suffix' => '+', 'color' => '#059669', 'bg' => '#f0fdf4'],
                ['val' => $beranda->jumlah_tenaga_ahli,  'label' => 'Tenaga Ahli',     'icon' => 'bi-person-badge-fill','suffix' => '',  'color' => '#d97706', 'bg' => '#fffbeb'],
                ['val' => $beranda->tahun_berdiri,       'label' => 'Tahun Berdiri',   'icon' => 'bi-calendar-check',  'suffix' => '',  'color' => '#7c3aed', 'bg' => '#f5f3ff'],
            ];
            @endphp
            @foreach($stats as $s)
            <div class="col-md-3 col-6">
                <div style="border-radius:12px;padding:20px;border:1.5px solid {{ $s['bg'] }};background:{{ $s['bg'] }};text-align:center;">
                    <div style="width:42px;height:42px;border-radius:10px;background:{{ $s['color'] }};display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                        <i class="bi {{ $s['icon'] }}" style="font-size:1.2rem;color:#fff;"></i>
                    </div>
                    <div style="font-size:1.9rem;font-weight:800;color:{{ $s['color'] }};line-height:1;">
                        {{ $s['val'] ?: '—' }}{{ $s['val'] ? $s['suffix'] : '' }}
                    </div>
                    <div style="font-size:0.76rem;color:#64748b;font-weight:600;margin-top:4px;">{{ $s['label'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
        @if(!$beranda->jumlah_proyek && !$beranda->jumlah_klien)
        <div style="text-align:center;color:#94a3b8;font-size:0.82rem;margin-top:12px;">
            <i class="bi bi-info-circle me-1"></i>Statistik belum diisi. <a href="{{ route('admin.beranda.edit') }}" style="color:#1B6CA8;">Isi sekarang</a>
        </div>
        @endif
    </div>
</div>

@else
{{-- Empty state --}}
<div class="admin-card">
    <div class="p-5 text-center">
        <div style="width:72px;height:72px;background:#f1f5f9;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
            <i class="bi bi-house" style="font-size:2rem;color:#94a3b8;"></i>
        </div>
        <div style="font-weight:700;color:#1e293b;font-size:1rem;margin-bottom:6px;">Data beranda belum diisi</div>
        <div style="color:#94a3b8;font-size:0.85rem;margin-bottom:20px;">Isi konten hero, deskripsi, dan statistik perusahaan yang tampil di halaman utama.</div>
        <a href="{{ route('admin.beranda.edit') }}" class="btn-admin btn-primary-admin">
            <i class="bi bi-pencil-fill me-1"></i>Isi Sekarang
        </a>
    </div>
</div>
@endif
@endsection

