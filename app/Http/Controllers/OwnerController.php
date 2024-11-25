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
        $jumlahKosanTerpesan = 0;
        $pendapatan = 0;
        $kosans = Kosan::where('user_id', auth()->user()->id)->get();

        foreach ($kosans as $kosan) {
            $transaksi = $kosan->transactions()->where('status', 'Selesai')->get();
            $jumlahTerpesan = $transaksi->sum('jumlah_transaksi');
            $pendapatan += $kosan->harga_kosan * $jumlahTerpesan;
            $jumlahKosanTerpesan += $jumlahTerpesan;
        }
        $totalPendapatan = $pendapatan;


        return view('dashboard.owner', compact('kosans', 'totalKosan', 'totalKamar', 'totalPendapatan'));
    }
}
