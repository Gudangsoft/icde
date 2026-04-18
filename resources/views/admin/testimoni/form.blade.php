@extends('admin.layouts.app')
@section('title', $testimoni->exists ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('page_title', 'Testimoni')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-chat-quote-fill me-2"></i>{{ $testimoni->exists ? 'Edit Testimoni' : 'Tambah Testimoni Baru' }}</h5>
        <a href="{{ route('admin.testimoni.index') }}" class="btn-admin btn-light-admin">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="admin-card-body p-4">
        @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ $testimoni->exists ? route('admin.testimoni.update', $testimoni) : route('admin.testimoni.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($testimoni->exists) @method('PUT') @endif
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control-admin @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $testimoni->nama ?? '') }}" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control-admin"
                            value="{{ old('jabatan', $testimoni->jabatan ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Instansi / Perusahaan</label>
                        <input type="text" name="instansi" class="form-control-admin"
                            value="{{ old('instansi', $testimoni->instansi ?? '') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Rating (1-5)</label>
                        <select name="bintang" class="form-control-admin">
                            @for($i=5;$i>=1;$i--)
                            <option value="{{ $i }}" {{ old('bintang', $testimoni->bintang ?? 5) == $i ? 'selected' : '' }}>
                                {{ $i }} Bintang
                            </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control-admin" accept="image/*">
                        @if($testimoni->foto)
                        <div class="img-preview-admin">
                            <img src="{{ asset('storage/'.$testimoni->foto) }}" style="width:48px;height:48px;border-radius:50%;object-fit:cover;">
                            <span>Foto saat ini</span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Isi Testimoni <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control-admin tinymce-editor @error('isi') is-invalid @enderror" rows="5">{{ old('isi', $testimoni->isi ?? '') }}</textarea>
                        @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Status</label>
                        <select name="aktif" class="form-control-admin">
                            <option value="1" {{ old('aktif', $testimoni->aktif ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('aktif', $testimoni->aktif ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-actions-admin">
                <button type="submit" class="btn-admin btn-primary-admin">
                    <i class="bi bi-save-fill me-1"></i>{{ $testimoni->exists ? 'Simpan Perubahan' : 'Tambah Testimoni' }}
                </button>
                <a href="{{ route('admin.testimoni.index') }}" class="btn-admin btn-light-admin">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
