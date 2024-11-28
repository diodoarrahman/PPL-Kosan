<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profil.
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Memperbarui profil pengguna.
     */
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'gender' => 'required|string',
            'address' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk foto profil
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->address = $request->address;

        // Proses upload foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto profil lama jika ada
            if ($user->profile_photo) {
                Storage::delete($user->profile_photo);
            }

            // Simpan foto profil baru
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
