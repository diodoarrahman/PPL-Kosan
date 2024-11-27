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

                            @if ($kosan->kamar_tersedia === 0)
                                <p class="text-danger" style="font-weight: bold;">Kosan Tidak Tersedia</p>
                            @endif
                        </div>
                        <div class="card-footer p-3 d-flex justify-content-between align-items-center">
                            <!-- Tombol Favorit -->
                            @if (Auth::check())
                                <button type="button"
                                    class="btn btn-sm add-to-favorite {{ $kosan->isFavoritedByUser(Auth::user()) ? 'btn-danger' : 'btn-outline-danger' }}"
                                    data-kosan-id="{{ $kosan->id }}"
                                    data-favorited="{{ $kosan->isFavoritedByUser(Auth::user()) ? 'true' : 'false' }}">
                                    <i
                                        class="bi {{ $kosan->isFavoritedByUser(Auth::user()) ? 'bi-suit-heart-fill' : 'bi-suit-heart' }}"></i>
                                </button>
                            @else
                                <a class="btn btn-outline-danger btn-sm" onclick="loginAlert()"> 
                                    <i class="bi bi-suit-heart"></i>
                                </a>
                            @endif

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

    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Jangan lupa untuk menambahkan token CSRF -->
@endsection

@include('layouts.loginalert')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Event listener untuk tombol tambah favorit/unfavorite
        $('.add-to-favorite').on('click', function () {
            var kosanId = $(this).data('kosan-id'); // Ambil kosan_id dari data-kosan-id
            var token = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
            var button = $(this); // Simpan tombol yang di-click

            // Cek apakah kosan sudah difavoritkan
            var isFavorited = button.hasClass('btn-danger');

            // Kirim AJAX request ke server untuk menambahkan/menyimpan favorit atau menghapusnya
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
                    // Jika berhasil menambah atau menghapus favorit
                    if (response.status === 'success') {
                        var icon = button.find('i'); // Cari elemen ikon di dalam tombol

                        if (isFavorited) {
                            // Jika di-unfavorite, ubah ikon dan kelas tombol
                            button.removeClass('btn-danger').addClass('btn-outline-danger');
                            icon.removeClass('bi-suit-heart-fill').addClass('bi-suit-heart');
                        } else {
                            // Jika di-favoritkan, ubah ikon dan kelas tombol
                            button.removeClass('btn-outline-danger').addClass('btn-danger');
                            icon.removeClass('bi-suit-heart').addClass('bi-suit-heart-fill');
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
