<!-- resources/views/mainpage.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($kosans as $kosan)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <!-- Menampilkan gambar kosan -->
                        <img src="{{ $kosan->photos->first() ? asset('storage/' . $kosan->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                             class="card-img-top" alt="Foto Kosan" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $kosan->nama_kosan }}</h5>
                            <p class="card-text">
                                <strong>Alamat:</strong> {{ $kosan->alamat_kosan }}<br>
                                <strong>Harga:</strong> Rp{{ number_format($kosan->harga_kosan) }}<br>
                                <strong>Kamar Tersedia:</strong> {{ $kosan->kamar_tersedia }}<br>
                                <strong>Jenis Kosan:</strong> {{ $kosan->jenis_kosan }}<br>
                                <strong>Deskripsi:</strong> {{ $kosan->deskripsi_kosan }}
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('kosan.show', $kosan->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
