@extends('admin.layouts.app')
@section('title', 'Edit Tentang Kami')
@section('page_title', 'Tentang Kami')

@section('content')

@if(session('sukses') || session('success'))
<div class="alert-success-admin mb-4 d-flex align-items-center gap-2">
    <i class="bi bi-check-circle-fill"></i> {{ session('sukses') ?? session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert-danger-admin mb-4">
    <div class="d-flex align-items-center gap-2 mb-1">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <strong>Terdapat kesalahan:</strong>
    </div>
    <ul class="mb-0 ps-4">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.tentang.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    {{-- PROFIL PERUSAHAAN --}}
    <div class="admin-card mb-4">
        <div class="admin-card-header">
            <h5><i class="bi bi-building me-2 text-primary"></i>Profil Perusahaan</h5>
        </div>
        <div class="admin-card-body p-4">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Judul <span class="text-danger">*</span></label>
                        <input type="text" name="nama_perusahaan"
                            class="form-control-admin @error('nama_perusahaan') is-invalid @enderror"
                            value="{{ old('nama_perusahaan', $tentang->nama_perusahaan ?? $tentang->judul ?? '') }}"
                            placeholder="contoh: PT ICDE Semarang" required>
                        @error('nama_perusahaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Profil Singkat <span class="text-danger">*</span></label>
                        <textarea name="profil_singkat" rows="6"
                            class="form-control-admin @error('profil_singkat') is-invalid @enderror"
                            placeholder="Tuliskan deskripsi singkat tentang perusahaan...">{{ old('profil_singkat', $tentang->profil_singkat ?? $tentang->deskripsi ?? '') }}</textarea>
                        @error('profil_singkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div style="font-size:0.78rem;color:#94a3b8;margin-top:4px;">Tampil di halaman Tentang Kami dan digunakan sebagai meta description.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DATA PERUSAHAAN --}}
    <div class="admin-card mb-4">
        <div class="admin-card-header">
            <h5><i class="bi bi-journal-text me-2 text-primary"></i>Data Perusahaan</h5>
            <small class="text-muted">Informasi legalitas dan formal perusahaan</small>
        </div>
        <div class="admin-card-body p-4">


            {{-- Akta Pendirian --}}
            <div style="font-size:0.72rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#94a3b8;margin-bottom:14px;padding-bottom:6px;border-bottom:1px solid #f1f5f9;">
                Akta Pendirian
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-5">
                    <div class="form-group-admin">
                        <label>Notaris</label>
                        <input type="text" name="akta_notaris"
                            class="form-control-admin @error('akta_notaris') is-invalid @enderror"
                            value="{{ old('akta_notaris', $tentang->akta_notaris ?? '') }}"
                            placeholder="Tri Isdiyanti, SH">
                        @error('akta_notaris')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group-admin">
                        <label>Nomor Akta</label>
                        <input type="text" name="akta_nomor"
                            class="form-control-admin @error('akta_nomor') is-invalid @enderror"
                            value="{{ old('akta_nomor', $tentang->akta_nomor ?? '') }}"
                            placeholder="05 (lima)">
                        @error('akta_nomor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Tanggal Akta</label>
                        <input type="text" name="akta_tanggal"
                            class="form-control-admin @error('akta_tanggal') is-invalid @enderror"
                            value="{{ old('akta_tanggal', $tentang->akta_tanggal ?? '') }}"
                            placeholder="9 April 2010">
                        @error('akta_tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Legalitas --}}
            <div class="d-flex justify-content-between align-items-center" style="border-bottom:1px solid #f1f5f9;margin-bottom:14px;padding-bottom:6px;">
                <div style="font-size:0.72rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#94a3b8;">
                    Legalitas Usaha
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary" id="btnAddLegalitas" style="font-size:0.75rem;padding:4px 10px;">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Kolom
                </button>
            </div>
            <div id="legalitas-container" class="mb-4">
                @php
                    $legalitasDinamis = $tentang->legalitas_dinamis ?? [];
                    // Fallback to static fields if JSON is empty (Migration compatibility)
                    if (empty($legalitasDinamis) && ($tentang->npwp || $tentang->nib || $tentang->kbli || $tentang->siup_tanggal)) {
                        if($tentang->npwp) $legalitasDinamis[] = ['label' => 'NPWP', 'value' => $tentang->npwp];
                        if($tentang->nib) $legalitasDinamis[] = ['label' => 'NIB (Nomor Induk Berusaha)', 'value' => $tentang->nib];
                        if($tentang->kbli) $legalitasDinamis[] = ['label' => 'Kode KBLI', 'value' => $tentang->kbli];
                        if($tentang->siup_tanggal) $legalitasDinamis[] = ['label' => 'Tanggal SIUP/OSS', 'value' => $tentang->siup_tanggal];
                    }
                    if(empty($legalitasDinamis)) {
                        $legalitasDinamis[] = ['label' => '', 'value' => ''];
                    }
                @endphp
                
                @foreach($legalitasDinamis as $idx => $leg)
                <div class="row g-2 align-items-end legalitas-row mb-3">
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:0.8rem;color:#64748b;margin-bottom:4px;">Label (Contoh: NPWP)</label>
                        <input type="text" name="legalitas_dinamis_label[]" class="form-control-admin" placeholder="Nama Dokumen" value="{{ $leg['label'] }}">
                    </div>
                    <div class="col-md-7">
                        <label class="form-label" style="font-size:0.8rem;color:#64748b;margin-bottom:4px;">Isi / Nilai Dokumen</label>
                        <input type="text" name="legalitas_dinamis_value[]" class="form-control-admin" placeholder="31.315.457.7-517.000" value="{{ $leg['value'] }}">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-danger w-100 btn-remove-legalitas" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Keanggotaan --}}
            <div class="d-flex justify-content-between align-items-center" style="border-bottom:1px solid #f1f5f9;margin-bottom:14px;padding-bottom:6px;">
                <div style="font-size:0.72rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#94a3b8;">
                    Keanggotaan
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary" id="btnAddKeanggotaan" style="font-size:0.75rem;padding:4px 10px;">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Keanggotaan
                </button>
            </div>
            <div id="keanggotaan-container" class="mb-4">
                @php
                    $keanggotaanDinamis = $tentang->keanggotaan_dinamis ?? [];
                    // Fallback to static fields if JSON is empty (Migration compatibility)
                    if (empty($keanggotaanDinamis) && ($tentang->kadin_nomor || $tentang->inkindo_nomor)) {
                        if($tentang->kadin_nomor) {
                            $kadinValue = 'Nomor: ' . $tentang->kadin_nomor;
                            if($tentang->kadin_berlaku) $kadinValue .= ' | Berlaku s/d: ' . $tentang->kadin_berlaku;
                            $keanggotaanDinamis[] = ['label' => 'KADIN', 'value' => $kadinValue];
                        }
                        if($tentang->inkindo_nomor) {
                            $inkindoValue = 'Nomor: ' . $tentang->inkindo_nomor;
                            if($tentang->inkindo_berlaku) $inkindoValue .= ' | Berlaku s/d: ' . $tentang->inkindo_berlaku;
                            $keanggotaanDinamis[] = ['label' => 'INKINDO', 'value' => $inkindoValue];
                        }
                    }
                    if(empty($keanggotaanDinamis)) {
                        $keanggotaanDinamis[] = ['label' => '', 'value' => ''];
                    }
                @endphp
                
                @foreach($keanggotaanDinamis as $idx => $anggota)
                <div class="row g-2 align-items-end keanggotaan-row mb-3">
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:0.8rem;color:#64748b;margin-bottom:4px;">Nama Organisasi / Asosiasi</label>
                        <input type="text" name="keanggotaan_dinamis_label[]" class="form-control-admin" placeholder="Contoh: KADIN" value="{{ $anggota['label'] }}">
                    </div>
                    <div class="col-md-7">
                        <label class="form-label" style="font-size:0.8rem;color:#64748b;margin-bottom:4px;">Detail Keanggotaan (Nomor / Masa Berlaku)</label>
                        <input type="text" name="keanggotaan_dinamis_value[]" class="form-control-admin" placeholder="Nomor: ..., Berlaku: ..." value="{{ $anggota['value'] }}">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-danger w-100 btn-remove-keanggotaan" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- VISI MISI --}}
    <div class="admin-card mb-4">
        <div class="admin-card-header">
            <h5><i class="bi bi-bullseye me-2 text-primary"></i>Visi & Misi</h5>
        </div>
        <div class="admin-card-body p-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Visi</label>
                        <textarea name="visi" rows="5"
                            class="form-control-admin tinymce-editor @error('visi') is-invalid @enderror"
                            placeholder="Visi perusahaan...">{{ old('visi', $tentang->visi ?? '') }}</textarea>
                        @error('visi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label>Misi</label>
                        <textarea name="misi" rows="5"
                            class="form-control-admin tinymce-editor @error('misi') is-invalid @enderror"
                            placeholder="Misi perusahaan (pisahkan tiap poin dengan baris baru)...">{{ old('misi', $tentang->misi ?? '') }}</textarea>
                        @error('misi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- KONTAK --}}
    <div class="admin-card mb-4">
        <div class="admin-card-header">
            <h5><i class="bi bi-telephone me-2 text-primary"></i>Informasi Kontak</h5>
        </div>
        <div class="admin-card-body p-4">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Alamat</label>
                        <textarea name="alamat" rows="3"
                            class="form-control-admin @error('alamat') is-invalid @enderror"
                            placeholder="Alamat lengkap kantor...">{{ old('alamat', $tentang->alamat ?? '') }}</textarea>
                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Nomor Telepon</label>
                        <div style="position:relative;">
                            <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;"><i class="bi bi-telephone"></i></span>
                            <input type="text" name="telepon"
                                class="form-control-admin @error('telepon') is-invalid @enderror"
                                style="padding-left:36px;"
                                value="{{ old('telepon', $tentang->telepon ?? '') }}"
                                placeholder="+62-24-6705577">
                        </div>
                        @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Nomor Fax</label>
                        <div style="position:relative;">
                            <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;"><i class="bi bi-printer"></i></span>
                            <input type="text" name="fax"
                                class="form-control-admin @error('fax') is-invalid @enderror"
                                style="padding-left:36px;"
                                value="{{ old('fax', $tentang->fax ?? '') }}"
                                placeholder="+62-24-6701321">
                        </div>
                        @error('fax')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-admin">
                        <label>Email</label>
                        <div style="position:relative;">
                            <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email"
                                class="form-control-admin @error('email') is-invalid @enderror"
                                style="padding-left:36px;"
                                value="{{ old('email', $tentang->email ?? '') }}"
                                placeholder="icde.semarang@gmail.com">
                        </div>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MEDIA --}}
    <div class="admin-card mb-4">
        <div class="admin-card-header">
            <h5><i class="bi bi-image me-2 text-primary"></i>Media & Gambar</h5>
        </div>
        <div class="admin-card-body p-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="form-group-admin">
                        <label>Gambar Utama (Profil Perusahaan)</label>
                        <input type="file" name="gambar" class="form-control-admin @error('gambar') is-invalid @enderror"
                            accept="image/*" onchange="previewImg(this,'prevGambar','prevGambarWrap')">
                        @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div style="font-size:0.78rem;color:#94a3b8;margin-top:4px;">Tampil sebagai header di halaman Tentang Kami. Format: JPG, PNG. Maks 2MB.</div>
                        <div id="prevGambarWrap" class="mt-3" style="{{ $tentang->gambar ? '' : 'display:none;' }}">
                            <div style="font-size:0.75rem;color:#94a3b8;margin-bottom:6px;">{{ $tentang->gambar ? 'Gambar saat ini:' : 'Preview:' }}</div>
                            <img id="prevGambar" src="{{ $tentang->gambar ? asset('storage/'.$tentang->gambar) : '' }}"
                                style="max-height:180px;width:100%;object-fit:cover;border-radius:10px;border:1.5px solid #e2e8f0;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SAVE --}}
    <div class="form-actions-admin">
        <button type="submit" class="btn-admin btn-primary-admin">
            <i class="bi bi-save-fill me-2"></i>Simpan Perubahan
        </button>
        <a href="{{ route('tentang-kami') }}" target="_blank" class="btn-admin btn-light-admin">
            <i class="bi bi-box-arrow-up-right me-1"></i>Lihat di Website
        </a>
    </div>

</form>

@endsection

@push('scripts')
<script>
function previewImg(input, imgId, wrapId) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById(imgId).src = e.target.result;
        document.getElementById(wrapId).style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}

document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('legalitas-container');
    const btnAdd = document.getElementById('btnAddLegalitas');

    btnAdd.addEventListener('click', function() {
        const row = document.createElement('div');
        row.className = 'row g-2 align-items-end legalitas-row mb-3';
        row.innerHTML = `
            <div class="col-md-4">
                <label class="form-label" style="font-size:0.8rem;color:#64748b;margin-bottom:4px;">Label (Contoh: NPWP)</label>
                <input type="text" name="legalitas_dinamis_label[]" class="form-control-admin" placeholder="Nama Dokumen" value="">
            </div>
            <div class="col-md-7">
                <label class="form-label" style="font-size:0.8rem;color:#64748b;margin-bottom:4px;">Isi / Nilai Dokumen</label>
                <input type="text" name="legalitas_dinamis_value[]" class="form-control-admin" placeholder="Nilai Dokumen" value="">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-danger w-100 btn-remove-legalitas" title="Hapus">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
    });

    container.addEventListener('click', function(e) {
        if(e.target.closest('.btn-remove-legalitas')) {
            e.target.closest('.legalitas-row').remove();
        }
    });

    const kgnContainer = document.getElementById('keanggotaan-container');
    const btnAddKgn = document.getElementById('btnAddKeanggotaan');

    btnAddKgn.addEventListener('click', function() {
        const row = document.createElement('div');
        row.className = 'row g-2 align-items-end keanggotaan-row mb-3';
        row.innerHTML = `
            <div class="col-md-4">
                <label class="form-label" style="font-size:0.8rem;color:#64748b;margin-bottom:4px;">Nama Organisasi / Asosiasi</label>
                <input type="text" name="keanggotaan_dinamis_label[]" class="form-control-admin" placeholder="Contoh: KADIN" value="">
            </div>
            <div class="col-md-7">
                <label class="form-label" style="font-size:0.8rem;color:#64748b;margin-bottom:4px;">Detail Keanggotaan (Nomor / Masa Berlaku)</label>
                <input type="text" name="keanggotaan_dinamis_value[]" class="form-control-admin" placeholder="Nomor: ..., Berlaku: ..." value="">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-danger w-100 btn-remove-keanggotaan" title="Hapus">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        kgnContainer.appendChild(row);
    });

    kgnContainer.addEventListener('click', function(e) {
        if(e.target.closest('.btn-remove-keanggotaan')) {
            e.target.closest('.keanggotaan-row').remove();
        }
    });
});
</script>
@endpush

{{-- DELETE everything below (old form remnant) --}}
@if(false)
@endif
