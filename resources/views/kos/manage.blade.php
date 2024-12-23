<!-- resources/views/kos/manage.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manajemen Kosan</h1>
        <a href="{{ route('kosan.create') }}" class="btn btn-primary mb-3">Create Kosan</a>
        <div class="row">
            @forelse ($kosans as $k)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <!-- Menampilkan gambar kosan -->
                        <img class="card-img-top"
                            src="{{ $k->photos->first() ? asset('storage/' . $k->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                            alt="Foto Kosan" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $k->nama_kosan }}</h5>
                            <p class="card-text">
                                <strong>Alamat:</strong> {{ $k->alamat_kosan }}<br>
                                <strong>Harga:</strong> Rp{{ number_format($k->harga_kosan) }}<br>
                                <strong>Kamar Tersedia:</strong> {{ $k->kamar_tersedia }}<br>
                                <strong>Jenis Kosan:</strong> {{ $k->jenis_kosan }}<br>
                                <strong>Deskripsi:</strong> {{ $k->deskripsi_kosan }}<br>
                                <strong>No Handphone:</strong> {{ $k->no_handphone }}<br>
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <form action="{{ route('kosan.destroy', $k->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            <a href="{{ route('kosan.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Jika tidak ada data kosan -->
                <div class="col-12 text-center">
                    @include('layouts.empty')
                </div>
            @endforelse
        </div>
    </div>
@endsection
