<?php
namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Kosan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();
        return view('favorite.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kosan_id' => 'required|exists:kosans,id', // Menambahkan validasi "exists"
        ]);

        Favorite::create([
            'user_id' => Auth::id(),
            'kosan_id' => $request->kosan_id,
        ]);

        return redirect()->route('favorite.index')->with('success', 'Kosan favorit ditambahkan ke favorite');
    }
}
