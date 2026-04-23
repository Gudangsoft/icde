@extends('admin.layouts.app')
@section('title', 'Kelola Berita')
@section('page_title', 'Berita / News')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif


    <div class="admin-card mb-4" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.setting.update_title') }}" method="POST" class="d-flex align-items-center gap-3 flex-wrap">
                @csrf
                <div class="d-flex align-items-center" style="flex: 1; min-width:300px;">
                    <label class="mb-0 fw-bold me-3" style="white-space: nowrap; color:#374151; font-size:0.9rem;"><i class="bi bi-pencil-square me-2 text-primary"></i>Ubah Judul Halaman di Website:</label>
                    <input type="hidden" name="key" value="page_berita_title">
                    <input type="text" name="value" class="form-control-admin mb-0" 
                           value="{{ \App\Models\Setting::get('page_berita_title', 'Berita & Artikel') }}" 
                           placeholder="Contoh: Berita & Artikel" required style="flex:1; border-radius:8px; padding:10px 15px;">
                </div>
                <button type="submit" class="btn-admin btn-primary-admin" style="padding: 10px 24px; border-radius:8px;">
                    <i class="bi bi-save-fill me-2"></i>Simpan
                </button>
            </form>
        </div>
    </div>

<form id="bulkDeleteForm" action="{{ route('admin.berita.bulk-destroy') }}" method="POST">
    @csrf
<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-newspaper me-2" style="color:#1B6CA8;"></i>Daftar Berita ({{ $berita->total() }})</h5>
        <a href="{{ route('admin.berita.create') }}" class="btn-admin btn-primary-admin">
            <i class="bi bi-plus-circle-fill me-1"></i>Tambah Berita
        </a>
    </div>

    @if($berita->isEmpty())
    <div class="admin-card-body p-5 text-center">
        <i class="bi bi-newspaper" style="font-size:3rem;color:#e2e8f0;"></i>
        <p class="mt-3 mb-1" style="font-weight:600;color:#374151;">Belum ada berita</p>
        <p style="color:#94a3b8;font-size:0.87rem;">Tambahkan berita pertama untuk ditampilkan di website.</p>
        <a href="{{ route('admin.berita.create') }}" class="btn-admin btn-primary-admin mt-2">
            <i class="bi bi-plus-circle-fill me-1"></i>Tambah Berita Pertama
        </a>
    </div>
    @else

    <div style="padding:24px;">
        <div class="row g-3">
            @foreach($berita as $item)
            <div class="col-md-6 col-lg-4">
                <div style="border-radius:14px;border:1.5px solid {{ $item->aktif ? '#e2e8f0' : '#fecaca' }};overflow:hidden;background:#fff;transition:all 0.2s;height:100%;display:flex;flex-direction:column;">

                    {{-- Gambar --}}
                    <div style="position:relative;aspect-ratio:16/9;background:linear-gradient(135deg,#0f172a,#1B6CA8);overflow:hidden;flex-shrink:0;">
                        @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->judul }}"
                             style="width:100%;height:100%;object-fit:cover;">
                        @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-newspaper" style="font-size:2.5rem;color:rgba(255,255,255,0.3);"></i>
                        </div>
                        @endif
                        {{-- Kategori badge --}}
                        @if($item->kategori)
                        <div style="position:absolute;top:10px;left:10px;background:rgba(27,108,168,0.9);color:#fff;font-size:0.68rem;font-weight:700;padding:3px 10px;border-radius:20px;">
                            {{ $item->kategori }}
                        </div>
                        @endif
                        {{-- Status badge --}}
                        <div style="position:absolute;top:10px;right:10px;">
                            @if(!$item->aktif)
                            <span style="background:#ef4444;color:#fff;font-size:0.65rem;font-weight:700;padding:2px 8px;border-radius:12px;">DRAFT</span>
                            @endif
                        </div>
                    </div>

                    {{-- Info --}}
                    <div style="padding:14px 16px;flex:1;display:flex;flex-direction:column;">
                        <div style="font-size:0.72rem;color:#94a3b8;margin-bottom:6px;display:flex;align-items:center;gap:8px;">
                            <span><i class="bi bi-calendar3 me-1"></i>{{ $item->tanggal_publish->format('d M Y') }}</span>
                            @if($item->penulis)
                            <span><i class="bi bi-person me-1"></i>{{ $item->penulis }}</span>
                            @endif
                        </div>
                        <h6 style="font-size:0.92rem;font-weight:700;color:#1e293b;margin-bottom:6px;line-height:1.4;">
                            {{ Str::limit($item->judul, 70) }}
                        </h6>
                        @if($item->ringkasan)
                        <p style="font-size:0.78rem;color:#64748b;margin:0 0 auto;line-height:1.5;">{{ Str::limit($item->ringkasan, 100) }}</p>
                        @endif

                        {{-- Actions --}}
                        <div style="display:flex;gap:6px;flex-wrap:wrap;align-items:center;margin-top:12px;padding-top:10px;border-top:1px solid #f1f5f9;">
                            <a href="{{ route('admin.berita.edit', $item) }}" class="btn-sm-admin btn-edit">
                                <i class="bi bi-pencil-fill me-1"></i>Edit
                            </a>
                            <a href="{{ route('berita.detail', $item->slug) }}" target="_blank" class="btn-sm-admin" style="background:rgba(16,185,129,0.1);color:#10b981;">
                                <i class="bi bi-eye me-1"></i>Lihat
                            </a>
                            <form action="{{ route('admin.berita.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')" style="display:inline;margin-left:auto;">
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

        {{-- Pagination --}}
        @if($berita->hasPages())
        <div class="mt-4">
            {{ $berita->links() }}
        </div>
        @endif
    </div>
    @endif
</div>
@endsection

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('checkAll');
    const checkItems = document.querySelectorAll('.checkItem');
    const btnBulkDelete = document.getElementById('btnBulkDelete');

    if(checkAll && checkItems.length > 0) {
        checkAll.addEventListener('change', function() {
            checkItems.forEach(item => item.checked = this.checked);
            toggleBulkDeleteBtn();
        });

        checkItems.forEach(item => {
            item.addEventListener('change', toggleBulkDeleteBtn);
        });
    }

    function toggleBulkDeleteBtn() {
        const anyChecked = Array.from(checkItems).some(item => item.checked);
        if(btnBulkDelete) btnBulkDelete.style.display = anyChecked ? 'inline-block' : 'none';
        
        if (checkAll) {
            const allChecked = Array.from(checkItems).every(item => item.checked);
            checkAll.checked = allChecked && checkItems.length > 0;
        }
    }
});

function confirmBulkDelete() {
    if(confirm('Hapus semua data terpilih?')) {
        document.getElementById('bulkDeleteForm').submit();
    }
}
</script>

@endpush
