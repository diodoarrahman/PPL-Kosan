<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kosan;

class OwnerController extends Controller
{
    public function index()
    {
        return view('dashboard.owner');
    }
    public function ownerDashboard()
    {
        $kosans = Kosan::where('user_id', auth()->user()->id)->get();

        $totalKosan = $kosans->count();
        $totalKamar = $kosans->sum('kamar_tersedia');
        $totalPendapatan = $kosans->sum('harga_kosan'); // Atur sesuai logika pendapatan

        return view('dashboard.owner', compact('kosans', 'totalKosan', 'totalKamar', 'totalPendapatan'));
    }
}
