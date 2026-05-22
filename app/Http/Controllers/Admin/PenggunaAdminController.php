<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenggunaAdminController extends Controller
{
    public function index()
    {
        $pengguna = User::orderBy('name')->paginate(20);
        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('admin.pengguna.form', ['pengguna' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,viewer',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.pengguna.index')
            ->with('sukses', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $pengguna)
    {
        return view('admin.pengguna.form', compact('pengguna'));
    }

    public function update(Request $request, User $pengguna)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore($pengguna->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'required|in:admin,viewer',
        ]);

        // Prevent current user from downgrading their own role
        if ($pengguna->id === Auth::id() && $request->role !== 'admin') {
            return back()->withErrors(['role' => 'Anda tidak dapat mengubah role akun sendiri.']);
        }

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pengguna->update($data);

        return redirect()->route('admin.pengguna.index')
            ->with('sukses', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $pengguna)
    {
        if ($pengguna->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $pengguna->delete();

        return back()->with('sukses', 'Pengguna berhasil dihapus.');
    }
}
