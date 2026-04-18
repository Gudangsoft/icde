@extends('admin.layouts.app')
@section('title', 'Detail Pesan')
@section('page_title', 'Detail Pesan')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="bi bi-envelope-open-fill me-2"></i>Isi Pesan</h5>
                <a href="{{ route('admin.kontak.index') }}" class="btn-admin btn-light-admin">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="admin-card-body">
                <div style="background: linear-gradient(135deg, #eff6ff, #fff);border-radius:14px;padding:24px 28px;margin-bottom:20px;border:1px solid #e0eeff;">
                    <div style="font-size:0.72rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Subjek</div>
                    <div style="font-size:1.1rem;font-weight:700;color:#1e293b;margin-top:4px;">{{ $pesan->subjek ?? 'Tidak ada subjek' }}</div>
                </div>
                <div style="background:#f8fafc;border-radius:14px;padding:24px 28px;border:1px solid #e2e8f0;min-height:180px;">
                    <div style="font-size:0.72rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;margin-bottom:12px;">Pesan</div>
                    <div style="color:#374151;line-height:1.75;white-space:pre-wrap;">{{ $pesan->pesan }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h5><i class="bi bi-person-fill me-2"></i>Info Pengirim</h5>
            </div>
            <div style="padding:20px;">
                <div class="mb-3">
                    <div style="font-size:0.72rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Nama</div>
                    <div style="font-weight:700;color:#1e293b;margin-top:3px;">{{ $pesan->nama }}</div>
                </div>
                <div class="mb-3">
                    <div style="font-size:0.72rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Email</div>
                    <a href="mailto:{{ $pesan->email }}" style="color:#1B6CA8;font-weight:600;text-decoration:none;">{{ $pesan->email }}</a>
                </div>
                @if($pesan->telepon)
                <div class="mb-3">
                    <div style="font-size:0.72rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Telepon</div>
                    <a href="tel:{{ $pesan->telepon }}" style="color:#1B6CA8;font-weight:600;text-decoration:none;">{{ $pesan->telepon }}</a>
                </div>
                @endif
                @if($pesan->perusahaan)
                <div class="mb-3">
                    <div style="font-size:0.72rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Perusahaan</div>
                    <div style="font-weight:600;color:#374151;margin-top:3px;">{{ $pesan->perusahaan }}</div>
                </div>
                @endif
                <div>
                    <div style="font-size:0.72rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;">Diterima</div>
                    <div style="font-weight:600;color:#374151;margin-top:3px;">{{ $pesan->created_at->format('d M Y, H:i') }}</div>
                    <div style="font-size:0.78rem;color:#94a3b8;">{{ $pesan->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div style="padding:16px;">
                <a href="mailto:{{ $pesan->email }}?subject=Re: {{ urlencode($pesan->subjek ?? 'Balasan Pesan') }}"
                   class="btn-admin btn-primary-admin" style="width:100%;justify-content:center;margin-bottom:10px;">
                    <i class="bi bi-reply-fill me-2"></i>Balas via Email
                </a>
                <form action="{{ route('admin.kontak.destroy', $pesan) }}" method="POST" onsubmit="return confirm('Yakin hapus pesan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-admin" style="width:100%;justify-content:center;background:#fee2e2;color:#ef4444;border:none;">
                        <i class="bi bi-trash-fill me-2"></i>Hapus Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
