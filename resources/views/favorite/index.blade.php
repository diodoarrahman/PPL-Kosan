<!-- resources/views/favorite/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center" style="color: #2C6E49; font-weight: bold;">Daftar Favorit</h1>
        <div class="row">
            @forelse ($favorites as $favorite)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card shadow-sm" style="border: none;">
                        <!-- Gambar Kosan -->
                        <div style="position: relative;">
                            <img src="{{ $favorite->kosan->photos->first() ? asset('storage/' . $favorite->kosan->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                                class="card-img-top rounded" alt="Foto Kosan"
                                style="height: 200px; object-fit: cover; border-radius: 8px;">
                            <!-- Icon Hapus di Sudut -->
                            <form action="{{ route('favorite.destroy', $favorite->id) }}" method="POST" style="position: absolute; top: 10px; right: 10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="padding: 4px 8px; border-radius: 50%;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>

                        <div class="card-body" style="padding: 10px;">
                            <!-- Nama Kosan -->
                            <h6 class="card-title text-truncate mb-2" style="font-weight: bold; color: #2C6E49;">
                                {{ $favorite->kosan->nama_kosan }}
                            </h6>
                            <!-- Detail Harga dan Alamat -->
                            <p class="card-text mb-1" style="font-size: 0.9rem; color: #666;">
                                <strong>Harga:</strong> Rp{{ number_format($favorite->kosan->harga_kosan) }}
                            </p>
                            <p class="card-text text-truncate" style="font-size: 0.85rem; color: #999;">
                                {{ $favorite->kosan->alamat_kosan }}
                            </p>
                        </div>

                        <div class="card-footer d-flex justify-content-center" style="background-color: transparent; border: none;">
                            <!-- Tombol Detail -->
                            <a href="{{ route('kosan.show', $favorite->kosan->id) }}" class="btn btn-primary btn-sm"
                                style="background-color: #2C6E49; color: #FFF8DC; font-size: 0.85rem;">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-12">
                    <div class="alert alert-warning text-center" role="alert" style="background-color: #FFF8DC; color: #2C6E49;">
                        <strong>Belum ada kosan yang ditambahkan ke favorit.</strong>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
