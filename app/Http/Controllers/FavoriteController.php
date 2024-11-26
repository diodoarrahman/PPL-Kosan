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
        // Validasi input kosan_id
        $request->validate([
            'kosan_id' => 'required|exists:kosans,id',
        ]);
    
        // Cek apakah kosan sudah ada di favorit
        $existingFavorite = Favorite::where('user_id', Auth::id())
            ->where('kosan_id', $request->kosan_id)
            ->first();
    
        if ($existingFavorite) {
            // Kirim session error jika kosan sudah ada di favorit
            session()->flash('error', 'Kosan ini sudah ada di daftar favorit.');
            return response()->json(['status' => 'error']);
        }
    
        // Tambahkan ke favorit
        Favorite::create([
            'user_id' => Auth::id(),
            'kosan_id' => $request->kosan_id,
        ]);
    
        // Kirim session sukses jika berhasil ditambahkan
        session()->flash('success', 'Kosan berhasil ditambahkan ke favorit!');
        return response()->json(['status' => 'success']);
    }
    

    /**
     * Menghapus kosan dari daftar favorit.
     */

    public function destroy($kosanId)
    {
        $favorite = Favorite::where('kosan_id', $kosanId)
            ->where('user_id', Auth::id())
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error']);
    }
}
