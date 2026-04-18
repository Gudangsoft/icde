@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<!-- Stats Grid -->
<div class="row g-3 mb-4">
    @foreach([
        ['label' => 'Lingkup Layanan', 'value' => $stats['layanan'], 'icon' => 'bi-briefcase-fill', 'color' => '#1B6CA8', 'bg' => 'rgba(27,108,168,0.1)', 'route' => 'admin.layanan.index'],
        ['label' => 'Tenaga Ahli (SDM)', 'value' => $stats['sdm'], 'icon' => 'bi-people-fill', 'color' => '#F5A623', 'bg' => 'rgba(245,166,35,0.1)', 'route' => 'admin.sdm.index'],
        ['label' => 'Pengalaman Proyek', 'value' => $stats['pengalaman'], 'icon' => 'bi-folder-fill', 'color' => '#10b981', 'bg' => 'rgba(16,185,129,0.1)', 'route' => 'admin.pengalaman.index'],
        ['label' => 'Total Klien', 'value' => $stats['klien'], 'icon' => 'bi-building-fill', 'color' => '#8b5cf6', 'bg' => 'rgba(139,92,246,0.1)', 'route' => 'admin.klien.index'],
        ['label' => 'Foto Galeri', 'value' => $stats['galeri'], 'icon' => 'bi-images', 'color' => '#ec4899', 'bg' => 'rgba(236,72,153,0.1)', 'route' => 'admin.galeri.index'],
        ['label' => 'Testimoni', 'value' => $stats['testimoni'], 'icon' => 'bi-chat-quote-fill', 'color' => '#14b8a6', 'bg' => 'rgba(20,184,166,0.1)', 'route' => 'admin.testimoni.index'],
        ['label' => 'Total Pesan', 'value' => $stats['pesan'], 'icon' => 'bi-envelope-fill', 'color' => '#f59e0b', 'bg' => 'rgba(245,158,11,0.1)', 'route' => 'admin.kontak.index'],
        ['label' => 'Pesan Belum Dibaca', 'value' => $stats['pesan_baru'], 'icon' => 'bi-bell-fill', 'color' => '#ef4444', 'bg' => 'rgba(239,68,68,0.1)', 'route' => 'admin.kontak.index'],
    ] as $stat)
    <div class="col-6 col-md-3">
        <a href="{{ route($stat['route']) }}" style="text-decoration:none;">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon" style="background:{{ $stat['bg'] }};color:{{ $stat['color'] }};">
                        <i class="bi {{ $stat['icon'] }}"></i>
                    </div>
                    <i class="bi bi-arrow-up-right" style="color:#cbd5e1;font-size:0.85rem;"></i>
                </div>
                <div class="stat-num">{{ $stat['value'] }}</div>
                <div class="stat-label">{{ $stat['label'] }}</div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<!-- Quick Actions + Pesan Terbaru -->
<div class="row g-4">
    <div class="col-lg-5">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h5><i class="bi bi-lightning-fill me-2" style="color:#F5A623;"></i>Aksi Cepat</h5>
            </div>
            <div class="p-4">
                <div class="row g-2">
                    @foreach([
                        ['route' => 'admin.layanan.create', 'label' => 'Tambah Layanan', 'icon' => 'bi-plus-circle', 'color' => '#1B6CA8'],
                        ['route' => 'admin.sdm.create', 'label' => 'Tambah SDM', 'icon' => 'bi-person-plus', 'color' => '#F5A623'],
                        ['route' => 'admin.pengalaman.create', 'label' => 'Tambah Pengalaman', 'icon' => 'bi-folder-plus', 'color' => '#10b981'],
                        ['route' => 'admin.galeri.create', 'label' => 'Upload Foto', 'icon' => 'bi-image', 'color' => '#ec4899'],
                        ['route' => 'admin.klien.create', 'label' => 'Tambah Klien', 'icon' => 'bi-building-add', 'color' => '#8b5cf6'],
                        ['route' => 'admin.testimoni.create', 'label' => 'Tambah Testimoni', 'icon' => 'bi-chat-left-quote', 'color' => '#14b8a6'],
                    ] as $action)
                    <div class="col-6">
                        <a href="{{ route($action['route']) }}" style="display:flex;align-items:center;gap:8px;padding:12px;border-radius:10px;background:#f8fafc;border:1px solid #e2e8f0;text-decoration:none;color:#374151;font-size:0.83rem;font-weight:600;transition:all 0.2s;" onmouseover="this.style.background='#f1f5f9';this.style.borderColor='{{ $action['color'] }}'" onmouseout="this.style.background='#f8fafc';this.style.borderColor='#e2e8f0'">
                            <i class="bi {{ $action['icon'] }}" style="color:{{ $action['color'] }};font-size:1rem;"></i>
                            {{ $action['label'] }}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h5><i class="bi bi-envelope-fill me-2" style="color:#1B6CA8;"></i>Pesan Terbaru</h5>
                <a href="{{ route('admin.kontak.index') }}" style="font-size:0.8rem;color:#1B6CA8;text-decoration:none;font-weight:600;">Lihat Semua <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="admin-card-body">
                @if($pesan_terbaru->isEmpty())
                <div class="text-center py-5" style="color:#94a3b8;">
                    <i class="bi bi-inbox" style="font-size:2.5rem;"></i>
                    <p class="mt-2 mb-0" style="font-size:0.88rem;">Belum ada pesan masuk</p>
                </div>
                @else
                <table class="table-admin table">
                    <thead>
                        <tr>
                            <th>Pengirim</th>
                            <th>Subjek</th>
                            <th>Waktu</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesan_terbaru as $p)
                        <tr>
                            <td>
                                <div style="font-weight:600;font-size:0.85rem;">{{ $p->nama }}</div>
                                <div style="font-size:0.75rem;color:#94a3b8;">{{ $p->email }}</div>
                            </td>
                            <td style="font-size:0.82rem;">
                                {{ $p->subjek ?? 'Tidak ada subjek' }}
                                @if(!$p->sudah_dibaca)
                                <span style="display:inline-block;width:7px;height:7px;border-radius:50%;background:#ef4444;margin-left:5px;vertical-align:middle;"></span>
                                @endif
                            </td>
                            <td style="font-size:0.78rem;color:#94a3b8;white-space:nowrap;">{{ $p->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin.kontak.show', $p) }}" class="btn-sm-admin btn-view">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
