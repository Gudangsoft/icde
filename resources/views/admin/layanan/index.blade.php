@extends('admin.layouts.app')
@section('title', 'Kelola Layanan')
@section('page_title', 'Lingkup Layanan')

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
                    <input type="hidden" name="key" value="page_layanan_title">
                    <input type="text" name="value" class="form-control-admin mb-0" 
                           value="{{ \App\Models\Setting::get('page_layanan_title', 'Lingkup Layanan') }}" 
                           placeholder="Contoh: Lingkup Layanan" required style="flex:1; border-radius:8px; padding:10px 15px;">
                </div>
                <button type="submit" class="btn-admin btn-primary-admin" style="padding: 10px 24px; border-radius:8px;">
                    <i class="bi bi-save-fill me-2"></i>Simpan
                </button>
            </form>
        </div>
    </div>

<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-briefcase-fill me-2"></i>Daftar Layanan ({{ $layanan->count() }})</h5>
        <a href="{{ route('admin.layanan.create') }}" class="btn-admin btn-primary-admin">
            <i class="bi bi-plus-circle-fill me-1"></i>Tambah Layanan
        </a>
    </div>
    <div class="admin-card-body">
        <table class="table-admin table">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th width="60">Ikon</th>
                    <th>Judul Layanan</th>
                    <th>Deskripsi</th>
                    <th width="80">Urutan</th>
                    <th width="90">Status</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanan as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        @if($item->ikon)
                        <i class="bi {{ $item->ikon }}" style="font-size:1.5rem;color:#1B6CA8;"></i>
                        @else <span style="color:#cbd5e1;">—</span>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $item->judul }}</td>
                    <td style="font-size:0.83rem;color:#64748b;">{{ Str::limit($item->deskripsi, 80) }}</td>
                    <td class="text-center">{{ $item->urutan }}</td>
                    <td>
                        @if($item->aktif)
                        <span class="badge-aktif">Aktif</span>
                        @else
                        <span class="badge-nonaktif">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.layanan.edit', $item) }}" class="btn-sm-admin btn-edit"><i class="bi bi-pencil-fill"></i></a>
                            <form action="{{ route('admin.layanan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm-admin btn-delete"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4" style="color:#94a3b8;">Belum ada data layanan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
