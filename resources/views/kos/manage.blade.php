<!-- resources/views/kosan/manage.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manajemen Kosan</h1>
        <a href="{{ route('kosan.create') }}" class="btn btn-primary mb-3">Create Kosan</a>
        <div class="row">
            @foreach ($kosans as $k)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <!-- Menampilkan gambar kosan -->
                        <img src="{{ $k->photos->first() ? asset('storage/' . $k->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                            class="card-img-top" alt="Foto Kosan" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $k->nama_kosan }}</h5>
                            <p class="card-text">
                                <strong>Alamat:</strong> {{ $k->alamat_kosan }}<br>
                                <strong>Harga:</strong> {{ $k->harga_kosan }}<br>
                                <strong>Kamar Tersedia:</strong> {{ $k->kamar_tersedia }}<br>
                                <strong>Jenis Kosan:</strong> {{ $k->jenis_kosan }}<br>
                                <strong>Deskripsi:</strong> {{ $k->deskripsi_kosan }}
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
            @endforeach
        </div>
    </div>
@endsection
