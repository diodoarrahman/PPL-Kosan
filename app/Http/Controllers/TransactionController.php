<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Kosan; // Pastikan model Kosan diimport
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Menampilkan transaksi berdasarkan peran
    public function index()
    {
        // Jika user adalah admin
        if (Auth::user()->role === 'admin') {
            // Admin melihat semua transaksi
            $transactions = Transaction::orderBy('transaction_date', 'desc')->get();
        }
        // Jika user adalah pemilik kos
        elseif (Auth::user()->role === 'owner') {
            // Owner melihat transaksi yang terjadi pada kos miliknya
            $kosans = Kosan::where('user_id', Auth::id())->get(); // Ambil semua kos yang dimiliki oleh owner
            $kosanIds = $kosans->pluck('id')->toArray(); // Ambil id kos yang dimiliki owner

            // Filter transaksi berdasarkan kosan_id milik owner
            $transactions = Transaction::whereIn('kosan_id', $kosanIds)
                ->orderBy('transaction_date', 'desc')
                ->get();
        }
        // Jika user adalah user biasa
        else {
            // User melihat transaksi yang dia lakukan sendiri
            $transactions = Transaction::where('user_id', Auth::id())
                ->orderBy('transaction_date', 'desc')
                ->get();
        }

        return view('transaction.index', compact('transactions'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'kosan_id' => 'required|exists:kosans,id',
            'jumlah_transaksi' => 'required|integer|min:1',
        ]);

        // Buat transaksi
        $transaction = new Transaction([
            'user_id' => Auth::id(),
            'kosan_id' => $request->kosan_id,
            'jumlah_transaksi' => $request->jumlah_transaksi,
            'transaction_date' => now(),
            'status' => 'Menunggu Pembayaran',
        ]);
        $transaction->save();

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dibuat. Silakan selesaikan pembayaran.');
    }

    // Membatalkan transaksi
    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status !== 'Menunggu Pembayaran') {
            return redirect()->back()->with('error', 'Transaksi tidak dapat dibatalkan.');
        }

        $transaction->update(['status' => 'Dibatalkan']);

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dibatalkan.');
    }

    // Melakukan pembayaran transaksi
    public function pay($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status !== 'Menunggu Pembayaran') {
            return redirect()->back()->with('error', 'Transaksi tidak dapat dibayar.');
        }

        // Ubah status transaksi menjadi selesai
        $transaction->update(['status' => 'Lunas']);

        // Kurangi jumlah kamar tersedia
        $kosan = $transaction->kosan;

        if ($kosan->kamar_tersedia >= $transaction->jumlah_transaksi) {
            $kosan->kamar_tersedia -= $transaction->jumlah_transaksi;
            $kosan->save();
        } else {
            return redirect()->back()->with('error', 'Jumlah kamar tidak mencukupi.');
        }

        return redirect()->route('transaction.index')->with('success', 'Pembayaran berhasil, transaksi selesai!');
    }
}
