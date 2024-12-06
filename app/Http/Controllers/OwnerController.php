<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kosan;
use App\Models\Transaction;
use App\Models\User;

class OwnerController extends Controller
{
    public function ownerDashboard()
    {
        // Ambil semua kosan milik user yang sedang login
        $kosans = Kosan::where('user_id', auth()->user()->id)->get();

        // Hitung total kosan
        $totalKosan = $kosans->count();

        // Hitung total kamar tersedia
        $totalKamar = $kosans->sum('kamar_tersedia');

        // Hitung total pendapatan berdasarkan transaksi selesai
        $totalPendapatan = 0;
        $kamarDisewakan = 0; // Tambahkan variabel untuk jumlah kamar yang disewakan

        foreach ($kosans as $kosan) {
            $transaksi = $kosan->transactions()->where('status', 'Lunas')->get();

            // Hitung pendapatan
            $totalPendapatan += $transaksi->sum(function ($transaction) use ($kosan) {
                return $transaction->jumlah_transaksi * $kosan->harga_kosan;
            });

            // Hitung kamar yang sedang disewakan
            $kamarDisewakan += $transaksi->sum('jumlah_transaksi');
        }

        return view('dashboard.owner', compact('kosans', 'totalKosan', 'totalKamar', 'totalPendapatan', 'kamarDisewakan'));
    }
    public function adminDashboard()
    {
        $totalKosans = Kosan::count();
        $availableKosans = Kosan::where('kamar_tersedia', '>', 0)->count();
        $rentedKosans = $totalKosans - $availableKosans;

        $totalTransactions = Transaction::count();
        $totalOwners = User::where('role', 'owner')->count();
        $totalUsers = User::count();

        // Kirim data ke view
        return view('dashboard.admin', [
            'totalKosans' => $totalKosans,
            'availableKosans' => $availableKosans,
            'rentedKosans' => $rentedKosans,
            'totalTransactions' => $totalTransactions,
            'totalOwners' => $totalOwners,
            'totalUsers' => $totalUsers,
            'kosans' => Kosan::all(),
            'transactions' => Transaction::all(),
            'owners' => User::whereHas('kosans')->get(),
            'users' => User::all(),
        ]);
    }
}
