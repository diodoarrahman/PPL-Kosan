<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return view('transaction.index', compact('transactions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kosan_id' => 'required|exists:kosans,id', // Menambahkan validasi "exists"
            'jumlah_transaksi' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'kosan_id' => $request->kosan_id,
            'jumlah_transaksi' => $request->jumlah_transaksi,
            'transaction_date' => $request->transaction_date,
            'status' => 'Menunggu Pembayaran',
        ]);

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil, Selesaikan Pembayaran');
    }
    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => 'Dibatalkan']);
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dibatalkan');
    }
    public function pay($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status !== 'Menunggu Pembayaran') {
            return redirect()->back()->with('error', 'Transaksi tidak dapat dibayar.');
        }

        // Ubah status transaksi menjadi selesai
        $transaction->status = 'Lunas';
        $transaction->save();

        // Kurangi jumlah kamar tersedia
        $kosan = $transaction->kosan;
        $kosan->kamar_tersedia -= $transaction->jumlah_transaksi;
        $kosan->save();

        // Simpan data penyewa baru jika diperlukan
        // Contoh: Membuat entri di tabel "penghuni"
        // Penghuni::create([
        //     'kosan_id' => $kosan->id,
        //     'user_id' => Auth::id(),
        //     ...
        // ]);

        return redirect()->route('transaction.index')->with('success', 'Pembayaran berhasil, transaksi selesai!');
    }
}
