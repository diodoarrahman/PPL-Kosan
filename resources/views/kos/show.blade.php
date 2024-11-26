<!-- resources/views/kos/show.blade.php -->
@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

@section('content')
    <div class="container">
        <div class="card shadow-sm" style="background-color: #FFF8DC; border: 1px solid #C7A27C;">
            <div class="card-header" style="background-color: #F3EAC2; color: #2C6E49;">
                <h3 class="mb-0">Detail Kosan: {{ $kosan->nama_kosan }}</h3>
            </div>
            <div class="card-body" style="color: #2C6E49;">
                <p><strong>Alamat:</strong> {{ $kosan->alamat_kosan }}</p>
                <p><strong>Harga:</strong> Rp{{ number_format($kosan->harga_kosan) }}</p>
                <p><strong>Kamar Tersedia:</strong> {{ $kosan->kamar_tersedia }}</p>
                <p><strong>Jenis Kosan:</strong> {{ $kosan->jenis_kosan }}</p>
                <p><strong>Deskripsi:</strong> {{ $kosan->deskripsi_kosan }}</p>
                <p><strong>No Handphone:</strong> {{ $kosan->no_handphone }}</p>

                <!-- Form Komentar -->
                <div class="mt-4">
                    <h5>Komentar:</h5>
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
                        <div class="input-group mb-3">
                            <input type="text" name="comment" class="form-control comment-input"
                                placeholder="Tulis komentar..." required>
                            <button class="btn btn-outline-primary" type="submit">Kirim</button>
                        </div>
                    </form>

                    <!-- Menampilkan Komentar -->
                    <div id="commentSection" class="overflow-auto"
                        style="max-height: 300px; border: 1px solid #C7A27C; padding: 10px; background-color: #FFF8DC;">
                        @foreach ($kosan->comments->whereNull('parent_id') as $comment)
                            <div class="border p-2 mb-1">
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                                @auth
                                    <button class="btn btn-sm reply-button" onclick="toggleReplyForm({{ $comment->id }})"
                                    style="
                                    color: #2C6E49;
                                    background-color: #F3EAC2;
                                    border: 1px solid #C7A27C;
                                    border-radius: 15px;
                                    padding: 2px 10px;
                                    font-size: 0.8rem;
                                    transition: all 0.3s ease;
                                    margin-left: 10px;
                                "
                                        onmouseover="this.style.backgroundColor='#2C6E49'; this.style.color='#FFF8DC'"
                                        onmouseout="this.style.backgroundColor='#F3EAC2'; this.style.color='#2C6E49'">
                                        <i class="bi bi-reply-fill"></i> Balas
                                    </button>
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
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <script>
                    function toggleReplyForm(commentId) {
                        const form = document.getElementById('replyForm' + commentId);
                        form.style.display = form.style.display === 'none' ? 'block' : 'none';
                    }
                </script>

                <!-- Tombol Tambah ke Favorit -->
                @auth
                    <form action="{{ route('favorite.store') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
                        <button type="submit" class="btn"
                            style="background-color: #F3EAC2; color: #2C6E49; border: 1px solid #C7A27C;">
                            <i class="bi bi-heart-fill"></i> Tambah ke Favorit
                        </button>
                    </form>
                @endauth

                <!-- Tombol Transaksi -->
                @auth
                    <div class="card p-3" style="background-color: #FFF8DC; border: 1px solid #C7A27C;">
                        <h5 class="mb-3" style="color: #2C6E49;">Lakukan Transaksi</h5>
                        <form action="{{ route('transaction.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kosan_id" value="{{ $kosan->id }}">
                            <div class="mb-3">
                                <label for="jumlah_transaksi" class="form-label" style="color: #2C6E49;">Jumlah
                                    Transaksi:</label>
                                <input type="number" name="jumlah_transaksi" class="form-control"
                                    style="background-color: #F3EAC2; color: #2C6E49; border: 1px solid #C7A27C;" min="1"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="transaction_date" class="form-label" style="color: #2C6E49;">Tanggal
                                    Transaksi:</label>
                                <input type="date" name="transaction_date" class="form-control"
                                    style="background-color: #F3EAC2; color: #2C6E49; border: 1px solid #C7A27C;" required>
                            </div>
                            <button type="submit" class="btn"
                                style="background-color: #2C6E49; color: #FFF8DC; border: 1px solid #C7A27C; width: 100%;">
                                Lakukan Transaksi
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
