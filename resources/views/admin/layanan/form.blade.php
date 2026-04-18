@extends('admin.layouts.app')
@section('title', $layanan->exists ? 'Edit Layanan' : 'Tambah Layanan')
@section('page_title', 'Lingkup Layanan')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-briefcase-fill me-2"></i>{{ $layanan->exists ? 'Edit Layanan' : 'Tambah Layanan Baru' }}</h5>
        <a href="{{ route('admin.layanan.index') }}" class="btn-admin btn-light-admin">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="admin-card-body p-4">
        @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ $layanan->exists ? route('admin.layanan.update', $layanan) : route('admin.layanan.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($layanan->exists) @method('PUT') @endif
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="form-group-admin">
                        <label>Judul Layanan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control-admin @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $layanan->judul ?? '') }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Kelas Ikon Bootstrap <small style="color:#94a3b8;">(bi-...)</small></label>
                        <div class="d-flex gap-2 align-items-center">
                            <i id="ikonPreview" class="bi {{ old('ikon', $layanan->ikon ?? 'bi-briefcase') }}" style="font-size:1.8rem;color:#1B6CA8;flex-shrink:0;"></i>
                            <input type="text" name="ikon" id="ikonInput" class="form-control-admin" placeholder="bi-briefcase"
                                value="{{ old('ikon', $layanan->ikon ?? '') }}"
                                oninput="document.getElementById('ikonPreview').className='bi '+this.value">
                        </div>
                        <small style="color:#94a3b8;font-size:0.75rem;">Contoh: bi-cloud-download-fill, bi-people-fill, bi-graph-up-arrow</small>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control-admin tinymce-editor @error('deskripsi') is-invalid @enderror" rows="6">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
                        <small style="color:#94a3b8;font-size:0.75rem;">Jelaskan cakupan, proses, dan hasil layanan secara singkat dan jelas.</small>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Gambar Layanan</label>
                        <input type="file" name="gambar" class="form-control-admin" accept="image/*">
                        @if($layanan->gambar)
                        <div class="img-preview-admin">
                            <img src="{{ asset('storage/'.$layanan->gambar) }}" style="height:64px;width:auto;object-fit:cover;border-radius:6px;">
                            <span>Gambar saat ini</span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Urutan Tampil</label>
                        <input type="number" name="urutan" class="form-control-admin" min="1"
                            value="{{ old('urutan', $layanan->urutan ?? 1) }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Status</label>
                        <select name="aktif" class="form-control-admin">
                            <option value="1" {{ old('aktif', $layanan->aktif ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('aktif', $layanan->aktif ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-actions-admin">
                <button type="submit" class="btn-admin btn-primary-admin">
                    <i class="bi bi-save-fill me-1"></i>{{ $layanan->exists ? 'Simpan Perubahan' : 'Tambah Layanan' }}
                </button>
                <a href="{{ route('admin.layanan.index') }}" class="btn-admin btn-light-admin">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
