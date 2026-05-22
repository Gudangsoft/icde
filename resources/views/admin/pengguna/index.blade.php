@extends('admin.layouts.app')
@section('title', 'Pengguna')
@section('page_title', 'Manajemen Pengguna')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="bi bi-people-fill me-2" style="color:var(--icde-primary);"></i>Daftar Pengguna</h5>
        <a href="{{ route('admin.pengguna.create') }}" class="btn-admin btn-primary-admin" style="gap:6px;">
            <i class="bi bi-plus-lg"></i> Tambah Pengguna
        </a>
    </div>
    <div class="admin-card-body">
        <table class="table-admin table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengguna as $idx => $u)
                <tr>
                    <td style="color:#94a3b8;">{{ $pengguna->firstItem() + $idx }}</td>
                    <td>
                        <div style="font-weight:600;">{{ $u->name }}</div>
                        @if($u->id === Auth::id())
                        <div style="font-size:0.72rem;color:#94a3b8;">(Akun Anda)</div>
                        @endif
                    </td>
                    <td style="font-size:0.85rem;color:#475569;">{{ $u->email }}</td>
                    <td>
                        @if($u->role === 'admin')
                        <span class="badge-aktif" style="background:rgba(27,108,168,0.12);color:#1B6CA8;">Administrator</span>
                        @else
                        <span class="badge-nonaktif" style="background:rgba(245,158,11,0.12);color:#d97706;">Viewer</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.pengguna.edit', $u) }}" class="btn-sm-admin btn-edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @if($u->id !== Auth::id())
                            <form method="POST" action="{{ route('admin.pengguna.destroy', $u) }}" class="btn-delete-form">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm-admin btn-delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4" style="color:#94a3b8;">Belum ada pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($pengguna->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $pengguna->links() }}
</div>
@endif
@endsection
