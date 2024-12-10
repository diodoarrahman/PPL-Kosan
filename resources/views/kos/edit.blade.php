@extends('layouts.app')

@section('content')
    <div class="container mt-5 mx-auto">
        <h1 class="mb-4">Edit Kosan: {{ $kosan->nama_kosan }}</h1>

        <form action="{{ route('kosan.update', $kosan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Formulir untuk data kosan lainnya -->
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

            <div class="mb-3">
                <label for="no_handphone" class="form-label">No Handphone:</label>
                <input type="text" class="form-control" name="no_handphone" value="{{ $kosan->no_handphone }}">
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude:</label>
                <input type="text" class="form-control" name="latitude" value="{{ $kosan->latitude }}">
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude:</label>
                <input type="text" class="form-control" name="longitude" value="{{ $kosan->longitude }}">
            </div>

            <!-- Menampilkan Foto-foto Kosan -->
            <div class="mb-3">
                <label for="photos" class="form-label">Foto Kosan:</label>
                <div class="row">
                    @foreach ($kosan->photos as $photo)
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset('storage/' . $photo->photo_url) }}" class="card-img-top"
                                    style="height: 200px; object-fit: cover;" alt="Foto Kosan">
                                <div class="card-body">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="delete_photo_{{ $photo->id }}"
                                            name="delete_photos[]" value="{{ $photo->id }}">
                                        <label class="form-check-label" for="delete_photo_{{ $photo->id }}">Hapus Foto</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Upload Foto Baru -->
            <div class="mb-3">
                <label for="photos" class="form-label">Tambahkan Foto Baru:</label>
                <input type="file" class="form-control" id="photos" name="photos[]" multiple>
                @error('photos.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
