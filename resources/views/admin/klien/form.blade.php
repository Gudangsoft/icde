@extends('admin.layouts.app')
@section('title', $klien->exists ? 'Edit Klien' : 'Tambah Klien')
@section('page_title', 'Klien')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-building-fill me-2"></i>{{ $klien->exists ? 'Edit Klien' : 'Tambah Klien Baru' }}</h5>
        <a href="{{ route('admin.klien.index') }}" class="btn-admin btn-light-admin">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="admin-card-body p-4">
        @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ $klien->exists ? route('admin.klien.update', $klien) : route('admin.klien.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($klien->exists) @method('PUT') @endif
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="form-group-admin">
                        <label>Nama Klien <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control-admin @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $klien->nama ?? '') }}" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control-admin">
                            <option value="Pemerintah" {{ old('kategori', $klien->kategori ?? '') == 'Pemerintah' ? 'selected' : '' }}>Pemerintah</option>
                            <option value="Swasta" {{ old('kategori', $klien->kategori ?? '') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                            <option value="BUMN" {{ old('kategori', $klien->kategori ?? '') == 'BUMN' ? 'selected' : '' }}>BUMN</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Website</label>
                        <input type="url" name="website" class="form-control-admin" placeholder="https://..."
                            value="{{ old('website', $klien->website ?? '') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Urutan Tampil</label>
                        <input type="number" name="urutan" class="form-control-admin" min="1"
                            value="{{ old('urutan', $klien->urutan ?? 1) }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Status</label>
                        <select name="aktif" class="form-control-admin">
                            <option value="1" {{ old('aktif', $klien->aktif ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('aktif', $klien->aktif ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Logo Klien</label>
                        <input type="file" name="logo" class="form-control-admin" accept="image/*">
                        @if($klien->logo)
                        <div class="img-preview-admin">
                            <img src="{{ asset('storage/'.$klien->logo) }}" style="height:48px;width:auto;object-fit:contain;border-radius:4px;">
                            <span>Logo saat ini</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-actions-admin">
                <button type="submit" class="btn-admin btn-primary-admin">
                    <i class="bi bi-save-fill me-1"></i>{{ $klien->exists ? 'Simpan Perubahan' : 'Tambah Klien' }}
                </button>
                <a href="{{ route('admin.klien.index') }}" class="btn-admin btn-light-admin">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
