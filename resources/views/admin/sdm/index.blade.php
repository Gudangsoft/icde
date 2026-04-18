@extends('admin.layouts.app')
@section('title', 'Kelola SDM')
@section('page_title', 'Sumber Daya Manusia')

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
        <h5><i class="bi bi-people-fill me-2"></i>Daftar Tenaga Ahli ({{ $sdm->count() }})</h5>
        <a href="{{ route('admin.sdm.create') }}" class="btn-admin btn-primary-admin">
            <i class="bi bi-person-plus-fill me-1"></i>Tambah SDM
        </a>
    </div>
    <div class="admin-card-body">
        <table class="table-admin table">
            <thead>
                <tr>
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
@endsection
