<!-- resources/views/kosan/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Detail Kosan: {{ $kosan->nama_kosan }}</h1>
    <p>Alamat: {{ $kosan->alamat_kosan }}</p>
    <p>Harga: Rp{{ number_format($kosan->harga_kosan) }}</p>
    <p>Kamar Tersedia: {{ $kosan->kamar_tersedia }}</p>
    <p>Jenis Kosan: {{ $kosan->jenis_kosan }}</p>
    <p>Deskripsi: {{ $kosan->deskripsi_kosan }}</p>

    <!-- Tombol Tambah ke Favorit -->
    @auth
        <form action="{{ route('favorite.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
            <button type="submit">Tambah ke Favorit</button>
        </form>
    @endauth

    <!-- Tombol Transaksi -->
    @auth
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
            <label for="jumlah_transaksi">Jumlah Transaksi:</label>
            <input type="number" name="jumlah_transaksi" min="1" required>
            <label for="transaction_date">Tanggal Transaksi:</label>
            <input type="date" name="transaction_date" required>
            <button type="submit">Lakukan Transaksi</button>
        </form>
    @endauth
@endsection
