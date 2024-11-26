<!-- resources/views/transaction/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4" style="color: #2C6E49;">Riwayat Transaksi</h1>

        @forelse ($transactions as $transaction)
            <div class="card shadow-sm mb-4" style="background-color: #FFF8DC; border: 1px solid #C7A27C;">
                <div class="card-body">
                    <div class="row">
                        <!-- Informasi Kosan -->
                        <div class="col-md-2 text-center">
                            <img src="{{ $transaction->kosan->photos->first() ? asset('storage/' . $transaction->kosan->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                                class="img-fluid rounded" alt="Foto Kosan" style="height: 100px; object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                            <h5 style="color: #2C6E49;">{{ $transaction->kosan->nama_kosan }}</h5>
                            <p class="mb-1" style="color: #2C6E49;">
                                <strong>Alamat:</strong> {{ Str::limit($transaction->kosan->alamat_kosan, 50) }}
                            </p>
                            <p class="mb-0" style="color: #2C6E49;">
                                <strong>Tanggal Transaksi:</strong> {{ $transaction->transaction_date }}
                            </p>
                        </div>

                        <!-- Detail Transaksi -->
                        <div class="col-md-4 text-end">
                            <p class="mb-1" style="font-size: 1.1rem; color: #2C6E49;">
                                <strong>Jumlah:</strong> {{ number_format($transaction->jumlah_transaksi) }}
                            </p>
                            <p>
                                <strong>Status:</strong>
                                @if ($transaction->status == 'Lunas')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif ($transaction->status == 'Menunggu Pembayaran')
                                    <span class="badge bg-warning">Menunggu Pembayaran</span>
                                @else
                                    <span class="badge bg-danger">Dibatalkan</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="card-footer d-flex justify-content-between" style="background-color: #F3EAC2;">
                    <button class="btn btn-primary btn-sm show-transaction-modal"
                        data-bs-toggle="modal" data-bs-target="#transactionModal"
                        data-transaction-id="{{ $transaction->id }}" data-kosan-id="{{ $transaction->kosan->id }}"
                        data-kosan-name="{{ $transaction->kosan->nama_kosan }}" data-status="{{ $transaction->status }}"
                        data-jumlah="{{ $transaction->jumlah_transaksi }}" data-tanggal="{{ $transaction->transaction_date }}">
                        Lihat Detail
                    </button>
                    @if ($transaction->status == 'Menunggu Pembayaran')
                        <form action="{{ route('transaction.cancel', $transaction->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-x-circle"></i> Batalkan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            @include('layouts.empty')
        @endforelse
    </div>

    <!-- Modal -->
    <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionModalLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Kosan:</strong> <span id="modalKosanName"></span></p>
                    <p><strong>Jumlah Transaksi:</strong> <span id="modalJumlah"></span></p>
                    <p><strong>Tanggal Transaksi:</strong> <span id="modalTanggal"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <form id="bayarForm" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Bayar Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('transactionModal');
        const bayarForm = document.getElementById('bayarForm');

        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const transactionId = button.getAttribute('data-transaction-id');
            const kosanName = button.getAttribute('data-kosan-name');
            const jumlah = button.getAttribute('data-jumlah');
            const tanggal = button.getAttribute('data-tanggal');
            const status = button.getAttribute('data-status');

            // Set modal content
            document.getElementById('modalKosanName').textContent = kosanName;
            document.getElementById('modalJumlah').textContent = jumlah;
            document.getElementById('modalTanggal').textContent = tanggal;
            document.getElementById('modalStatus').textContent = status;

            // Set form action for Bayar Sekarang
            bayarForm.action = `/transaction/${transactionId}/pay`;
        });
    });
</script>
