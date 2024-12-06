<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::all(); // Ambil semua data pengguna
        return view('user.manage', compact('users'));
    }

    // Menampilkan form untuk tambah pengguna
    public function create()
    {
        return view('user.create'); // Form untuk tambah pengguna
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:user,owner', // Validasi role
            'password' => 'required|confirmed|min:8', // Validasi password
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']), // Hash password
        ]);

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // Menampilkan form untuk edit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari pengguna berdasarkan ID
        return view('user.edit', compact('user')); // Form edit pengguna
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Menjaga email tetap unik kecuali untuk pengguna yang sedang diedit
            'role' => 'required|in:user,owner',
            'password' => 'nullable|confirmed|min:8', // Password opsional, hanya jika diubah
        ]);

        $user = User::findOrFail($id); // Cari pengguna berdasarkan ID

        // Update data pengguna
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        // Update password jika ada perubahan
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']); // Hash password baru
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    // Menghapus data pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Cari pengguna berdasarkan ID
        $user->delete(); // Hapus data pengguna
        return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus!');
    }
    public function show($id)
    {
        $user = User::findOrFail($id); // Ambil pengguna berdasarkan ID
        return view('user.show', compact('user')); // Tampilkan data pengguna di view
    }
}
