<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('admin_super.user.index', compact('users'));  // Sesuaikan dengan folder yang benar
    }

    // Menampilkan form tambah user
    public function create()
    {
        return view('admin_super.user.create');  // Sesuaikan dengan folder yang benar
    }

    // Simpan data user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
            'kode' => 'nullable|string|max:50',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin_super.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Menampilkan detail user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin_super.user.show', compact('user'));  // Sesuaikan dengan folder yang benar
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin_super.user.edit', compact('user'));  // Sesuaikan dengan folder yang benar
    }

    // Update data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string',
            'kode' => 'nullable|string|max:50',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin_super.user.index')->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin_super.user.index')->with('success', 'User berhasil dihapus.');
    }
}
