<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('transaction_date', 'desc') // Mengurutkan berdasarkan tanggal terbaru
            ->get();

        return view('transaction.index', compact('transactions'));
    }


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
            'transaction_date' => now(), // Gunakan timestamp saat transaksi dibuat
            'status' => 'Menunggu Pembayaran',
        ]);
        $transaction->save();

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dibuat. Silakan selesaikan pembayaran.');
    }

    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status !== 'Menunggu Pembayaran') {
            return redirect()->back()->with('error', 'Transaksi tidak dapat dibatalkan.');
        }

        $transaction->update(['status' => 'Dibatalkan']);

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dibatalkan.');
    }

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
