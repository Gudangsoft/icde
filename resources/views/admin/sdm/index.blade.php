@extends('admin.layouts.app')
@section('title', 'Kelola SDM')
@section('page_title', 'Sumber Daya Manusia')

@section('content')
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-header" style="border-bottom:1px solid #f1f5f9;">
                <h5 class="modal-title" style="font-weight:700;"><i class="bi bi-file-earmark-arrow-up me-2" style="color:#1B6CA8;"></i>Import Data dari Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.sdm.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div style="background:#fffbeb;border:1px solid #fcd34d;border-radius:10px;padding:12px 16px;margin-bottom:18px;font-size:0.83rem;color:#92400e;">
                        <i class="bi bi-info-circle-fill me-1"></i>
                        Gunakan format template yang sudah disediakan. Download template terlebih dahulu.
                    </div>
                    <div class="form-group-admin mb-3">
                        <label style="font-weight:600;font-size:0.85rem;">File Excel (.xlsx / .xls)</label>
                        <input type="file" name="file_excel" class="form-control-admin" accept=".xlsx,.xls,.csv" required>
                    </div>
                    <a href="{{ route('admin.sdm.import.template') }}" class="d-inline-flex align-items-center gap-2" style="font-size:0.82rem;color:#1B6CA8;text-decoration:none;">
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
                    <input type="hidden" name="key" value="page_sdm_title">
                    <input type="text" name="value" class="form-control-admin mb-0" 
                           value="{{ \App\Models\Setting::get('page_sdm_title', 'Sumber Daya Manusia') }}" 
                           placeholder="Contoh: Sumber Daya Manusia" required style="flex:1; border-radius:8px; padding:10px 15px;">
                </div>
                <button type="submit" class="btn-admin btn-primary-admin" style="padding: 10px 24px; border-radius:8px;">
                    <i class="bi bi-save-fill me-2"></i>Simpan
                </button>
            </form>
        </div>
    </div>


<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-people-fill me-2"></i>Daftar Tenaga Ahli</h5>
        <div class="d-flex gap-2 flex-wrap">
            <button type="button" class="btn-admin btn-danger" id="btnBulkDelete" style="display:none;background:#dc2626;color:white;border:none;" onclick="confirmBulkDelete()">
                <i class="bi bi-trash-fill me-1"></i>Hapus Terpilih
            </button>
            <a href="{{ route('admin.sdm.export') }}" class="btn-admin btn-light-admin">
                <i class="bi bi-file-earmark-excel me-1" style="color:#16a34a;"></i>Export Excel
            </a>
            <button type="button" class="btn-admin btn-light-admin" data-bs-toggle="modal" data-bs-target="#importModal">
                <i class="bi bi-file-earmark-arrow-up me-1" style="color:#d97706;"></i>Import Excel
            </button>
            <a href="{{ route('admin.sdm.create') }}" class="btn-admin btn-primary-admin">
                <i class="bi bi-plus-circle-fill me-1"></i>Tambah SDM
            </a>
        </div>
    </div>
    <div class="admin-card-body">
        <table class="table-admin table">
            <thead>
                <tr>
                    <th width="30"><input type="checkbox" id="checkAll" style="cursor:pointer;"></th>
                    <th width="50">#</th>
                    <th width="60">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Keahlian</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sdm as $i => $item)
                <tr>
                    <td><input type="checkbox" name="ids[]" class="checkItem" value="{{ $item->id }}" style="cursor:pointer;"></td>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                        @else
                        <div style="width:40px;height:40px;border-radius:50%;background:#e2e8f0;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-person" style="color:#94a3b8;"></i>
                        </div>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $item->nama }}</td>
                    <td style="font-size:0.83rem;color:#1B6CA8;">{{ $item->jabatan }}</td>
                    <td style="font-size:0.82rem;color:#64748b;">{{ Str::limit($item->keahlian, 60) }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.sdm.edit', $item) }}" class="btn-sm-admin btn-edit"><i class="bi bi-pencil-fill"></i></a>
                            <form action="{{ route('admin.sdm.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus data SDM ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm-admin btn-delete"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4" style="color:#94a3b8;">Belum ada data SDM</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<form id="bulkDeleteForm" action="{{ route('admin.sdm.bulk-destroy') }}" method="POST" style="display:none;">
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
