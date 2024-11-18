<!-- resources/views/transaction/index.blade.php -->
<h1>Riwayat Transaksi</h1>
<ul>
    @foreach ($transactions as $transaction)
        <li>
            Kosan: {{ $transaction->kosan->nama_kosan }}<br>
            Tanggal Transaksi: {{ $transaction->transaction_date }}<br>
            Jumlah: Rp{{ number_format($transaction->jumlah_transaksi) }}<br>
            Status: {{ $transaction->status }}
        </li>
    @endforeach
</ul>
