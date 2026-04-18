@extends('admin.layouts.app')
@section('title', 'Edit Beranda')
@section('page_title', 'Edit Beranda')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-pencil-fill me-2"></i>Edit Konten Beranda</h5>
        <a href="{{ route('admin.beranda.index') }}" class="btn-admin btn-light-admin">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="admin-card-body p-4">
        @if($errors->any())
        <div class="alert alert-danger mb-4">
            <strong><i class="bi bi-exclamation-triangle-fill me-1"></i>Terdapat kesalahan:</strong>
            <ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('admin.beranda.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Judul Hero <span class="text-danger">*</span></label>
                        <input type="text" name="judul_hero" class="form-control-admin @error('judul_hero') is-invalid @enderror"
                            value="{{ old('judul_hero', $beranda->judul_hero ?? '') }}" required>
                        @error('judul_hero')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Subjudul Hero</label>
                        <input type="text" name="subjudul_hero" class="form-control-admin"
                            value="{{ old('subjudul_hero', $beranda->subjudul_hero ?? '') }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control-admin tinymce-editor" rows="4">{{ old('deskripsi', $beranda->deskripsi ?? '') }}</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Jumlah Proyek</label>
                        <input type="number" name="jumlah_proyek" class="form-control-admin"
                            value="{{ old('jumlah_proyek', $beranda->jumlah_proyek ?? '') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Jumlah Klien</label>
                        <input type="number" name="jumlah_klien" class="form-control-admin"
                            value="{{ old('jumlah_klien', $beranda->jumlah_klien ?? '') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Jumlah Tenaga Ahli</label>
                        <input type="number" name="jumlah_tenaga_ahli" class="form-control-admin"
                            value="{{ old('jumlah_tenaga_ahli', $beranda->jumlah_tenaga_ahli ?? '') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Tahun Berdiri</label>
                        <input type="number" name="tahun_berdiri" class="form-control-admin"
                            value="{{ old('tahun_berdiri', $beranda->tahun_berdiri ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Gambar Hero</label>
                        <input type="file" name="gambar_hero" class="form-control-admin" accept="image/*">
                        @if(isset($beranda->gambar_hero) && $beranda->gambar_hero)
                        <div class="img-preview-admin mt-2">
                            <img src="{{ asset('storage/'.$beranda->gambar_hero) }}" style="height:64px;width:auto;object-fit:cover;border-radius:6px;">
                            <span>Gambar saat ini</span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Teks Tombol CTA</label>
                        <input type="text" name="teks_cta" class="form-control-admin"
                            value="{{ old('teks_cta', $beranda->teks_cta ?? 'Hubungi Kami') }}">
                    </div>
                </div>
            </div>
            <div class="form-actions-admin">
                <button type="submit" class="btn-admin btn-primary-admin">
                    <i class="bi bi-save-fill me-1"></i>Simpan Perubahan
                </button>
                <a href="{{ route('admin.beranda.index') }}" class="btn-admin btn-light-admin">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
