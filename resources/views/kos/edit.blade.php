@extends('layouts.app')

@section('content')
    <div class="container mt-5 mx-auto">
        <h1 class="mb-4">Edit Kosan: {{ $kosan->nama_kosan }}</h1>

        <form action="{{ route('kosan.update', $kosan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_kosan" class="form-label">Nama Kosan:</label>
                <input type="text" class="form-control" name="nama_kosan" value="{{ $kosan->nama_kosan }}" required>
            </div>

            <div class="mb-3">
                <label for="alamat_kosan" class="form-label">Alamat:</label>
                <input type="text" class="form-control" name="alamat_kosan" value="{{ $kosan->alamat_kosan }}" required>
            </div>

            <div class="mb-3">
                <label for="harga_kosan" class="form-label">Harga:</label>
                <input type="number" class="form-control" name="harga_kosan" value="{{ $kosan->harga_kosan }}" required>
            </div>

            <div class="mb-3">
                <label for="kamar_tersedia" class="form-label">Kamar Tersedia:</label>
                <input type="number" class="form-control" name="kamar_tersedia" value="{{ $kosan->kamar_tersedia }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="jenis_kosan" class="form-label">Jenis Kosan:</label>
                <select name="jenis_kosan" class="form-select" required>
                    <option value="Putra" {{ $kosan->jenis_kosan == 'Putra' ? 'selected' : '' }}>Putra</option>
                    <option value="Putri" {{ $kosan->jenis_kosan == 'Putri' ? 'selected' : '' }}>Putri</option>
                    <option value="Campur" {{ $kosan->jenis_kosan == 'Campur' ? 'selected' : '' }}>Campur</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="deskripsi_kosan" class="form-label">Deskripsi:</label>
                <textarea class="form-control" name="deskripsi_kosan" rows="4" required>{{ $kosan->deskripsi_kosan }}</textarea>
            </div>


                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <!-- Menampilkan gambar kosan -->
                        <img src="{{ $kosan->photos->first() ? asset('storage/' . $kosan->photos->first()->photo_url) : asset('images/default-kosan.jpg') }}"
                            class="card-img-top" alt="Foto Kosan" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $kosan->nama_kosan }}</h5>
                            <p class="card-text">
                                <label for="photos" class="form-label">Tambahkan Foto Baru:</label>
                    <input type="file" class="form-control" id="photos" name="photos[]" multiple>
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>

            
        </form>
    </div>
@endsection
