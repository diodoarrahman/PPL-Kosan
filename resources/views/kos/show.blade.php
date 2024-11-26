@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

@section('content')
    <div class="container">
        <div class="card shadow-sm" style="background-color: #FFF8DC; border: 1px solid #C7A27C;">
            <div class="card-header" style="background-color: #F3EAC2; color: #2C6E49;">
                <h3 class="mb-0">Detail Kosan: {{ $kosan->nama_kosan }}</h3>
            </div>
            <div class="card-body" style="color: #2C6E49;">
                <div class="mb-4">
                    <h5>Foto Kosan:</h5>
                    <div class="row">
                        @forelse ($kosan->photos as $photo)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset('storage/' . $photo->photo_url) }}" class="img-fluid rounded"
                                    alt="Foto Kosan" style="object-fit: cover; height: 150px;">
                            </div>
                        @empty
                            <p class="text-muted">Tidak ada foto untuk kosan ini.</p>
                        @endforelse
                    </div>
                </div>
                <p><strong>Alamat:</strong> {{ $kosan->alamat_kosan }}</p>
                <p><strong>Harga:</strong> Rp{{ number_format($kosan->harga_kosan) }}</p>
                <p><strong>Kamar Tersedia:</strong>
                    {{ $kosan->kamar_tersedia }}
                    @if ($kosan->kamar_tersedia === 0)
                        <span class="text-danger">(Tidak Tersedia)</span>
                    @endif
                </p>
                <p><strong>Jenis Kosan:</strong> {{ $kosan->jenis_kosan }}</p>
                <p><strong>Deskripsi:</strong></p>
                <p>{!! nl2br(e($kosan->deskripsi_kosan)) !!}</p>
                <p><strong>No Handphone:</strong> {{ $kosan->no_handphone }}</p>
                <!-- Tombol Transaksi -->
                @auth
                    @if ($kosan->kamar_tersedia > 0)
                        <div class="card p-3" style="background-color: #FFF8DC; border: 1px solid #C7A27C;">
                            <h5 class="mb-3" style="color: #2C6E49;">Lakukan Transaksi</h5>
                            <form action="{{ route('transaction.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
                                <input type="hidden" name="transaction_date" value="{{ now() }}">
                                <!-- Tanggal otomatis -->
                                <div class="mb-3">
                                    <label for="jumlah_transaksi" class="form-label" style="color: #2C6E49;">Jumlah
                                        Transaksi:</label>
                                    <input type="number" name="jumlah_transaksi" class="form-control"
                                        style="background-color: #F3EAC2; color: #2C6E49; border: 1px solid #C7A27C;"
                                        min="1" required>
                                </div>

                                <button type="submit" class="btn"
                                    style="background-color: #2C6E49; color: #FFF8DC; border: 1px solid #C7A27C; width: 100%;">
                                    Lakukan Transaksi
                                </button>
                            </form>
                        </div>
                    @else
                        <p class="text-danger">Maaf, kosan ini sudah penuh dan tidak tersedia untuk transaksi.</p>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endsection
