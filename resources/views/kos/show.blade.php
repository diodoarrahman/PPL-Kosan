<!-- resources/views/kosan/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm" style="background-color: #FFF8DC; border: 1px solid #C7A27C;">
            <div class="card-header" style="background-color: #F3EAC2; color: #2C6E49;">
                <h3 class="mb-0">Detail Kosan: {{ $kosan->nama_kosan }}</h3>
            </div>
            <div class="card-body" style="color: #2C6E49;">
                <p><strong>Alamat:</strong> {{ $kosan->alamat_kosan }}</p>
                <p><strong>Harga:</strong> Rp{{ number_format($kosan->harga_kosan) }}</p>
                <p><strong>Kamar Tersedia:</strong> {{ $kosan->kamar_tersedia }}</p>
                <p><strong>Jenis Kosan:</strong> {{ $kosan->jenis_kosan }}</p>
                <p><strong>Deskripsi:</strong> {{ $kosan->deskripsi_kosan }}</p>

                <!-- Tombol Tambah ke Favorit -->
                @auth
                    <form action="{{ route('favorite.store') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
                        <button type="submit" class="btn" 
                            style="background-color: #F3EAC2; color: #2C6E49; border: 1px solid #C7A27C;">
                            <i class="bi bi-heart-fill"></i> Tambah ke Favorit
                        </button>
                    </form>
                @endauth

                <!-- Tombol Transaksi -->
                @auth
                    <div class="card p-3" style="background-color: #FFF8DC; border: 1px solid #C7A27C;">
                        <h5 class="mb-3" style="color: #2C6E49;">Lakukan Transaksi</h5>
                        <form action="{{ route('transaction.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
                            <div class="mb-3">
                                <label for="jumlah_transaksi" class="form-label" style="color: #2C6E49;">Jumlah Transaksi:</label>
                                <input type="number" name="jumlah_transaksi" class="form-control"
                                    style="background-color: #F3EAC2; color: #2C6E49; border: 1px solid #C7A27C;" min="1"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="transaction_date" class="form-label" style="color: #2C6E49;">Tanggal Transaksi:</label>
                                <input type="date" name="transaction_date" class="form-control"
                                    style="background-color: #F3EAC2; color: #2C6E49; border: 1px solid #C7A27C;" required>
                            </div>
                            <button type="submit" class="btn" 
                                style="background-color: #2C6E49; color: #FFF8DC; border: 1px solid #C7A27C; width: 100%;">
                                Lakukan Transaksi
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
