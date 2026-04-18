@extends('admin.layouts.app')
@section('title', 'Kelola Slider')
@section('page_title', 'Slider / Banner')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-images me-2" style="color:#1B6CA8;"></i>Daftar Slide ({{ $sliders->count() }})</h5>
        <a href="{{ route('admin.slider.create') }}" class="btn-admin btn-primary-admin">
            <i class="bi bi-plus-circle-fill me-1"></i>Tambah Slide
        </a>
    </div>

    @if($sliders->isEmpty())
    <div class="admin-card-body p-5 text-center">
        <i class="bi bi-image" style="font-size:3rem;color:#e2e8f0;"></i>
        <p class="mt-3 mb-1" style="font-weight:600;color:#374151;">Belum ada slide</p>
        <p style="color:#94a3b8;font-size:0.87rem;">Tambahkan slide pertama untuk menampilkan banner di halaman beranda.</p>
        <a href="{{ route('admin.slider.create') }}" class="btn-admin btn-primary-admin mt-2">
            <i class="bi bi-plus-circle-fill me-1"></i>Tambah Slide Pertama
        </a>
    </div>
    @else

    {{-- Card Grid Preview --}}
    <div style="padding:24px;">
        <div class="row g-3">
            @foreach($sliders as $item)
            <div class="col-md-6 col-lg-4">
                <div style="border-radius:14px;border:2px solid {{ $item->aktif ? '#1B6CA8' : '#e2e8f0' }};overflow:hidden;background:#fff;transition:all 0.2s;" class="h-100">

                    {{-- Gambar Preview --}}
                    <div style="position:relative;aspect-ratio:16/7;background:linear-gradient(135deg,#0f172a,#1B6CA8);overflow:hidden;">
                        @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}"
                             style="width:100%;height:100%;object-fit:cover;opacity:0.7;">
                        @endif
                        {{-- Overlay teks --}}
                        <div style="position:absolute;inset:0;display:flex;flex-direction:column;justify-content:flex-end;padding:16px;background:linear-gradient(to top,rgba(0,0,0,0.7) 0%,transparent 60%);">
                            <div style="color:#fff;font-weight:700;font-size:0.9rem;line-height:1.3;">{{ $item->judul }}</div>
                            @if($item->subjudul)
                            <div style="color:rgba(255,255,255,0.75);font-size:0.75rem;margin-top:3px;">{{ $item->subjudul }}</div>
                            @endif
                        </div>
                        {{-- Urutan badge --}}
                        <div style="position:absolute;top:10px;left:10px;background:rgba(0,0,0,0.55);color:#fff;font-size:0.72rem;font-weight:700;padding:3px 10px;border-radius:20px;">
                            #{{ $item->urutan }}
                        </div>
                        @if($item->hanya_gambar)
                        <div style="position:absolute;bottom:10px;right:10px;background:rgba(27,108,168,0.85);color:#fff;font-size:0.65rem;font-weight:700;padding:2px 8px;border-radius:12px;">
                            <i class="bi bi-image-fill me-1"></i>Hanya Gambar
                        </div>
                        @endif
                        {{-- Status badge --}}
                        <div style="position:absolute;top:10px;right:10px;">
                            @if($item->aktif)
                            <span style="background:#10b981;color:#fff;font-size:0.68rem;font-weight:700;padding:3px 9px;border-radius:20px;">AKTIF</span>
                            @else
                            <span style="background:#94a3b8;color:#fff;font-size:0.68rem;font-weight:700;padding:3px 9px;border-radius:20px;">NONAKTIF</span>
                            @endif
                        </div>
                    </div>

                    {{-- Info --}}
                    <div style="padding:14px 16px;">
                        @if($item->deskripsi)
                        <p style="font-size:0.78rem;color:#64748b;margin:0 0 10px;line-height:1.5;">{{ Str::limit($item->deskripsi, 80) }}</p>
                        @endif
                        @if($item->teks_tombol)
                        <div style="font-size:0.75rem;color:#94a3b8;margin-bottom:10px;">
                            <i class="bi bi-link-45deg me-1"></i>Tombol: <strong style="color:#1B6CA8;">{{ $item->teks_tombol }}</strong>
                            @if($item->link_tombol)→ <code style="font-size:0.7rem;">{{ $item->link_tombol }}</code>@endif
                        </div>
                        @endif

                        {{-- Actions --}}
                        <div style="display:flex;gap:6px;flex-wrap:wrap;align-items:center;">
                            <a href="{{ route('admin.slider.edit', $item) }}" class="btn-sm-admin btn-edit">
                                <i class="bi bi-pencil-fill me-1"></i>Edit
                            </a>
                            <form action="{{ route('admin.slider.toggle', $item) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-sm-admin" style="background:{{ $item->aktif ? 'rgba(245,158,11,0.12)' : 'rgba(16,185,129,0.12)' }};color:{{ $item->aktif ? '#d97706' : '#10b981' }};" title="{{ $item->aktif ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <i class="bi {{ $item->aktif ? 'bi-eye-slash' : 'bi-eye' }} me-1"></i>{{ $item->aktif ? 'Nonaktif' : 'Aktifkan' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.slider.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus slide ini?')" style="display:inline;margin-left:auto;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm-admin btn-delete">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Tips --}}
    <div style="margin:0 24px 24px;background:#eff6ff;border-radius:10px;padding:14px 18px;border:1px solid #bfdbfe;font-size:0.8rem;color:#1e40af;">
        <i class="bi bi-info-circle-fill me-2"></i>
        Slide ditampilkan secara berurutan sesuai nomor <strong>Urutan</strong>. Hanya slide berstatus <strong>Aktif</strong> yang muncul di halaman beranda.
    </div>
    @endif
</div>
@endsection
