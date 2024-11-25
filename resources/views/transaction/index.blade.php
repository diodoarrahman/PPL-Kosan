<!-- resources/views/transaction/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4" style="color: #2C6E49;">Riwayat Transaksi</h1>

        @forelse ($transactions as $transaction)
            <div class="card shadow-sm mb-4" style="background-color: #FFF8DC; border: 1px solid #C7A27C;">
                <div class="card-body">
                    <div class="row">
                        <!-- Informasi Kosan -->
                        <div class="col-md-2 text-center">
                            <img src="{{ $transaction->kosan->photos->first() ? asset('storage/' . $transaction->kosan->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                                class="img-fluid rounded" alt="Foto Kosan" style="height: 100px; object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                            <h5 style="color: #2C6E49;">{{ $transaction->kosan->nama_kosan }}</h5>
                            <p class="mb-1" style="color: #2C6E49;">
                                <strong>Alamat:</strong> {{ Str::limit($transaction->kosan->alamat_kosan, 50) }}
                            </p>
                            <p class="mb-0" style="color: #2C6E49;">
                                <strong>Tanggal Transaksi:</strong> {{ $transaction->transaction_date }}
                            </p>
                        </div>

                        <!-- Detail Transaksi -->
                        <div class="col-md-4 text-end">
                            <p class="mb-1" style="font-size: 1.1rem; color: #2C6E49;">
                                <strong>Jumlah:</strong> {{ number_format($transaction->jumlah_transaksi) }}
                            </p>
                            <p>
                                <strong>Status:</strong>
                                @if ($transaction->status == 'Lunas')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif ($transaction->status == 'Menunggu Pembayaran')
                                    <span class="badge bg-warning">Menunggu Pembayaran</span>
                                @else
                                    <span class="badge bg-danger">Dibatalkan</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="card-footer d-flex justify-content-between" style="background-color: #F3EAC2;">
                    <a href="{{ route('kosan.show', $transaction->id) }}" class="btn btn-primary btn-sm"
                        style="background-color: #2C6E49; color: #FFF8DC; border: 1px solid #C7A27C;">
                        Detail Transaksi
                    </a>
                    @if ($transaction->status == 'Menunggu Pembayaran')
                        <form action="{{ route('transaction.cancel', $transaction->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-x-circle"></i> Batalkan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            @include('layouts.empty')
        @endforelse
    </div>
@endsection
