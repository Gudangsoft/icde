@extends('layouts.app')

@section('title', 'Kontak Kami - PT ICDE')

@push('styles')
<style>
    .contact-info-card {
        background: var(--icde-primary);
        border-radius: 16px;
        padding: 40px;
        color: #fff;
        height: 100%;
    }
    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 28px;
    }
    .contact-icon {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: rgba(255,255,255,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .contact-info-item h6 { font-weight: 800; font-size: 1.1rem; margin-bottom: 4px; }
    .contact-info-item p { margin: 0; opacity: 0.95; font-size: 0.95rem; line-height: 1.6; font-weight: 500; }
    .form-icde .form-control,
    .form-icde .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 1rem;
        font-weight: 500;
        transition: border-color 0.3s;
    }
    .form-icde .form-control:focus,
    .form-icde .form-select:focus {
        border-color: var(--icde-primary);
        box-shadow: 0 0 0 3px rgba(27,108,168,0.1);
    }
    .form-icde label {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--icde-navy-dark);
        margin-bottom: 6px;
    }
    .map-container {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1 data-aos="fade-right">Kontak Kami</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Kontak Kami</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <!-- Info Kontak -->
            <div class="col-lg-4" data-aos="fade-right">
                <div class="contact-info-card">
                    <h3 style="font-weight:900;margin-bottom:12px;font-size:2rem;">Hubungi Kami</h3>
                    <p style="opacity:0.95;margin-bottom:35px;font-size:1.05rem;font-weight:500;">Kami siap membantu Anda. Jangan ragu untuk menghubungi tim kami.</p>

                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <h6>Alamat Kantor</h6>
                            <p>Bumi Wanamukti Blok A4 No.27, Kel. Sambiroto, Kec. Tembalang, Kota Semarang 50276</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <h6>Telepon & Fax</h6>
                            <p>Tel: +62-24-6705577<br>Fax: +62-24-6701321</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <h6>Email</h6>
                            <p><a href="mailto:icde.semarang@gmail.com" style="color:rgba(255,255,255,0.85);">icde.semarang@gmail.com</a></p>
                        </div>
                    </div>

                    <div class="contact-info-item mb-0">
                        <div class="contact-icon"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <h6>Jam Kerja</h6>
                            <p>Senin - Jumat: 08.00 - 17.00 WIB<br>Sabtu: 08.00 - 13.00 WIB</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-3" style="border-top:1px solid rgba(255,255,255,0.15);">
                        <p style="font-size:0.82rem;opacity:0.7;margin-bottom:12px;">Ikuti kami:</p>
                        <div class="d-flex gap-2">
                            <a href="#" style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;transition:all 0.3s;" onmouseover="this.style.background='rgba(255,166,35,0.7)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;transition:all 0.3s;" onmouseover="this.style.background='rgba(255,166,35,0.7)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;transition:all 0.3s;" onmouseover="this.style.background='rgba(255,166,35,0.7)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Kontak -->
            <div class="col-lg-8" data-aos="fade-left">
                <div style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); border-radius:16px; padding:40px; box-shadow:0 10px 30px rgba(234,88,12,0.25); color: #fff;">
                    <h3 style="font-weight:900; color:#fff; margin-bottom:12px; font-size:2rem;">Kirim Pesan</h3>
                    <p class="mb-4" style="font-size:1.05rem; font-weight:500; color:rgba(255,255,255,0.9)!important;">Isi formulir di bawah ini dan tim kami akan segera merespons pesan Anda.</p>

                    @if(session('sukses'))
                    <div class="alert" style="background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.3); border-radius:10px; color:#fff; padding:15px 20px; margin-bottom:25px; font-weight: 600;">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('sukses') }}
                    </div>
                    @endif

                    <form action="{{ route('kontak.kirim') }}" method="POST" class="form-icde" style="--form-label-color: #fff;">
                        @csrf
                        <style>
                            .form-icde label { color: var(--form-label-color, #fff) !important; }
                            .form-icde .form-control, .form-icde .form-select { 
                                border: none; 
                                box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
                            }
                            .form-icde .form-control:focus, .form-icde .form-select:focus { 
                                box-shadow: 0 0 0 4px rgba(255,255,255,0.3); 
                            }
                            .btn-contact-submit {
                                background: #fff;
                                color: #ea580c;
                                font-weight: 800;
                                border: none;
                                border-radius: 8px;
                                transition: all 0.3s;
                            }
                            .btn-contact-submit:hover {
                                background: #fff7ed;
                                transform: translateY(-2px);
                                box-shadow: 0 6px 15px rgba(0,0,0,0.1);
                            }
                        </style>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="nama">Nama Lengkap <span style="color:yellow;">*</span></label>
                                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                                @error('nama')
                                <div class="invalid-feedback" style="color:yellow;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email <span style="color:yellow;">*</span></label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="email@contoh.com" required>
                                @error('email')
                                <div class="invalid-feedback" style="color:yellow;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="telepon">Nomor Telepon</label>
                                <input type="tel" id="telepon" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                                    value="{{ old('telepon') }}" placeholder="+62-xxx-xxxx-xxxx">
                                @error('telepon')
                                <div class="invalid-feedback" style="color:yellow;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="subjek">Subjek</label>
                                <select id="subjek" name="subjek" class="form-select @error('subjek') is-invalid @enderror">
                                    <option value="">-- Pilih Subjek --</option>
                                    <option value="Konsultasi Layanan" {{ old('subjek') == 'Konsultasi Layanan' ? 'selected' : '' }}>Konsultasi Layanan</option>
                                    <option value="Permintaan Penawaran" {{ old('subjek') == 'Permintaan Penawaran' ? 'selected' : '' }}>Permintaan Penawaran</option>
                                    <option value="Kerjasama" {{ old('subjek') == 'Kerjasama' ? 'selected' : '' }}>Kerjasama / Kemitraan</option>
                                    <option value="Informasi Umum" {{ old('subjek') == 'Informasi Umum' ? 'selected' : '' }}>Informasi Umum</option>
                                    <option value="Lainnya" {{ old('subjek') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('subjek')
                                <div class="invalid-feedback" style="color:yellow;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="pesan">Pesan <span style="color:yellow;">*</span></label>
                                <textarea id="pesan" name="pesan" rows="6" class="form-control @error('pesan') is-invalid @enderror"
                                    placeholder="Tuliskan pesan atau pertanyaan Anda di sini..." required>{{ old('pesan') }}</textarea>
                                @error('pesan')
                                <div class="invalid-feedback" style="color:yellow;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="w-100 btn-contact-submit" style="font-size:1.05rem;padding:14px;">
                                    <i class="bi bi-send-fill me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
