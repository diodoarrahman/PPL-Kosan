@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


@section('content')
    <div class="container">
        <div class="card shadow-sm" style="background-color: #FFF8DC; border: 1px solid #C7A27C;">
            <div class="card-header" style="background-color: #F3EAC2; color: #2C6E49;">
                <h3 class="mb-0">Detail Kosan: {{ $kosan->nama_kosan }}</h3>
            </div>
            <div class="card-body" style="color: #2C6E49;">
                <div class="row">
                    <!-- Bagian Kiri: Foto Kosan dan Map -->
                    <div class="col-md-6">
                        <!-- Foto Kosan -->
                        <div class="mb-4">
                            <h5>Foto Kosan:</h5>
                            <div id="kosanCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @forelse ($kosan->photos as $index => $photo)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $photo->photo_url) }}" class="d-block w-100"
                                                alt="Foto Kosan" style="object-fit: cover; height: 300px;">
                                        </div>
                                    @empty
                                        <p class="text-muted">Tidak ada foto untuk kosan ini.</p>
                                    @endforelse
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#kosanCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#kosanCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>


                        <!-- Peta Kosan (Jika ada latitude dan longitude) -->
                        <div class="mb-4">
                            <h5>Lokasi Kosan:</h5>
                            @if ($kosan->latitude && $kosan->longitude)
                                <div id="map" style="height: 400px;"></div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Inisialisasi peta dengan level zoom 15 (lebih besar untuk zoom in lebih dekat)
                                        var map = L.map('map').setView([{{ $kosan->latitude }}, {{ $kosan->longitude }}], 15);

                                        // Menambahkan tile layer OpenStreetMap
                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                        }).addTo(map);

                                        // Menambahkan marker pada lokasi kosan
                                        L.marker([{{ $kosan->latitude }}, {{ $kosan->longitude }}]).addTo(map)
                                            .bindPopup("{{ $kosan->nama_kosan }}")
                                            .openPopup();

                                        // Menambahkan kontrol zoom untuk memperbesar atau memperkecil
                                        L.control.zoom({
                                            position: 'topright' // Menempatkan kontrol zoom di pojok kanan atas
                                        }).addTo(map);
                                    });
                                </script>
                            @else
                                <p class="text-muted">Lokasi kosan tidak tersedia.</p>
                            @endif
                        </div>


                    </div>
                    <!-- Bagian Kanan: Detail Kosan -->
                    <div class="col-md-6">
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
                        <p><strong>No Handphone:</strong> {{ $kosan->no_handphone }}</p>
                        <p>{!! nl2br(e($kosan->deskripsi_kosan)) !!}</p>


                        <!-- Tombol Pilih Kosan -->
                        @auth
                            @if ($kosan->kamar_tersedia > 0)
                                <button class="btn"
                                    style="background-color: #2C6E49; color: #FFF8DC; border: 1px solid #C7A27C; width: 100%;"
                                    data-bs-toggle="modal" data-bs-target="#confirmModal">
                                    Pilih Kosan
                                </button>
                            @else
                                <p class="text-danger">Maaf, kosan ini sudah penuh dan tidak tersedia untuk pemesanan.</p>
                            @endif
                        @endauth
                        @guest
                            @if ($kosan->kamar_tersedia > 0)
                                <button class="btn"
                                    style="background-color: #2C6E49; color: #FFF8DC; border: 1px solid #C7A27C; width: 100%;"
                                    data-bs-toggle="modal" onclick="loginAlert()">
                                    Pilih Kosan
                                </button>
                            @else
                                <p class="text-danger">Maaf, kosan ini sudah penuh dan tidak tersedia untuk pemesanan.</p>
                            @endif
                        @endguest
                    </div>
                </div>

                <!-- Modal Konfirmasi Pilih Kosan -->
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Pemesanan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Harga:</strong> Rp{{ number_format($kosan->harga_kosan) }}</p>
                                <p><strong>Alamat:</strong> {{ $kosan->alamat_kosan }}</p>
                                <div class="mb-3">
                                    <label for="jumlah_kamar" class="form-label">Jumlah Kamar:</label>
                                    <input type="number" id="jumlah_kamar" class="form-control" value="1"
                                        min="1" max="{{ $kosan->kamar_tersedia }}" required>
                                    <div id="kamar_tersedia" class="form-text">Jumlah kamar tersedia:
                                        {{ $kosan->kamar_tersedia }}</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <form action="{{ route('transaction.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
                                    <input type="hidden" name="transaction_date" value="{{ now() }}">
                                    <input type="hidden" name="jumlah_transaksi" id="jumlah_transaksi" value="1">
                                    <button type="submit" class="btn btn-primary">Lakukan Transaksi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Komentar -->
                <div class="mt-4">
                    <h5>Komentar:</h5>
                    <form id="commentForm" action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
                        <div class="input-group mb-3">
                            <input type="text" name="comment" class="form-control comment-input"
                                placeholder="Tulis komentar..." required>
                            <button class="btn btn-outline-primary" type="submit">Kirim</button>
                        </div>
                    </form>

                    @guest
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('commentForm').addEventListener('submit', function(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: 'Login untuk membuat komentar',
                                    text: 'Anda perlu login untuk membuat komentar!',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Login',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '{{ route('login') }}';
                                    }
                                });
                            });
                        </script>
                    @endguest

                    <!-- Menampilkan Komentar -->
                    <div id="commentSection" class="overflow-auto"
                        style="max-height: 300px; border: 1px solid #C7A27C; padding: 10px; background-color: #FFF8DC;">
                        @foreach ($kosan->comments->whereNull('parent_id') as $comment)
                            <div class="border p-2 mb-1">
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}

                                @auth
                                    <!-- Tombol Balas -->
                                    <button class="btn btn-sm reply-button" onclick="toggleReplyForm({{ $comment->id }})"
                                        style="color: #2C6E49; background-color: #F3EAC2; border: 1px solid #C7A27C; border-radius: 15px; padding: 2px 10px; font-size: 0.8rem; transition: all 0.3s ease; margin-left: 10px;"
                                        onmouseover="this.style.backgroundColor='#2C6E49'; this.style.color='#FFF8DC'"
                                        onmouseout="this.style.backgroundColor='#F3EAC2'; this.style.color='#2C6E49'">
                                        <i class="bi bi-reply-fill"></i> Balas
                                    </button>

                                    <!-- Tombol Hapus Komentar (Hanya untuk admin atau pemilik komentar) -->
                                    @if (Auth::user()->role === 'admin' || Auth::id() === $comment->user_id)
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                @endauth

                                <!-- Form Balasan (Hidden by default) -->
                                <form id="replyForm{{ $comment->id }}" action="{{ route('comments.store') }}"
                                    method="POST" class="mt-2" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <div class="input-group mb-3">
                                        <input type="text" name="comment" class="form-control comment-input"
                                            placeholder="Balas komentar..." required>
                                        <button class="btn btn-outline-primary" type="submit">Kirim</button>
                                    </div>
                                </form>

                                <!-- Menampilkan Balasan di Bawah Komentar -->
                                @foreach ($comment->replies as $reply)
                                    <div class="reply-container ms-3 mt-2 border-start ps-2">
                                        <strong>{{ $reply->user->name }}:</strong> {{ $reply->comment }}

                                        @auth
                                            <!-- Tombol Hapus Balasan (Hanya untuk admin atau pemilik balasan) -->
                                            @if (Auth::user()->role === 'admin' || Auth::id() === $reply->user_id)
                                                <form action="{{ route('comments.destroy', $reply->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus balasan ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
            <script>
                // Fungsi untuk menampilkan atau menyembunyikan form balasan
                function toggleReplyForm(commentId) {
                    const replyForm = document.getElementById('replyForm' + commentId);
                    if (replyForm.style.display === 'none' || replyForm.style.display === '') {
                        replyForm.style.display = 'block';
                    } else {
                        replyForm.style.display = 'none';
                    }
                }

                // Menambahkan logika untuk modal
                const jumlahKamarInput = document.getElementById('jumlah_kamar');
                const jumlahTransaksiInput = document.getElementById('jumlah_transaksi');

                jumlahKamarInput.addEventListener('input', function() {
                    const jumlahKamar = parseInt(jumlahKamarInput.value);
                    const kamarTersedia = {{ $kosan->kamar_tersedia }};
                    if (jumlahKamar > kamarTersedia) {
                        jumlahKamarInput.value = kamarTersedia;
                    }
                    jumlahTransaksiInput.value = jumlahKamarInput.value;
                });
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            @include('layouts.loginalert')
        @endsection
