@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Buat Kosan Baru</h1>

        <!-- Menampilkan Semua Error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kosan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nama_kosan" class="form-label">Nama Kosan:</label>
                <input type="text" class="form-control" name="nama_kosan" value="{{ old('nama_kosan') }}" required>
                @error('nama_kosan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alamat_kosan" class="form-label">Alamat:</label>
                <input type="text" class="form-control" name="alamat_kosan" value="{{ old('alamat_kosan') }}" required>
                @error('alamat_kosan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="harga_kosan" class="form-label">Harga:</label>
                <input type="number" class="form-control" name="harga_kosan" value="{{ old('harga_kosan') }}" required>
                @error('harga_kosan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kamar_tersedia" class="form-label">Kamar Tersedia:</label>
                <input type="number" class="form-control" name="kamar_tersedia" value="{{ old('kamar_tersedia') }}"
                    required>
                @error('kamar_tersedia')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_kosan" class="form-label">Jenis Kosan:</label>
                <select name="jenis_kosan" class="form-select" required>
                    <option value="Putra" {{ old('jenis_kosan') == 'Putra' ? 'selected' : '' }}>Putra</option>
                    <option value="Putri" {{ old('jenis_kosan') == 'Putri' ? 'selected' : '' }}>Putri</option>
                    <option value="Campur" {{ old('jenis_kosan') == 'Campur' ? 'selected' : '' }}>Campur</option>
                </select>
                @error('jenis_kosan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi_kosan" class="form-label">Deskripsi:</label>
                <textarea class="form-control" name="deskripsi_kosan" rows="4" required>{{ old('deskripsi_kosan') }}</textarea>
                @error('deskripsi_kosan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="no_handphone" class="form-label">No Handphone:</label>
                <input type="text" class="form-control" name="no_handphone" value="{{ old('no_handphone') }}" required>
                @error('no_handphone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude:</label>
                <input type="text" class="form-control" name="latitude" value="{{ old('latitude') }}">
                @error('latitude')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude:</label>
                <input type="text" class="form-control" name="longitude" value="{{ old('longitude') }}">
                @error('longitude')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="photos" class="form-label">Tambahkan Foto:</label>
                <input type="file" class="form-control" id="photos" name="photos[]" multiple>
                @error('photos.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Kosan</button>
        </form>
    </div>
@endsection
