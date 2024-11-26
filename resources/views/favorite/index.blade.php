@extends('layouts.app')

@section('content')
    @include('components.search')

    <div class="container mt-4">
        <h1 class="mb-4 text-center" style="color: #2C6E49; font-weight: bold;">Daftar Favorit</h1>
        <div class="row">
            @forelse ($favorites as $favorite)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm sr-card" style="overflow: hidden; transition: all 0.3s ease;">
                        <!-- Gambar Kosan -->
                        <div class="image-container" style="height: 200px; overflow: hidden;">
                            <img src="{{ $favorite->kosan->photos->first() ? asset('storage/' . $favorite->kosan->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                                class="card-img-top" alt="Foto Kosan"
                                style="height: 100%; object-fit: cover; transition: transform 0.3s;">
                        </div>
                        <div class="card-body p-3" style="color: #2C6E49;">
                            <h5 class="card-title text-truncate mb-2" style="font-size: 1.25rem;">
                                {{ $favorite->kosan->nama_kosan }}
                            </h5>
                            <p class="card-text mb-1" style="font-size: 0.875rem;">
                                <strong>Harga:</strong> Rp{{ number_format($favorite->kosan->harga_kosan) }}<br>
                                <small class="text-muted">Alamat:</small> {{ Str::limit($favorite->kosan->alamat_kosan, 40) }}
                            </p>
                        </div>
                        <div class="card-footer p-3 d-flex justify-content-between align-items-center">
                            <!-- Tombol Favorit -->
                            @if (Auth::check())
                                <button type="button"
                                    class="btn btn-sm add-to-favorite {{ $favorite->kosan->isFavoritedByUser(Auth::user()) ? 'btn-danger' : 'btn-outline-danger' }}"
                                    data-kosan-id="{{ $favorite->kosan->id }}"
                                    data-favorited="{{ $favorite->kosan->isFavoritedByUser(Auth::user()) ? 'true' : 'false' }}">
                                    <i
                                        class="bi {{ $favorite->kosan->isFavoritedByUser(Auth::user()) ? 'bi-suit-heart-fill' : 'bi-suit-heart' }}"></i>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-bookmark-heart"></i>
                                </a>
                            @endif

                            <!-- Tombol Lihat Detail -->
                            <a href="{{ route('kosan.show', $favorite->kosan->id) }}" class="btn btn-primary btn-sm">Detail</a>
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

    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Jangan lupa untuk menambahkan token CSRF -->
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Event listener untuk tombol tambah/unfavorite
        $('.add-to-favorite').on('click', function () {
            var kosanId = $(this).data('kosan-id'); // Ambil kosan_id dari data-kosan-id
            var token = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
            var button = $(this); // Simpan tombol yang di-click
            var card = button.closest('.col-md-4'); // Elemen card yang akan dihapus

            // Cek apakah kosan sudah difavoritkan
            var isFavorited = button.hasClass('btn-danger');

            // Kirim AJAX request ke server
            $.ajax({
                url: isFavorited
                    ? '{{ route("favorite.destroy", ":id") }}'.replace(':id', kosanId)
                    : '{{ route("favorite.store") }}', // URL route untuk store atau destroy favorite
                method: isFavorited ? 'DELETE' : 'POST', // DELETE jika unfavorite, POST jika favorite
                data: {
                    _token: token,
                    kosan_id: kosanId
                },
                success: function (response) {
                    if (response.status === 'success') {
                        if (isFavorited) {
                            // Hapus card jika di-unfavorite
                            card.fadeOut(300, function () {
                                $(this).remove();
                            });
                        } else {
                            // Tambahkan kelas merah jika di-favoritkan
                            button.removeClass('btn-outline-danger').addClass('btn-danger');
                            button.find('i').removeClass('bi-suit-heart').addClass('bi-suit-heart-fill');
                        }
                    } else {
                        alert(response.message || 'Terjadi kesalahan, coba lagi!');
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan, coba lagi!');
                }
            });
        });
    });
</script>
