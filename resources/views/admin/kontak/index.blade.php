@extends('admin.layouts.app')
@section('title', 'Pesan Masuk')
@section('page_title', 'Kontak & Pesan')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-envelope-fill me-2"></i>Pesan Masuk ({{ $pesan->count() }})</h5>
        @if($pesanBaru > 0)
        <span style="background:#fee2e2;color:#ef4444;padding:4px 12px;border-radius:20px;font-size:0.78rem;font-weight:700;">
            {{ $pesanBaru }} belum dibaca
        </span>
        @endif
    </div>
    <div class="admin-card-body">
        <table class="table-admin table">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Nama Pengirim</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Subjek</th>
                    <th>Waktu</th>
                    <th width="110">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesan as $i => $item)
                <tr style="{{ !$item->sudah_dibaca ? 'background:#fffbeb;' : '' }}">
                    <td>
                        {{ $i + 1 }}
                        @if(!$item->sudah_dibaca)
                        <span style="display:inline-block;width:7px;height:7px;border-radius:50%;background:#ef4444;margin-left:3px;vertical-align:middle;"></span>
                        @endif
                    </td>
                    <td style="font-weight:{{ $item->sudah_dibaca ? '500' : '700' }};">{{ $item->nama }}</td>
                    <td style="font-size:0.83rem;">{{ $item->email }}</td>
                    <td style="font-size:0.83rem;">{{ $item->telepon ?? '—' }}</td>
                    <td style="font-size:0.83rem;">{{ $item->subjek ?? 'Tidak ada subjek' }}</td>
                    <td style="font-size:0.78rem;color:#94a3b8;white-space:nowrap;">{{ $item->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.kontak.show', $item) }}" class="btn-sm-admin btn-view"><i class="bi bi-eye"></i></a>
                            <form action="{{ route('admin.kontak.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm-admin btn-delete"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size:2.5rem;color:#e2e8f0;"></i>
                        <p class="mt-2 mb-0" style="color:#94a3b8;">Belum ada pesan masuk</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
