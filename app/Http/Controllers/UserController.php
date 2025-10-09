<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan semua pengguna.
     */
    public function index()
    {
        $users = User::orderBy('role')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Tampilkan form untuk membuat pengguna baru.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Simpan pengguna baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role'  => 'required|string|in:admin,petugas,siswa',
            'nis'   => 'nullable|string|unique:users,nis',
            'password' => 'nullable|string|min:6', // hanya dipakai kalau bukan siswa
        ]);

        if ($validated['role'] === 'siswa') {
            if (empty($validated['nis'])) {
                return back()
                    ->withErrors(['nis' => 'NIS wajib diisi untuk siswa'])
                    ->withInput();
            }
            $validated['password'] = Hash::make($validated['nis']);
        } else {
            if (empty($validated['password'])) {
                return back()
                    ->withErrors(['password' => 'Password wajib diisi untuk admin/petugas'])
                    ->withInput();
            }
            $validated['password'] = Hash::make($validated['password']);
        }

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail pengguna.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Tampilkan form untuk edit pengguna.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update data pengguna.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|string|in:admin,petugas,siswa',
            'nis'   => 'nullable|string|unique:users,nis,' . $user->id,
            'password' => 'nullable|string|min:6',
        ];

        $validated = $request->validate($rules);

        if ($validated['role'] === 'siswa') {
            if (empty($validated['nis'])) {
                return back()
                    ->withErrors(['nis' => 'NIS wajib diisi untuk siswa'])
                    ->withInput();
            }
            if (!empty($validated['nis'])) {
                $validated['password'] = Hash::make($validated['nis']);
            }
        } else {
            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']); // jangan update password kalau kosong
            }
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Hapus pengguna.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
