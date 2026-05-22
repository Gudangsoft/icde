@extends('admin.layouts.app')
@section('title', $pengguna ? 'Edit Pengguna' : 'Tambah Pengguna')
@section('page_title', $pengguna ? 'Edit Pengguna' : 'Tambah Pengguna')

@section('content')
<div class="admin-card" style="max-width:600px;">
    <div class="admin-card-header">
        <h5><i class="bi bi-person-fill me-2" style="color:var(--icde-primary);"></i>
            {{ $pengguna ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}
        </h5>
    </div>
    <div class="p-4">
        <form method="POST" action="{{ $pengguna ? route('admin.pengguna.update', $pengguna) : route('admin.pengguna.store') }}">
            @csrf
            @if($pengguna) @method('PUT') @endif

            @if($errors->any())
            <div class="alert-danger-admin mb-4">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row g-3">
                <div class="col-12 form-group-admin">
                    <label>Nama Lengkap <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" class="form-control-admin {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           value="{{ old('name', $pengguna?->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 form-group-admin">
                    <label>Email <span style="color:#ef4444;">*</span></label>
                    <input type="email" name="email" class="form-control-admin {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           value="{{ old('email', $pengguna?->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 form-group-admin">
                    <label>Role <span style="color:#ef4444;">*</span></label>
                    <select name="role" class="form-control-admin {{ $errors->has('role') ? 'is-invalid' : '' }}"
                            {{ ($pengguna && $pengguna->id === Auth::id()) ? 'disabled' : '' }}>
                        <option value="admin"   {{ old('role', $pengguna?->role) === 'admin'  ? 'selected' : '' }}>Administrator</option>
                        <option value="viewer"  {{ old('role', $pengguna?->role) === 'viewer' ? 'selected' : '' }}>Viewer (Hanya lihat dashboard)</option>
                    </select>
                    @if($pengguna && $pengguna->id === Auth::id())
                    <input type="hidden" name="role" value="{{ $pengguna->role }}">
                    <div class="field-hint">Role tidak dapat diubah untuk akun sendiri.</div>
                    @endif
                    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 form-group-admin">
                    <label>Password {{ $pengguna ? '(kosongkan jika tidak ingin diubah)' : '' }} <span style="color:#ef4444;">{{ $pengguna ? '' : '*' }}</span></label>
                    <input type="password" name="password" class="form-control-admin {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           {{ $pengguna ? '' : 'required' }} minlength="8" autocomplete="new-password">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 form-group-admin">
                    <label>Konfirmasi Password {{ $pengguna ? '' : '<span style="color:#ef4444;">*</span>' }}</label>
                    <input type="password" name="password_confirmation" class="form-control-admin"
                           {{ $pengguna ? '' : 'required' }} minlength="8" autocomplete="new-password">
                </div>
            </div>

            <div class="form-actions-admin">
                <button type="submit" class="btn-admin btn-primary-admin">
                    <i class="bi bi-save me-1"></i> {{ $pengguna ? 'Simpan Perubahan' : 'Tambah Pengguna' }}
                </button>
                <a href="{{ route('admin.pengguna.index') }}" class="btn-admin btn-light-admin">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
