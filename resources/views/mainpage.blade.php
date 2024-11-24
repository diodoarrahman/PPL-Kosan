<!-- resources/views/mainpage.blade.php -->
@extends('layouts.app')

@section('content')
    <!-- Search form -->
    <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
        <div class="container-fluid px-0">
            <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                <div class="d-flex align-items-center">
                    <form class="navbar-search form-inline" id="navbar-search-main">
                        <div class="input-group input-group-merge search-bar">
                            <span class="input-group-text" id="topbar-addon">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search"
                                aria-label="Search" aria-describedby="topbar-addon">
                        </div>
                    </form>
                    <div class="btn-group sort-btn ms-2">
                        <button class="btn" type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="background-color: #28a745; color: white;">Sort</button>
                        <button class="btn dropdown-toggle" data-sort="none" style="background-color: #28a745; color: white;"><i class="fa fa-sort"></i></button>
                        <ul class="dropdown-menu">
                            <li><a href="#" tabindex="-1" data-type="alpha">Name</a></li>
                            <li><a href="#" tabindex="-1" data-type="numeric">Date</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            @forelse ($kosans as $kosan)
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card h-100" style="max-height: 350px;">
                        <!-- Menampilkan gambar kosan -->
                        <img src="{{ $kosan->photos->first() ? asset('storage/' . $kosan->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                            class="card-img-top" alt="Foto Kosan" style="height: 150px; object-fit: cover;">
                        <div class="card-body p-2">
                            <h6 class="card-title text-truncate mb-2" style="font-size: 1rem;">
                                {{ $kosan->nama_kosan }}</h6>
                            <p class="card-text mb-1" style="font-size: 0.875rem;">
                                <strong>Harga:</strong> Rp{{ number_format($kosan->harga_kosan) }}<br>
                                <small class="text-muted">Alamat:</small>
                                {{ Str::limit($kosan->alamat_kosan, 30) }}
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
                            <a href="{{ route('kosan.show', $kosan->id) }}" class="btn btn-primary btn-sm"
                                style="font-size: 0.75rem;">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                @include('layouts.empty')
            @endforelse
        </div>
    </div>
@endsection
