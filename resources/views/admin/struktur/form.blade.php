@extends('admin.layouts.app')
@section('title', $model->exists ? 'Edit Posisi' : 'Tambah Posisi')
@section('page_title', 'Struktur Organisasi')

@section('content')

@if($errors->any())
<div class="alert-danger-admin mb-4">
    <div class="d-flex align-items-center gap-2 mb-1"><i class="bi bi-exclamation-triangle-fill"></i><strong>Terdapat kesalahan:</strong></div>
    <ul class="mb-0 ps-4">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-diagram-3 me-2"></i>{{ $model->exists ? 'Edit Posisi' : 'Tambah Posisi Baru' }}</h5>
        <a href="{{ route('admin.struktur.index') }}" class="btn-admin btn-light-admin">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="admin-card-body p-4">
        <form action="{{ $model->exists ? route('admin.struktur.update', $model) : route('admin.struktur.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($model->exists) @method('PUT') @endif

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama"
                            class="form-control-admin @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $model->nama ?? '') }}"
                            placeholder="contoh: H. Gunarto">
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Gelar</label>
                        <input type="text" name="gelar"
                            class="form-control-admin @error('gelar') is-invalid @enderror"
                            value="{{ old('gelar', $model->gelar ?? '') }}"
                            placeholder="contoh: Drs., MM.">
                        @error('gelar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="jabatan"
                            class="form-control-admin @error('jabatan') is-invalid @enderror"
                            value="{{ old('jabatan', $model->jabatan ?? '') }}"
                            placeholder="contoh: Direktur Utama">
                        @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Atasan / Parent</label>
                        <select name="parent_id" class="form-control-admin @error('parent_id') is-invalid @enderror">
                            <option value="">— Tidak ada (level teratas) —</option>
                            @foreach($parents as $p)
                            <option value="{{ $p->id }}" {{ old('parent_id', $model->parent_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->jabatan }} — {{ $p->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('parent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Urutan</label>
                        <input type="number" name="urutan" min="0"
                            class="form-control-admin @error('urutan') is-invalid @enderror"
                            value="{{ old('urutan', $model->urutan ?? 0) }}">
                        @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div style="font-size:0.78rem;color:#94a3b8;margin-top:4px;">Angka kecil tampil lebih dulu.</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Foto</label>
                        <input type="file" name="foto" accept="image/*"
                            class="form-control-admin @error('foto') is-invalid @enderror"
                            onchange="previewFoto(this)">
                        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div style="font-size:0.78rem;color:#94a3b8;margin-top:4px;">Opsional. Maks 2MB.</div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-start gap-3 pt-4">
                    @if($model->foto)
                    <img id="prevFoto" src="{{ asset('storage/'.$model->foto) }}"
                         style="width:70px;height:70px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0;">
                    @else
                    <div id="prevFotoEmpty" style="width:70px;height:70px;border-radius:50%;background:#f1f5f9;border:2px dashed #e2e8f0;display:flex;align-items:center;justify-content:center;color:#cbd5e1;">
                        <i class="bi bi-person" style="font-size:1.6rem;"></i>
                    </div>
                    <img id="prevFoto" src="" style="width:70px;height:70px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0;display:none;">
                    @endif
                    <div class="mt-2">
                        <div class="d-flex align-items-center gap-2 mb-0">
                            <input type="checkbox" name="aktif" value="1" id="chkAktif"
                                {{ old('aktif', $model->aktif ?? true) ? 'checked' : '' }}
                                style="width:16px;height:16px;accent-color:var(--icde-primary);cursor:pointer;">
                            <label for="chkAktif" style="font-weight:600;font-size:0.83rem;color:#374151;cursor:pointer;">Aktif</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions-admin">
                <button type="submit" class="btn-admin btn-primary-admin">
                    <i class="bi bi-save-fill me-2"></i>Simpan
                </button>
                <a href="{{ route('admin.struktur.index') }}" class="btn-admin btn-light-admin">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewFoto(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('prevFoto');
        img.src = e.target.result;
        img.style.display = 'block';
        const empty = document.getElementById('prevFotoEmpty');
        if (empty) empty.style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
@endpush
