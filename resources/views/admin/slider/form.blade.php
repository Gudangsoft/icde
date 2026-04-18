@extends('admin.layouts.app')
@section('title', $slider->exists ? 'Edit Slide' : 'Tambah Slide')
@section('page_title', 'Slider / Banner')

@section('content')
<div class="row g-4">

    {{-- Form --}}
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="bi bi-images me-2" style="color:#1B6CA8;"></i>{{ $slider->exists ? 'Edit Slide' : 'Tambah Slide Baru' }}</h5>
                <a href="{{ route('admin.slider.index') }}" class="btn-admin btn-light-admin">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="admin-card-body p-4">
                @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <form action="{{ $slider->exists ? route('admin.slider.update', $slider) : route('admin.slider.store') }}"
                      method="POST" enctype="multipart/form-data" id="sliderForm">
                    @csrf
                    @if($slider->exists) @method('PUT') @endif

                    <div class="row g-4">

                        {{-- TOGGLE: Hanya Gambar --}}
                        <div class="col-12">
                            <div style="background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:10px;padding:14px 18px;display:flex;align-items:center;justify-content:space-between;gap:12px;">
                                <div>
                                    <div style="font-weight:700;font-size:0.87rem;color:#1e293b;">
                                        <i class="bi bi-image-fill me-2" style="color:#1B6CA8;"></i>Mode Hanya Gambar
                                    </div>
                                    <div style="font-size:0.76rem;color:#64748b;margin-top:2px;">Aktifkan jika slide ini hanya berisi gambar tanpa teks, judul, atau tombol</div>
                                </div>
                                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;flex-shrink:0;">
                                    <input type="hidden" name="hanya_gambar" value="0">
                                    <input type="checkbox" name="hanya_gambar" value="1" id="toggleHanyaGambar"
                                        onchange="toggleModeGambar(this)"
                                        {{ old('hanya_gambar', $slider->hanya_gambar ?? false) ? 'checked' : '' }}
                                        style="width:20px;height:20px;accent-color:#1B6CA8;cursor:pointer;">
                                    <span style="font-weight:700;font-size:0.85rem;color:#1B6CA8;">Aktifkan</span>
                                </label>
                            </div>
                        </div>

                        {{-- Kolom teks (disembunyikan saat hanya gambar) --}}
                        <div id="fieldsTeks">
                        <div class="row g-4 px-2">
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Judul Slide <span class="text-danger" id="judulRequired">*</span></label>
                                <input type="text" name="judul" id="inputJudul"
                                    class="form-control-admin @error('judul') is-invalid @enderror"
                                    value="{{ old('judul', $slider->judul ?? '') }}"
                                    placeholder="Contoh: Solusi Konsultansi Teknik Terpercaya"
                                    oninput="updatePreview()">
                                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Subjudul / Keterangan Singkat</label>
                                <input type="text" name="subjudul" id="inputSubjudul"
                                    class="form-control-admin"
                                    value="{{ old('subjudul', $slider->subjudul ?? '') }}"
                                    placeholder="Contoh: PT Integrated Civil & Development Engineering"
                                    oninput="updatePreview()">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" id="inputDeskripsi" class="form-control-admin" rows="3"
                                    placeholder="Teks pendukung yang muncul di bawah judul..."
                                    oninput="updatePreview()">{{ old('deskripsi', $slider->deskripsi ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group-admin">
                                <label>Teks Tombol</label>
                                <input type="text" name="teks_tombol" id="inputTombol"
                                    class="form-control-admin"
                                    value="{{ old('teks_tombol', $slider->teks_tombol ?? 'Selengkapnya') }}"
                                    placeholder="Selengkapnya"
                                    oninput="updatePreview()">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group-admin">
                                <label>Link Tombol <small style="color:#94a3b8;">(URL tujuan tombol)</small></label>
                                <input type="text" name="link_tombol" class="form-control-admin"
                                    value="{{ old('link_tombol', $slider->link_tombol ?? '') }}"
                                    placeholder="/lingkup-layanan atau https://...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label>Warna Teks</label>
                                <select name="warna_teks" id="inputWarna" class="form-control-admin" onchange="updatePreview()">
                                    <option value="light" {{ old('warna_teks', $slider->warna_teks ?? 'light') === 'light' ? 'selected' : '' }}>Terang (Putih) — untuk foto gelap</option>
                                    <option value="dark"  {{ old('warna_teks', $slider->warna_teks ?? 'light') === 'dark'  ? 'selected' : '' }}>Gelap (Hitam) — untuk foto cerah</option>
                                </select>
                            </div>
                        </div>
                        </div>{{-- end row inside fieldsTeks --}}
                        </div>{{-- end #fieldsTeks --}}
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label>Urutan <span class="text-danger">*</span></label>
                                <input type="number" name="urutan" class="form-control-admin" min="1"
                                    value="{{ old('urutan', $slider->urutan ?? 1) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label>Status</label>
                                <div style="display:flex;align-items:center;gap:10px;padding:10px 0;">
                                    <label class="form-check-label" style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:600;font-size:0.87rem;">
                                        <input type="hidden" name="aktif" value="0">
                                        <input type="checkbox" name="aktif" value="1" class="form-check-input" style="width:18px;height:18px;cursor:pointer;"
                                            {{ old('aktif', $slider->aktif ?? true) ? 'checked' : '' }}>
                                        Slide Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label>Gambar Slide <small style="color:#94a3b8;">— Rekomendasi ukuran 1920×700px (JPG/PNG/WebP, maks. 3MB)</small></label>
                                <input type="file" name="gambar" class="form-control-admin" accept="image/jpg,image/jpeg,image/png,image/webp"
                                    id="gambarInput" onchange="previewGambar(this)">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions-admin">
                        <button type="submit" class="btn-admin btn-primary-admin">
                            <i class="bi bi-save-fill me-1"></i>{{ $slider->exists ? 'Simpan Perubahan' : 'Tambah Slide' }}
                        </button>
                        <a href="{{ route('admin.slider.index') }}" class="btn-admin btn-light-admin">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Live Preview --}}
    <div class="col-lg-4">
        <div style="position:sticky;top:80px;">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5><i class="bi bi-eye me-2"></i>Preview Slide</h5>
                </div>
                <div style="padding:16px;">
                    <div id="slidePreview" style="border-radius:12px;overflow:hidden;aspect-ratio:16/7;position:relative;background:linear-gradient(135deg,#0f172a,#1B6CA8);">
                        @if($slider->exists && $slider->gambar)
                        <img id="previewImg" src="{{ asset('storage/'.$slider->gambar) }}"
                            style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;opacity:0.65;">
                        @else
                        <img id="previewImg" src="" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;opacity:0.65;display:none;">
                        @endif
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.65) 0%,rgba(0,0,0,0.2) 50%,transparent 100%);"></div>
                        <div id="previewTextOverlay" style="position:absolute;inset:0;display:flex;flex-direction:column;justify-content:flex-end;padding:18px;">
                            <div id="prevSubjudul" style="font-size:0.7rem;font-weight:600;color:rgba(255,255,255,0.75);margin-bottom:4px;text-transform:uppercase;letter-spacing:.05em;">
                                {{ $slider->subjudul ?? '' }}
                            </div>
                            <div id="prevJudul" style="font-size:1rem;font-weight:800;color:#fff;line-height:1.3;margin-bottom:6px;">
                                {{ $slider->judul ?? 'Judul Slide' }}
                            </div>
                            <div id="prevDeskripsi" style="font-size:0.72rem;color:rgba(255,255,255,0.8);line-height:1.5;margin-bottom:10px;display:{{ empty($slider->deskripsi) ? 'none' : 'block' }}">
                                {{ Str::limit($slider->deskripsi ?? '', 90) }}
                            </div>
                            <div>
                                <span id="prevTombol" style="background:#F5A623;color:#fff;font-size:0.72rem;font-weight:700;padding:5px 14px;border-radius:20px;display:inline-block;">
                                    {{ $slider->teks_tombol ?? 'Selengkapnya' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <p style="font-size:0.75rem;color:#94a3b8;text-align:center;margin-top:10px;">
                        <i class="bi bi-info-circle me-1"></i>Preview diperbarui secara langsung saat Anda mengetik.
                    </p>
                </div>
            </div>

            @if($slider->exists && $slider->gambar)
            <div class="admin-card mt-3">
                <div class="admin-card-header"><h5>Gambar Saat Ini</h5></div>
                <div style="padding:12px;">
                    <img src="{{ asset('storage/'.$slider->gambar) }}" style="width:100%;border-radius:8px;max-height:130px;object-fit:cover;">
                </div>
            </div>
            @endif
        </div>
    </div>

</div>

@push('scripts')
<script>
function updatePreview() {
    const judul     = document.getElementById('inputJudul')?.value || '';
    const subjudul  = document.getElementById('inputSubjudul')?.value || '';
    const deskripsi = document.getElementById('inputDeskripsi')?.value || '';
    const tombol    = document.getElementById('inputTombol')?.value || 'Selengkapnya';
    const warna     = document.getElementById('inputWarna')?.value || 'light';

    document.getElementById('prevJudul').textContent     = judul || 'Judul Slide';
    document.getElementById('prevSubjudul').textContent  = subjudul;
    document.getElementById('prevTombol').textContent    = tombol || 'Selengkapnya';

    const deskEl = document.getElementById('prevDeskripsi');
    deskEl.textContent = deskripsi.substring(0, 90) + (deskripsi.length > 90 ? '…' : '');
    deskEl.style.display = deskripsi ? 'block' : 'none';

    // Warna teks
    const textColor = warna === 'dark' ? '#1e293b' : '#fff';
    document.getElementById('prevJudul').style.color    = textColor;
    document.getElementById('prevSubjudul').style.color = warna === 'dark' ? '#374151' : 'rgba(255,255,255,0.75)';
    document.getElementById('prevDeskripsi').style.color= warna === 'dark' ? '#374151' : 'rgba(255,255,255,0.8)';
}

function previewGambar(input) {
    const img = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function toggleModeGambar(cb) {
    const fields = document.getElementById('fieldsTeks');
    const previewOverlay = document.getElementById('previewTextOverlay');
    if (cb.checked) {
        fields.style.display = 'none';
        if (previewOverlay) previewOverlay.style.display = 'none';
    } else {
        fields.style.display = 'block';
        if (previewOverlay) previewOverlay.style.display = 'flex';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const cb = document.getElementById('toggleHanyaGambar');
    if (cb && cb.checked) {
        document.getElementById('fieldsTeks').style.display = 'none';
        const previewOverlay = document.getElementById('previewTextOverlay');
        if (previewOverlay) previewOverlay.style.display = 'none';
    }
});
</script>
@endpush
@endsection
