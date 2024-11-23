<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Kosan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Menampilkan daftar kosan favorit milik pengguna.
     */
    public function index()
    {
        // Ambil data favorit berdasarkan user yang sedang login
        $favorites = Favorite::where('user_id', Auth::id())->with('kosan')->get();

        // Tampilkan view dengan data favorit
        return view('favorite.index', compact('favorites'));
    }

    /**
     * Menambahkan kosan ke daftar favorit.
     */
    public function store(Request $request)
    {
        // Validasi input kosan_id harus ada dan valid di tabel kosans
        $request->validate([
            'kosan_id' => 'required|exists:kosans,id',
        ]);

        // Periksa apakah kosan sudah ada di daftar favorit
        $existingFavorite = Favorite::where('user_id', Auth::id())
            ->where('kosan_id', $request->kosan_id)
            ->first();

        if ($existingFavorite) {
            return redirect()->route('favorite.index')->with('error', 'Kosan ini sudah ada di daftar favorit.');
        }

        // Tambahkan kosan ke favorit
        Favorite::create([
            'user_id' => Auth::id(),
            'kosan_id' => $request->kosan_id,
        ]);

        return redirect()->route('favorite.index')->with('success', 'Kosan berhasil ditambahkan ke favorit.');
    }

    /**
     * Menghapus kosan dari daftar favorit.
     */

}
