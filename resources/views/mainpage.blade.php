<!-- resources/views/mainpage.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse ($kosans as $kosan)
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card h-100" style="max-height: 350px;">
                        <!-- Menampilkan gambar kosan -->
                        <img src="{{ $kosan->photos->first() ? asset('storage/' . $kosan->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                            class="card-img-top" alt="Foto Kosan" style="height: 150px; object-fit: cover;">
                        <div class="card-body p-2">
                            <h6 class="card-title text-truncate mb-2" style="font-size: 1rem;">{{ $kosan->nama_kosan }}</h6>
                            <p class="card-text mb-1" style="font-size: 0.875rem;">
                                <strong>Harga:</strong> Rp{{ number_format($kosan->harga_kosan) }}<br>
                                <small class="text-muted">Alamat:</small> {{ Str::limit($kosan->alamat_kosan, 30) }}
                            </p>
                        </div>
                        <div class="card-footer p-2 d-flex justify-content-between">
                            <!-- Tombol Tambah Favorit -->
                            <form action="{{ route('favorite.store', $kosan->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" style="font-size: 0.75rem;">
                                    <i class="bi bi-heart-fill"></i> Favorit
                                </button>
                            </form>

                            <!-- Tombol Lihat Detail -->
                            <a href="{{ route('kosan.show', $kosan->id) }}" class="btn btn-primary btn-sm" style="font-size: 0.75rem;">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                @include('layouts.empty')
            @endforelse
        </div>
    </div>
@endsection
