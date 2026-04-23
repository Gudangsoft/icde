@extends('admin.layouts.app')
@section('title', 'Struktur Organisasi')
@section('page_title', 'Struktur Organisasi')

@section('content')

@if(session('sukses') || session('success'))
<div class="alert-success-admin mb-4 d-flex align-items-center gap-2">
    <i class="bi bi-check-circle-fill"></i> {{ session('sukses') ?? session('success') }}
</div>
@endif

    <div class="admin-card mb-4" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.setting.update_title') }}" method="POST" class="d-flex align-items-center gap-3 flex-wrap">
                @csrf
                <div class="d-flex align-items-center" style="flex: 1; min-width:300px;">
                    <label class="mb-0 fw-bold me-3" style="white-space: nowrap; color:#374151; font-size:0.9rem;"><i class="bi bi-pencil-square me-2 text-primary"></i>Ubah Judul Halaman di Website:</label>
                    <input type="hidden" name="key" value="page_struktur_title">
                    <input type="text" name="value" class="form-control-admin mb-0" 
                           value="{{ \App\Models\Setting::get('page_struktur_title', 'Struktur Organisasi') }}" 
                           placeholder="Contoh: Struktur Organisasi" required style="flex:1; border-radius:8px; padding:10px 15px;">
                </div>
                <button type="submit" class="btn-admin btn-primary-admin" style="padding: 10px 24px; border-radius:8px;">
                    <i class="bi bi-save-fill me-2"></i>Simpan
                </button>
            </form>
        </div>
    </div>


<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-diagram-3-fill me-2"></i>Daftar Struktur</h5>
        <div class="d-flex gap-2 flex-wrap">
            
            <a href="{{ route('admin.struktur.create') }}" class="btn-admin btn-primary-admin">
                <i class="bi bi-plus-circle-fill me-1"></i>Tambah Struktur
            </a>
        </div>
    </div>
    <div class="admin-card-body">
        @if($items->isEmpty())
        <div style="padding:40px;text-align:center;color:#94a3b8;">
            <i class="bi bi-diagram-3" style="font-size:3rem;display:block;margin-bottom:12px;"></i>
            Belum ada data. <a href="{{ route('admin.struktur.create') }}">Tambah posisi pertama</a>.
        </div>
        @else
        <table class="table-admin w-100">
            <thead>
                <tr>
                    <th style="width:50px;">Urutan</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Atasan / Parent</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td class="text-center">
                        <span style="background:#f1f5f9;color:#64748b;font-weight:700;font-size:0.78rem;padding:3px 10px;border-radius:8px;">{{ $item->urutan }}</span>
                    </td>
                    <td>
                        <div style="font-weight:600;color:#1e293b;">{{ $item->nama }}</div>
                        @if($item->gelar)<div style="font-size:0.78rem;color:#94a3b8;">{{ $item->gelar }}</div>@endif
                    </td>
                    <td style="color:#475569;">{{ $item->jabatan }}</td>
                    <td style="color:#64748b;font-size:0.85rem;">{{ $item->parent?->jabatan ?? '—' }}</td>
                    <td>
                        @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}" class="img-preview" style="width:44px;height:44px;border-radius:50%;">
                        @else
                        <div style="width:44px;height:44px;border-radius:50%;background:#e2e8f0;display:flex;align-items:center;justify-content:center;color:#94a3b8;"><i class="bi bi-person"></i></div>
                        @endif
                    </td>
                    <td>
                        <span class="{{ $item->aktif ? 'badge-aktif' : 'badge-nonaktif' }}">
                            {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.struktur.edit', $item) }}" class="btn-sm-admin btn-edit" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.struktur.destroy', $item) }}"
                                  onsubmit="return confirm('Hapus posisi ini? Anak hirarki akan dipindah ke atasannya.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm-admin btn-delete" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>


@endsection

@push('scripts')



@endpush
