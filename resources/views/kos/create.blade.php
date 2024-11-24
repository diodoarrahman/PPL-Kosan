@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Buat Kosan Baru</h1>

        <form action="{{ route('kosan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nama_kosan" class="form-label">Nama Kosan:</label>
                <input type="text" class="form-control" name="nama_kosan" required>
            </div>

            <div class="mb-3">
                <label for="alamat_kosan" class="form-label">Alamat:</label>
                <input type="text" class="form-control" name="alamat_kosan" required>
            </div>

            <div class="mb-3">
                <label for="harga_kosan" class="form-label">Harga:</label>
                <input type="number" class="form-control" name="harga_kosan" required>
            </div>

            <div class="mb-3">
                <label for="kamar_tersedia" class="form-label">Kamar Tersedia:</label>
                <input type="number" class="form-control" name="kamar_tersedia" required>
            </div>

            <div class="mb-3">
                <label for="jenis_kosan" class="form-label">Jenis Kosan:</label>
                <select name="jenis_kosan" class="form-select" required>
                    <option value="Putra">Putra</option>
                    <option value="Putri">Putri</option>
                    <option value="Campur">Campur</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="deskripsi_kosan" class="form-label">Deskripsi:</label>
                <textarea class="form-control" name="deskripsi_kosan" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="no_handphone" class="form-label">No Handphone:</label>
                <input type="text" class="form-control" name="no_handphone" required>
            </div>

            <div class="mb-3">
                <label for="photos" class="form-label">Tambahkan Foto:</label>
                <input type="file" class="form-control" id="photos" name="photos[]" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Kosan</button>
        </form>
    </div>
@endsection
