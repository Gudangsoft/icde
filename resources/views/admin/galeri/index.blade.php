@extends('admin.layouts.app')
@section('title', 'Kelola Galeri')
@section('page_title', 'Galeri')

@section('content')
@if(session('sukses'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('sukses') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

    <div class="admin-card mb-4" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.setting.update_title') }}" method="POST" class="d-flex align-items-center gap-3 flex-wrap">
                @csrf
                <div class="d-flex align-items-center" style="flex: 1; min-width:300px;">
                    <label class="mb-0 fw-bold me-3" style="white-space: nowrap; color:#374151; font-size:0.9rem;"><i class="bi bi-pencil-square me-2 text-primary"></i>Ubah Judul Halaman di Website:</label>
                    <input type="hidden" name="key" value="page_galeri_title">
                    <input type="text" name="value" class="form-control-admin mb-0" 
                           value="{{ \App\Models\Setting::get('page_galeri_title', 'Galeri Kegiatan') }}" 
                           placeholder="Contoh: Galeri Kegiatan" required style="flex:1; border-radius:8px; padding:10px 15px;">
                </div>
                <button type="submit" class="btn-admin btn-primary-admin" style="padding: 10px 24px; border-radius:8px;">
                    <i class="bi bi-save-fill me-2"></i>Simpan
                </button>
            </form>
        </div>
    </div>


<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-image-fill me-2"></i>Daftar Galeri</h5>
        <div class="d-flex gap-2 flex-wrap">
            <button type="button" class="btn-admin btn-danger" id="btnBulkDelete" style="display:none;background:#dc2626;color:white;border:none;" onclick="confirmBulkDelete()">
                <i class="bi bi-trash-fill me-1"></i>Hapus Terpilih
            </button>
            <a href="{{ route('admin.galeri.create') }}" class="btn-admin btn-primary-admin">
                <i class="bi bi-plus-circle-fill me-1"></i>Tambah Galeri
            </a>
        </div>
    </div>
    </div>
    <div class="admin-card-body">

        {{-- Album Filter Tabs --}}
        @if($albums->count() > 0)
        <div class="d-flex flex-wrap gap-2 mb-4 pb-3" style="border-bottom:1px solid #f1f5f9;">
            <a href="{{ route('admin.galeri.index') }}" 
               class="badge rounded-pill text-decoration-none px-3 py-2 {{ !$albumFilter ? 'text-white' : 'text-dark' }}" 
               style="font-size:0.8rem; font-weight:600; {{ !$albumFilter ? 'background:var(--icde-primary);' : 'background:#f1f5f9;' }}">
                <i class="bi bi-grid-fill me-1"></i>Semua ({{ \App\Models\Galeri::count() }})
            </a>
            @foreach($albums as $album)
            @php $count = \App\Models\Galeri::where('album', $album)->count(); @endphp
            <a href="{{ route('admin.galeri.index', ['album' => $album]) }}" 
               class="badge rounded-pill text-decoration-none px-3 py-2 {{ $albumFilter == $album ? 'text-white' : 'text-dark' }}" 
               style="font-size:0.8rem; font-weight:600; {{ $albumFilter == $album ? 'background:var(--icde-primary);' : 'background:#f1f5f9;' }}">
                <i class="bi bi-folder2 me-1"></i>{{ Str::limit($album, 30) }} ({{ $count }})
            </a>
            @endforeach
        </div>
        @endif

        @if($galeri->isEmpty())
        <div class="text-center py-5" style="color:#94a3b8;">
            <i class="bi bi-images" style="font-size:3rem;"></i>
            <p class="mt-2">{{ $albumFilter ? 'Tidak ada foto di album ini' : 'Belum ada foto di galeri' }}</p>
        </div>
        @else

        {{-- Group by album --}}
        @php $grouped = $galeri->groupBy(fn($item) => $item->album ?: 'Tanpa Album'); @endphp

        @foreach($grouped as $albumName => $items)
        <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-folder2-open" style="color:var(--icde-primary); font-size:1.1rem;"></i>
                <h6 class="mb-0 fw-bold" style="color:#374151;">{{ $albumName }}</h6>
                <span class="badge rounded-pill" style="background:#f1f5f9; color:#64748b; font-size:0.72rem;">{{ $items->count() }} foto</span>
            </div>
            <div class="row g-3">
                @foreach($items as $item)
                <div class="col-6 col-md-3 col-lg-2">
                    <div style="border-radius:12px;overflow:hidden;border:1px solid #e2e8f0;position:relative;background:#f8fafc;">
                        <input type="checkbox" name="ids[]" class="checkItem" value="{{ $item->id }}" style="position:absolute;top:5px;left:5px;z-index:10;width:18px;height:18px;cursor:pointer;">
                        @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}" style="width:100%;height:140px;object-fit:cover;">
                        @else
                        <div style="height:140px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-image" style="font-size:2rem;color:#cbd5e1;"></i>
                        </div>
                        @endif
                        <div style="padding:8px 10px;">
                            <div style="font-size:0.78rem;font-weight:600;color:#374151;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;" title="{{ $item->judul }}">{{ $item->judul }}</div>
                            @if($item->kategori)
                            <div style="font-size:0.7rem;color:#94a3b8;">{{ $item->kategori }}</div>
                            @endif
                        </div>
                        <div style="display:flex;padding:6px 8px;border-top:1px solid #f1f5f9;gap:4px;">
                            <a href="{{ route('admin.galeri.edit', $item) }}" class="btn-sm-admin btn-edit" style="flex:1;text-align:center;"><i class="bi bi-pencil-fill"></i></a>
                            <form action="{{ route('admin.galeri.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')" style="flex:1;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm-admin btn-delete" style="width:100%;"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        @endif
    </div>
</div>

{{-- Import Modal --}}
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius:16px; border:none;">
            <div class="modal-header" style="background:#f8fafc; border-bottom:1px solid #e8edf5; padding:18px 24px;">
                <h5 class="modal-title" style="font-weight:700; font-size:1rem;">
                    <i class="bi bi-download me-2 text-primary"></i>Import Galeri dari Proyek
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.galeri.import-proyek') }}" method="POST">
                @csrf
                <div class="modal-body" style="padding:20px 24px; max-height:450px; overflow-y:auto;">
                    @if($proyekDenganGaleri->isEmpty())
                    <div class="text-center py-4" style="color:#94a3b8;">
                        <i class="bi bi-folder-x" style="font-size:2.5rem;"></i>
                        <p class="mt-2 mb-0">Belum ada proyek yang memiliki foto galeri.</p>
                    </div>
                    @else
                    <p style="font-size:0.85rem; color:#64748b; margin-bottom:16px;">
                        Pilih proyek yang ingin diimpor foto galerinya. Foto yang sudah pernah diimpor tidak akan diduplikasi.
                    </p>

                    <div class="mb-3">
                        <label class="d-flex align-items-center gap-2 p-2 rounded" style="background:#f0f7ff; cursor:pointer; border:1px solid #dbeafe;">
                            <input type="checkbox" id="selectAll" style="width:18px; height:18px; accent-color:var(--icde-primary);">
                            <span style="font-weight:700; font-size:0.85rem; color:var(--icde-primary);">Pilih Semua ({{ $proyekDenganGaleri->count() }} proyek)</span>
                        </label>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        @foreach($proyekDenganGaleri as $proyek)
                        @php $fotoCount = is_array($proyek->galeri_proyek) ? count($proyek->galeri_proyek) : 0; @endphp
                        <label class="d-flex align-items-center gap-3 p-3 rounded proyek-check-item" style="border:1px solid #e8edf5; cursor:pointer; transition:all 0.2s;">
                            <input type="checkbox" name="pengalaman_ids[]" value="{{ $proyek->id }}" class="proyek-check" style="width:18px; height:18px; accent-color:var(--icde-primary); flex-shrink:0;">
                            <div style="flex:1; min-width:0;">
                                <div style="font-weight:700; font-size:0.88rem; color:#1e293b; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">{{ $proyek->nama_proyek }}</div>
                                <div style="font-size:0.78rem; color:#94a3b8;">
                                    <i class="bi bi-building me-1"></i>{{ $proyek->pemberi_kerja }}
                                    <span class="mx-1">•</span>
                                    <i class="bi bi-calendar me-1"></i>{{ $proyek->tahun }}
                                </div>
                            </div>
                            <span class="badge rounded-pill" style="background:rgba(27,108,168,0.1); color:var(--icde-primary); font-size:0.75rem; font-weight:700;">
                                <i class="bi bi-images me-1"></i>{{ $fotoCount }} foto
                            </span>
                        </label>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="modal-footer" style="border-top:1px solid #e8edf5; padding:14px 24px;">
                    <button type="button" class="btn-admin btn-light-admin" data-bs-dismiss="modal">Batal</button>
                    @if($proyekDenganGaleri->isNotEmpty())
                    <button type="submit" class="btn-admin btn-primary-admin">
                        <i class="bi bi-download me-1"></i>Import Foto Terpilih
                    </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

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
    }
});

function confirmBulkDelete() {
    const checked = document.querySelectorAll('.checkItem:checked');
    if (checked.length === 0) {
        alert('Pilih data yang akan dihapus.');
        return;
    }
    if(confirm('Hapus ' + checked.length + ' data terpilih?')) {
        const form = document.getElementById('bulkDeleteForm');
        const csrf = form.querySelector('input[name="_token"]').outerHTML;
        form.innerHTML = csrf;
        checked.forEach(item => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = item.value;
            form.appendChild(input);
        });
        form.submit();
    }
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.proyek-check');

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                cb.checked = selectAll.checked;
                cb.closest('.proyek-check-item').style.background = selectAll.checked ? '#f0f7ff' : '';
                cb.closest('.proyek-check-item').style.borderColor = selectAll.checked ? '#93c5fd' : '#e8edf5';
            });
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                this.closest('.proyek-check-item').style.background = this.checked ? '#f0f7ff' : '';
                this.closest('.proyek-check-item').style.borderColor = this.checked ? '#93c5fd' : '#e8edf5';
                selectAll.checked = [...checkboxes].every(c => c.checked);
            });
        });
    }
});
</script>
@endpush
<form id="bulkDeleteForm" action="{{ route('admin.galeri.bulk-destroy') }}" method="POST" style="display:none;">
    @csrf
</form>
@endsection
