<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kosan;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

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

        // Inisialisasi variabel untuk total pendapatan dan total kamar disewakan
        $totalPendapatan = 0;
        $totalKamarDisewakan = 0;

        // Loop untuk setiap kosan milik owner
        foreach ($kosans as $kosan) {
            // Ambil transaksi yang statusnya 'Lunas'
            $transaksi = $kosan->transactions()->where('status', 'Lunas')->get();

            // Hitung pendapatan dan jumlah kamar disewakan untuk masing-masing kosan
            $kamarDisewakanPerKosan = 0;  // Inisialisasi untuk jumlah kamar disewakan per kosan
            $pendapatanPerKosan = 0;  // Inisialisasi untuk pendapatan per kosan

            foreach ($transaksi as $transaction) {
                // Pendapatan per transaksi kosan
                $pendapatanPerKosan += $transaction->jumlah_transaksi * $kosan->harga_kosan;
                // Jumlah kamar disewakan per transaksi
                $kamarDisewakanPerKosan += $transaction->jumlah_transaksi;
            }

            // Simpan pendapatan dan kamar disewakan untuk setiap kosan
            $kosan->totalPendapatan = $pendapatanPerKosan;
            $kosan->kamarDisewakan = $kamarDisewakanPerKosan;

            // Tambahkan ke total pendapatan dan total kamar disewakan
            $totalPendapatan += $pendapatanPerKosan;
            $totalKamarDisewakan += $kamarDisewakanPerKosan;
        }

        // Kirim data ke view
        return view('dashboard.owner', compact('kosans', 'totalKosan', 'totalKamar', 'totalPendapatan', 'totalKamarDisewakan'));
    }

    public function adminDashboard()
    {
        $totalKosans = Kosan::count();
        $availableKosans = Kosan::where('kamar_tersedia', '>', 0)->count();
        $rentedKosans = $totalKosans - $availableKosans;

        $totalTransactions = Transaction::count();
        $totalOwners = User::where('role', 'owner')->count();
        $totalUsers = User::count();
        $transaction = Transaction::all();

        // Mengambil transaksi dan mengelompokkan berdasarkan bulan dan tahun
        $transactionsPerMonth = Transaction::selectRaw('YEAR(transaction_date) as year, MONTH(transaction_date) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get(); // Pastikan menggunakan `get()` agar menjadi koleksi Eloquent

        // Menyiapkan data untuk chart
        $transactionData = $transactionsPerMonth->map(function ($transaction) {
            // Format bulan dan tahun untuk label
            $label = Carbon::createFromDate($transaction->year, $transaction->month, 1)->format('F Y');
            return [
                'label' => $label,
                'count' => $transaction->count,
            ];
        });

        // Kirim data ke view
        return view('dashboard.admin', [
            'totalKosans' => $totalKosans,
            'availableKosans' => $availableKosans,
            'rentedKosans' => $rentedKosans,
            'totalTransactions' => $totalTransactions,
            'totalOwners' => $totalOwners,
            'totalUsers' => $totalUsers,
            'kosans' => Kosan::all(),
            'transactionsdata' => $transactionData, // Kirim transaksi per bulan ke view
            'transactions' => $transaction,
            'owners' => User::whereHas('kosans')->get(),
            'users' => User::all(),
        ]);
    }
}
