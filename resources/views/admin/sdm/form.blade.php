@extends('admin.layouts.app')
@section('title', $sdm->exists ? 'Edit SDM' : 'Tambah SDM')
@section('page_title', 'Sumber Daya Manusia')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-people-fill me-2"></i>{{ $sdm->exists ? 'Edit Data SDM' : 'Tambah Tenaga Ahli Baru' }}</h5>
        <a href="{{ route('admin.sdm.index') }}" class="btn-admin btn-light-admin">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="admin-card-body p-4">
        @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ $sdm->exists ? route('admin.sdm.update', $sdm) : route('admin.sdm.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($sdm->exists) @method('PUT') @endif
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control-admin @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $sdm->nama ?? '') }}" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="jabatan" class="form-control-admin @error('jabatan') is-invalid @enderror"
                            value="{{ old('jabatan', $sdm->jabatan ?? '') }}" required>
                        @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Keahlian / Spesialisasi</label>
                        <input type="text" name="keahlian" class="form-control-admin"
                            value="{{ old('keahlian', $sdm->keahlian ?? '') }}" placeholder="Contoh: Teknik Sipil, Manajemen Proyek">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Deskripsi / Pengalaman</label>
                        <textarea name="deskripsi" class="form-control-admin tinymce-editor" rows="4">{{ old('deskripsi', $sdm->deskripsi ?? '') }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Pendidikan</label>
                        <input type="text" name="pendidikan" class="form-control-admin"
                            value="{{ old('pendidikan', $sdm->pendidikan ?? '') }}" placeholder="S1 Teknik Sipil - ITB">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Pengalaman (Tahun)</label>
                        <input type="number" name="pengalaman_tahun" class="form-control-admin" min="0"
                            value="{{ old('pengalaman_tahun', $sdm->pengalaman_tahun ?? '') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control-admin" accept="image/*">
                        @if($sdm->foto)
                        <div class="img-preview-admin">
                            <img src="{{ asset('storage/'.$sdm->foto) }}" style="width:52px;height:52px;border-radius:50%;object-fit:cover;">
                            <span>Foto saat ini</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-actions-admin">
                <button type="submit" class="btn-admin btn-primary-admin">
                    <i class="bi bi-save-fill me-1"></i>{{ $sdm->exists ? 'Simpan Perubahan' : 'Tambah SDM' }}
                </button>
                <a href="{{ route('admin.sdm.index') }}" class="btn-admin btn-light-admin">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
