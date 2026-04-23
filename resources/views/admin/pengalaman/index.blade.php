@extends('admin.layouts.app')
@section('title', 'Kelola Pengalaman')
@section('page_title', 'Pengalaman Proyek')

@section('content')
@if(session('sukses') || session('success'))
<div class="alert-success-admin mb-4 d-flex align-items-center gap-2">
    <i class="bi bi-check-circle-fill"></i> {{ session('sukses') ?? session('success') }}
</div>
@endif

{{-- Import Modal --}}
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-header" style="border-bottom:1px solid #f1f5f9;">
                <h5 class="modal-title" style="font-weight:700;"><i class="bi bi-file-earmark-arrow-up me-2" style="color:#1B6CA8;"></i>Import Pengalaman dari Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.pengalaman.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div style="background:#fffbeb;border:1px solid #fcd34d;border-radius:10px;padding:12px 16px;margin-bottom:18px;font-size:0.83rem;color:#92400e;">
                        <i class="bi bi-info-circle-fill me-1"></i>
                        Gunakan format template yang sudah disediakan. Sheet <strong>Kategori</strong> berisi daftar kategori valid.
                    </div>
                    <div class="form-group-admin mb-3">
                        <label style="font-weight:600;font-size:0.85rem;">File Excel (.xlsx / .xls)</label>
                        <input type="file" name="file_excel" class="form-control-admin" accept=".xlsx,.xls,.csv" required>
                    </div>
                    <a href="{{ route('admin.pengalaman.import.template') }}" class="d-inline-flex align-items-center gap-2" style="font-size:0.82rem;color:#1B6CA8;text-decoration:none;">
                        <i class="bi bi-download"></i> Download Template Excel
                    </a>
                </div>
                <div class="modal-footer" style="border-top:1px solid #f1f5f9;">
                    <button type="button" class="btn-admin btn-light-admin" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-admin btn-primary-admin"><i class="bi bi-upload me-1"></i>Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Filter kategori --}}
@php
    $kategoriList = [
        'Perencanaan Pembangunan',
        'Evaluasi Pembangunan',
        'Analisis Pengelolaan Keuangan dan Aset Daerah',
        'Perencanaan Sektoral',
        'Penelitian dan Pengkajian',
        'Peningkatan Kapasitas SDM Aparatur',
    ];
    $activeKat = request('kategori');
@endphp
<div class="d-flex flex-wrap gap-2 mb-4">
    <a href="{{ route('admin.pengalaman.index') }}" class="btn-admin {{ !$activeKat ? 'btn-primary-admin' : 'btn-light-admin' }}" style="padding:6px 14px;font-size:0.8rem;">Semua</a>
    @foreach($kategoriList as $kat)
    <a href="{{ route('admin.pengalaman.index', ['kategori' => $kat]) }}" class="btn-admin {{ $activeKat == $kat ? 'btn-primary-admin' : 'btn-light-admin' }}" style="padding:6px 14px;font-size:0.8rem;">{{ $kat }}</a>
    @endforeach
</div>


    <div class="admin-card mb-4" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.setting.update_title') }}" method="POST" class="d-flex align-items-center gap-3 flex-wrap">
                @csrf
                <div class="d-flex align-items-center" style="flex: 1; min-width:300px;">
                    <label class="mb-0 fw-bold me-3" style="white-space: nowrap; color:#374151; font-size:0.9rem;"><i class="bi bi-pencil-square me-2 text-primary"></i>Ubah Judul Halaman di Website:</label>
                    <input type="hidden" name="key" value="page_pengalaman_title">
                    <input type="text" name="value" class="form-control-admin mb-0" 
                           value="{{ \App\Models\Setting::get('page_pengalaman_title', 'Pengalaman Perusahaan') }}" 
                           placeholder="Contoh: Pengalaman Perusahaan" required style="flex:1; border-radius:8px; padding:10px 15px;">
                </div>
                <button type="submit" class="btn-admin btn-primary-admin" style="padding: 10px 24px; border-radius:8px;">
                    <i class="bi bi-save-fill me-2"></i>Simpan
                </button>
            </form>
        </div>
    </div>

<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-folder-fill me-2"></i>Daftar Pengalaman
            <span style="background:#eff6ff;color:#1B6CA8;padding:2px 10px;border-radius:12px;font-size:0.78rem;font-weight:600;margin-left:6px;">{{ $pengalaman->total() }}</span>
        </h5>
        <div class="d-flex gap-2 flex-wrap">
            <button type="button" class="btn-admin btn-danger" id="btnBulkDelete" style="display:none;background:#dc2626;color:white;border:none;" onclick="confirmBulkDelete()">
                <i class="bi bi-trash-fill me-1"></i>Hapus Terpilih
            </button>
            <a href="{{ route('admin.pengalaman.export', request()->only('kategori')) }}" class="btn-admin btn-light-admin">
                <i class="bi bi-file-earmark-excel me-1" style="color:#16a34a;"></i>Export Excel
            </a>
            <button type="button" class="btn-admin btn-light-admin" data-bs-toggle="modal" data-bs-target="#importModal">
                <i class="bi bi-file-earmark-arrow-up me-1" style="color:#d97706;"></i>Import Excel
            </button>
            <a href="{{ route('admin.pengalaman.create') }}" class="btn-admin btn-primary-admin">
                <i class="bi bi-folder-plus me-1"></i>Tambah Proyek
            </a>
        </div>
    </div>
    <div class="admin-card-body">
        <table class="table-admin table">
            <thead>
                <tr>
                    <th width="30"><input type="checkbox" id="checkAll" style="cursor:pointer;"></th>
                    <th width="50">#</th>
                    <th>Nama Proyek</th>
                    <th>Pemberi Kerja</th>
                    <th>Kategori</th>
                    <th width="70">Tahun</th>
                    <th width="80">Lokasi</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengalaman as $i => $item)
                <tr>
                    <td>{{ $pengalaman->firstItem() + $i }}</td>
                    <td style="font-weight:600;max-width:260px;">{{ Str::limit($item->nama_proyek, 65) }}</td>
                    <td style="font-size:0.83rem;">{{ $item->pemberi_kerja }}</td>
                    <td>
                        <span style="background:#eff6ff;color:#1B6CA8;padding:3px 10px;border-radius:20px;font-size:0.72rem;font-weight:600;white-space:nowrap;">
                            {{ Str::limit($item->kategori ?? '–', 28) }}
                        </span>
                    </td>
                    <td class="text-center" style="font-weight:600;">{{ $item->tahun }}</td>
                    <td style="font-size:0.82rem;color:#64748b;">{{ $item->lokasi ?? '–' }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.pengalaman.edit', $item) }}" class="btn-sm-admin btn-edit"><i class="bi bi-pencil-fill"></i></a>
                            <form action="{{ route('admin.pengalaman.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus proyek ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm-admin btn-delete"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4" style="color:#94a3b8;">Belum ada data pengalaman</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($pengalaman->hasPages())
        <div class="p-3 d-flex justify-content-end">
            {{ $pengalaman->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
<form id="bulkDeleteForm" action="{{ route('admin.pengalaman.bulk-destroy') }}" method="POST" style="display:none;">
    @csrf
</form>
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

@endpush
