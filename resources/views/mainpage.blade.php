@extends('layouts.app')

@section('content')
    @include('components.search')

    <div class="container mt-4">
        <div class="row">
            @forelse ($kosans as $kosan)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm sr-card" style="overflow: hidden; transition: all 0.3s ease;">
                        <!-- Gambar Kosan -->
                        <div class="image-container" style="height: 200px; overflow: hidden;">
                            <img src="{{ $kosan->photos->first() ? asset('storage/' . $kosan->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                                class="card-img-top" alt="Foto Kosan"
                                style="height: 100%; object-fit: cover; transition: transform 0.3s;">
                        </div>
                        <div class="card-body p-3" style="color: #2C6E49;">
                            <h5 class="card-title text-truncate mb-2" style="font-size: 1.25rem;">
                                {{ $kosan->nama_kosan }}
                            </h5>
                            <p class="card-text mb-1" style="font-size: 0.875rem;">
                                <strong>Harga:</strong> Rp{{ number_format($kosan->harga_kosan) }}<br>
                                <small class="text-muted">Alamat:</small> {{ Str::limit($kosan->alamat_kosan, 40) }}<br>
                                <small class="text-muted">No Handphone:</small> {{ $kosan->no_handphone }}
                            </p>
                        </div>
                        <div class="card-footer p-3 d-flex justify-content-between align-items-center">
                            <!-- Tombol Tambah Favorit -->
                            <form action="{{ route('favorite.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-heart-fill"></i> Favorit
                                </button>
                            </form>

                            <!-- Tombol Lihat Detail -->
                            <a href="{{ route('kosan.show', $kosan->id) }}" class="btn btn-primary btn-sm">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    @include('layouts.empty')
                </div>
            @endforelse
        </div>
    </div>
@endsection
