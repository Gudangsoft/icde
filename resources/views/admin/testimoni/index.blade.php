@extends('admin.layouts.app')
@section('title', 'Kelola Testimoni')
@section('page_title', 'Testimoni')

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
                    <input type="hidden" name="key" value="page_testimoni_title">
                    <input type="text" name="value" class="form-control-admin mb-0" 
                           value="{{ \App\Models\Setting::get('page_testimoni_title', 'Testimoni') }}" 
                           placeholder="Contoh: Testimoni" required style="flex:1; border-radius:8px; padding:10px 15px;">
                </div>
                <button type="submit" class="btn-admin btn-primary-admin" style="padding: 10px 24px; border-radius:8px;">
                    <i class="bi bi-save-fill me-2"></i>Simpan
                </button>
            </form>
        </div>
    </div>

<form id="bulkDeleteForm" action="{{ route('admin.testimoni.bulk-destroy') }}" method="POST">
    @csrf
<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-chat-quote-fill me-2"></i>Daftar Testimoni ({{ $testimoni->count() }})</h5>
        <a href="{{ route('admin.testimoni.create') }}" class="btn-admin btn-primary-admin">
            <i class="bi bi-plus-circle-fill me-1"></i>Tambah Testimoni
        </a>
    </div>
    <div class="admin-card-body">
        <table class="table-admin table">
            <thead>
                <tr>
                    <th width="30"><input type="checkbox" id="checkAll" style="cursor:pointer;"></th>
                    <th width="50">#</th>
                    <th width="60">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan/Instansi</th>
                    <th>Testimoni</th>
                    <th width="90">Rating</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimoni as $i => $item)
                <tr>
                    <td><input type="checkbox" name="ids[]" class="checkItem" value="{{ $item->id }}" style="cursor:pointer;"></td>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                        @else
                        <div style="width:40px;height:40px;border-radius:50%;background:#eff6ff;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-person" style="color:#1B6CA8;"></i>
                        </div>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $item->nama }}</td>
                    <td style="font-size:0.82rem;color:#64748b;">{{ $item->jabatan }}@if($item->instansi)<br><span style="color:#94a3b8;">{{ $item->instansi }}</span>@endif</td>
                    <td style="font-size:0.82rem;font-style:italic;color:#374151;">{{ Str::limit($item->isi_testimoni, 80) }}</td>
                    <td>
                        <div style="color:#F5A623;">
                            @for($s=1;$s<=5;$s++)
                            <i class="bi {{ $s <= $item->rating ? 'bi-star-fill' : 'bi-star' }}" style="font-size:0.75rem;"></i>
                            @endfor
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.testimoni.edit', $item) }}" class="btn-sm-admin btn-edit"><i class="bi bi-pencil-fill"></i></a>
                            <form action="{{ route('admin.testimoni.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm-admin btn-delete"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4" style="color:#94a3b8;">Belum ada testimoni</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
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
