@extends('admin.layouts.app')
@section('title', $pengalaman->exists ? 'Edit Pengalaman' : 'Tambah Pengalaman')
@section('page_title', 'Pengalaman Proyek')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-folder-fill me-2"></i>{{ $pengalaman->exists ? 'Edit Proyek' : 'Tambah Pengalaman Proyek' }}</h5>
        <a href="{{ route('admin.pengalaman.index') }}" class="btn-admin btn-light-admin">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="admin-card-body p-4">
        @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ $pengalaman->exists ? route('admin.pengalaman.update', $pengalaman) : route('admin.pengalaman.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($pengalaman->exists) @method('PUT') @endif
            <div class="row g-4">
                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Nama / Judul Proyek <span class="text-danger">*</span></label>
                        <input type="text" name="nama_proyek" class="form-control-admin @error('nama_proyek') is-invalid @enderror"
                            value="{{ old('nama_proyek', $pengalaman->nama_proyek ?? '') }}" required>
                        @error('nama_proyek')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Pemberi Kerja / Klien <span class="text-danger">*</span></label>
                        <input type="text" name="pemberi_kerja" id="pemberi_kerja"
                            class="form-control-admin @error('pemberi_kerja') is-invalid @enderror"
                            value="{{ old('pemberi_kerja', $pengalaman->pemberi_kerja ?? '') }}"
                            placeholder="Ketik atau pilih nama klien..." required
                            autocomplete="off">
                        {{-- Datalist dari klien tersimpan --}}
                        <datalist id="klien-datalist">
                            @foreach($klienList as $k)
                            <option value="{{ $k }}">
                            @endforeach
                        </datalist>
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i>
                            Pilih dari daftar klien tersimpan atau ketik nama baru.
                        </small>
                        @error('pemberi_kerja')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="form-control-admin"
                            value="{{ old('lokasi', $pengalaman->lokasi ?? '') }}"
                            placeholder="Contoh: Kota Semarang, Kabupaten Klaten">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-control-admin select2">
                            <option value="">-- Pilih Kategori --</option>
                            @php
                                $kategoriLayanan = \App\Models\Layanan::where('aktif', true)->orderBy('urutan')->pluck('judul');
                            @endphp
                            @foreach($kategoriLayanan as $k)
                            <option value="{{ $k }}" {{ old('kategori', $pengalaman->kategori ?? '') == $k ? 'selected' : '' }}>{{ $k }}</option>
                            @endforeach
                            @if(isset($pengalaman->kategori) && !$kategoriLayanan->contains($pengalaman->kategori))
                            <option value="{{ $pengalaman->kategori }}" selected>{{ $pengalaman->kategori }} (Non-aktif / Lama)</option>
                            @endif
                        </select>
                        @error('kategori')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Tahun <span class="text-danger">*</span></label>
                        <input type="text" name="tahun" class="form-control-admin @error('tahun') is-invalid @enderror"
                            value="{{ old('tahun', $pengalaman->tahun ?? date('Y')) }}" placeholder="{{ date('Y') }}">
                        @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Urutan Tampil</label>
                        <input type="number" name="urutan" class="form-control-admin" min="0"
                            value="{{ old('urutan', $pengalaman->urutan ?? 0) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Logo Pemberi Kerja (Opsional)</label>
                        @if($pengalaman->logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $pengalaman->logo) }}" alt="Logo" style="height: 60px; border-radius: 6px;">
                        </div>
                        @endif
                        <input type="file" name="logo" class="form-control-admin @error('logo') is-invalid @enderror" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                        @error('logo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Galeri Proyek (Opsional, Bisa Lebih dari 1)</label>
                        <input type="file" name="galeri_proyek[]" class="form-control-admin @error('galeri_proyek.*') is-invalid @enderror" accept="image/*" multiple>
                        <small class="text-muted">Format: JPG, PNG. Maksimal 3MB per foto. Pilih banyak file sekaligus.</small>
                        @error('galeri_proyek.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    
                    @if($pengalaman->galeri_proyek && count($pengalaman->galeri_proyek) > 0)
                    <div class="mt-3">
                        <label>Foto Galeri Tersimpan:</label>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach($pengalaman->galeri_proyek as $foto)
                            <div class="position-relative" style="width: 100px; height: 100px;">
                                <img src="{{ asset('storage/' . $foto) }}" alt="Galeri" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                                <div class="position-absolute top-0 end-0 p-1">
                                    <div class="form-check m-0 bg-white rounded shadow-sm px-2 py-1" style="transform: scale(0.8); transform-origin: top right;">
                                        <input class="form-check-input m-0 mt-1" type="checkbox" name="hapus_galeri[]" value="{{ $foto }}" id="hapusgaleri{{ $loop->index }}">
                                        <label class="form-check-label small d-inline-block ps-1" for="hapusgaleri{{ $loop->index }}" style="cursor: pointer;">Hapus</label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-danger mt-1 d-block"><i class="bi bi-info-circle"></i> Centang kotak pada foto untuk menghapusnya saat disimpan.</small>
                    </div>
                    @endif
                </div>
                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Deskripsi / Lingkup Pekerjaan</label>
                        <textarea name="deskripsi" class="form-control-admin tinymce-editor" rows="4"
                            placeholder="Uraikan singkat lingkup atau deskripsi pekerjaan...">{{ old('deskripsi', $pengalaman->deskripsi ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-actions-admin">
                <button type="submit" class="btn-admin btn-primary-admin">
                    <i class="bi bi-save-fill me-1"></i>{{ $pengalaman->exists ? 'Simpan Perubahan' : 'Tambah Pengalaman' }}
                </button>
                <a href="{{ route('admin.pengalaman.index') }}" class="btn-admin btn-light-admin">Batal</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Bind datalist ke input pemberi_kerja
    document.getElementById('pemberi_kerja').setAttribute('list', 'klien-datalist');
</script>
@endpush
@endsection
