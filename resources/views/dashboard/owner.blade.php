@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center" style="color: #2C6E49;">Dashboard Owner</h1>
        <p class="text-center">Selamat datang di dashboard untuk pengelola kosan Anda.</p>

        <!-- Statistik -->
        <div class="row text-center mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm" style="background-color: #FFF8DC;">
                    <div class="card-body">
                        <h5>Total Kosan</h5>
                        <h2 style="color: #2C6E49;">{{ $totalKosan }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm" style="background-color: #FFF8DC;">
                    <div class="card-body">
                        <h5>Total Kamar Tersedia</h5>
                        <h2 style="color: #2C6E49;">{{ $totalKamar }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm" style="background-color: #FFF8DC;">
                    <div class="card-body">
                        <h5>Total Pendapatan</h5>
                        <h2 style="color: #2C6E49;">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Kosan -->
        <h3 style="color: #2C6E49;">Daftar Kosan Anda</h3>
        <div class="row">
            @forelse ($kosans as $kosan)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm" style="border: 1px solid #C7A27C;">
                        <img src="{{ $kosan->photos->first() ? asset('storage/' . $kosan->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                            class="card-img-top" alt="Foto Kosan"
                            style="height: 150px; object-fit: cover;">
                        <div class="card-body" style="color: #2C6E49;">
                            <h5 class="card-title">{{ $kosan->nama_kosan }}</h5>
                            <p class="card-text">
                                <strong>Alamat:</strong> {{ Str::limit($kosan->alamat_kosan, 50) }}<br>
                                <strong>Harga:</strong> Rp{{ number_format($kosan->harga_kosan, 0, ',', '.') }}<br>
                                <strong>Kamar Tersedia:</strong> {{ $kosan->kamar_tersedia }}
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('kosan.edit', $kosan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kosan.destroy', $kosan->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    @include('layouts.empty')
                </div>
            @endforelse
        </div>

        <!-- Tambahkan Kosan -->
        <div class="text-center mt-4">
            <a href="{{ route('kosan.create') }}" class="btn btn-primary" style="background-color: #2C6E49; border: none;">
                Tambahkan Kosan Baru
            </a>
        </div>
    </div>
@endsection
