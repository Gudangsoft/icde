@extends('admin.layouts.app')
@section('title', $berita->exists ? 'Edit Berita' : 'Tambah Berita')
@section('page_title', 'Berita / News')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="bi bi-newspaper me-2" style="color:#1B6CA8;"></i>{{ $berita->exists ? 'Edit Berita' : 'Tambah Berita Baru' }}</h5>
                <a href="{{ route('admin.berita.index') }}" class="btn-admin btn-light-admin">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="admin-card-body p-4">
                @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <form action="{{ $berita->exists ? route('admin.berita.update', $berita) : route('admin.berita.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($berita->exists) @method('PUT') @endif

                    <div class="row g-4">
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Judul Berita <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control-admin @error('judul') is-invalid @enderror"
                                    value="{{ old('judul', $berita->judul ?? '') }}"
                                    placeholder="Tulis judul berita..." required>
                                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Kategori</label>
                                <input type="text" name="kategori" class="form-control-admin"
                                    value="{{ old('kategori', $berita->kategori ?? '') }}"
                                    placeholder="Contoh: Proyek, Perusahaan, Kegiatan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Tanggal Publish <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_publish" class="form-control-admin"
                                    value="{{ old('tanggal_publish', ($berita->tanggal_publish ?? now())->format('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Ringkasan <small style="color:#94a3b8;">(ditampilkan di halaman daftar berita)</small></label>
                                <textarea name="ringkasan" class="form-control-admin" rows="2"
                                    placeholder="Ringkasan singkat berita (maks 500 karakter)...">{{ old('ringkasan', $berita->ringkasan ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Konten Berita <span class="text-danger">*</span></label>
                                <textarea name="konten" id="kontenBerita" class="form-control-admin tinymce-editor @error('konten') is-invalid @enderror" rows="12"
                                    placeholder="Tulis konten berita secara lengkap...">{{ old('konten', $berita->konten ?? '') }}</textarea>
                                @error('konten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Penulis</label>
                                <input type="text" name="penulis" class="form-control-admin"
                                    value="{{ old('penulis', $berita->penulis ?? Auth::user()->name) }}"
                                    placeholder="Nama penulis">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label>Status</label>
                                <div style="display:flex;align-items:center;gap:10px;padding:10px 0;">
                                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:600;font-size:0.87rem;">
                                        <input type="hidden" name="aktif" value="0">
                                        <input type="checkbox" name="aktif" value="1" class="form-check-input" style="width:18px;height:18px;cursor:pointer;"
                                            {{ old('aktif', $berita->aktif ?? true) ? 'checked' : '' }}>
                                        Publish (Tampilkan di website)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Gambar Cover <small style="color:#94a3b8;">— JPG/PNG/WebP, maks. 3MB</small></label>
                                <input type="file" name="gambar" class="form-control-admin" accept="image/jpg,image/jpeg,image/png,image/webp"
                                    onchange="previewImg(this)">
                            </div>
                            @if($berita->exists && $berita->gambar)
                            <div class="img-preview-admin mt-2">
                                <img id="imgPreview" src="{{ asset('storage/'.$berita->gambar) }}" style="max-height:180px;border-radius:8px;">
                            </div>
                            @else
                            <div class="img-preview-admin mt-2" id="previewContainer" style="display:none;">
                                <img id="imgPreview" src="" style="max-height:180px;border-radius:8px;">
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-actions-admin">
                        <button type="submit" class="btn-admin btn-primary-admin">
                            <i class="bi bi-save-fill me-1"></i>{{ $berita->exists ? 'Simpan Perubahan' : 'Tambah Berita' }}
                        </button>
                        <a href="{{ route('admin.berita.index') }}" class="btn-admin btn-light-admin">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Sidebar tips --}}
    <div class="col-lg-4">
        <div class="admin-card" style="position:sticky;top:80px;">
            <div class="admin-card-header"><h5><i class="bi bi-lightbulb me-2"></i>Tips</h5></div>
            <div style="padding:16px;font-size:0.82rem;color:#64748b;line-height:1.7;">
                <ul style="padding-left:18px;margin:0;">
                    <li><strong>Judul</strong> — buat singkat, jelas, dan menarik</li>
                    <li><strong>Ringkasan</strong> — akan muncul di daftar berita dan SEO</li>
                    <li><strong>Gambar Cover</strong> — rasio 16:9 paling ideal (1200×675px)</li>
                    <li><strong>Kategori</strong> — kelompokkan berita (Proyek, Kegiatan, dsb.)</li>
                    <li>Nonaktifkan status <strong>Publish</strong> untuk menyimpan sebagai draft</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImg(input) {
    const img = document.getElementById('imgPreview');
    const container = document.getElementById('previewContainer');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            if (container) container.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
