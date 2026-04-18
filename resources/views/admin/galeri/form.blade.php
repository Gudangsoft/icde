@extends('admin.layouts.app')
@section('title', $galeri->exists ? 'Edit Foto' : 'Upload Foto')
@section('page_title', 'Galeri')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-images me-2"></i>{{ $galeri->exists ? 'Edit Foto Galeri' : 'Upload Foto Baru' }}</h5>
        <a href="{{ route('admin.galeri.index') }}" class="btn-admin btn-light-admin">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="admin-card-body p-4">
        @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ $galeri->exists ? route('admin.galeri.update', $galeri) : route('admin.galeri.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($galeri->exists) @method('PUT') @endif
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="form-group-admin">
                        <label>Judul Foto <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control-admin @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $galeri->judul ?? '') }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control-admin">
                            @foreach(['Kegiatan','Proyek','Kantor','Tim','Lainnya'] as $k)
                            <option value="{{ $k }}" {{ old('kategori', $galeri->kategori ?? '') == $k ? 'selected' : '' }}>{{ $k }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Album --}}
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label><i class="bi bi-folder2 me-1"></i>Album</label>
                        <select name="album" class="form-control-admin" id="albumSelect">
                            <option value="">-- Tanpa Album --</option>
                            @foreach($albums as $album)
                            <option value="{{ $album }}" {{ old('album', $galeri->album ?? '') == $album ? 'selected' : '' }}>{{ $album }}</option>
                            @endforeach
                            <option value="__baru__">+ Buat Album Baru...</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6" id="albumBaruWrap" style="display:none;">
                    <div class="form-group-admin">
                        <label>Nama Album Baru</label>
                        <input type="text" name="album_baru" class="form-control-admin" id="albumBaruInput"
                            placeholder="Ketik nama album baru...">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control-admin tinymce-editor" rows="3">{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Upload Gambar {{ isset($galeri) ? '' : '<span class="text-danger">*</span>' }}</label>
                        <input type="file" name="gambar" class="form-control-admin" accept="image/*" id="imgInput" onchange="previewImg(this)">
                        @if($galeri->gambar)
                        <div class="img-preview-admin mt-2" style="display:block;">
                            <img id="imgPreview" src="{{ asset('storage/'.$galeri->gambar) }}" style="width:100%;max-height:180px;object-fit:cover;border-radius:6px;">
                        </div>
                        @else
                        <img id="imgPreview" src="" style="display:none;width:100%;max-height:180px;object-fit:cover;border-radius:6px;margin-top:10px;">
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Urutan</label>
                        <input type="number" name="urutan" class="form-control-admin" min="1"
                            value="{{ old('urutan', $galeri->urutan ?? 1) }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Status</label>
                        <select name="aktif" class="form-control-admin">
                            <option value="1" {{ old('aktif', $galeri->aktif ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('aktif', $galeri->aktif ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-actions-admin">
                <button type="submit" class="btn-admin btn-primary-admin">
                    <i class="bi bi-save-fill me-1"></i>{{ $galeri->exists ? 'Simpan Perubahan' : 'Upload Foto' }}
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="btn-admin btn-light-admin">Batal</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewImg(input) {
    const preview = document.getElementById('imgPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; }
        reader.readAsDataURL(input.files[0]);
    }
}

// Album baru toggle
document.getElementById('albumSelect').addEventListener('change', function() {
    const wrap = document.getElementById('albumBaruWrap');
    const input = document.getElementById('albumBaruInput');
    if (this.value === '__baru__') {
        wrap.style.display = 'block';
        input.focus();
    } else {
        wrap.style.display = 'none';
        input.value = '';
    }
});
</script>
@endpush
@endsection
