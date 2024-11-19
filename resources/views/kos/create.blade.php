@extends('layouts.app')

@section('content')
    <h1>Tambah Kosan Baru</h1>
    {{ auth()->user()->name }}
    <form action="{{ route('kosan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="nama_kosan">Nama Kosan:</label>
        <input type="text" name="nama_kosan" required><br>

        <label for="alamat_kosan">Alamat:</label>
        <input type="text" name="alamat_kosan" required><br>

        <label for="harga_kosan">Harga:</label>
        <input type="number" name="harga_kosan" required><br>

        <label for="kamar_tersedia">Kamar Tersedia:</label>
        <input type="number" name="kamar_tersedia" required><br>

        <label for="jenis_kosan">Jenis Kosan:</label>
        <select name="jenis_kosan" required>
            <option value="Putra">Putra</option>
            <option value="Putri">Putri</option>
            <option value="Campur">Campur</option>
        </select><br>

        <label for="deskripsi_kosan">Deskripsi:</label>
        <textarea name="deskripsi_kosan" required></textarea><br>

        <label for="photos">Foto Kosan:</label>
        <input type="file" name="photos[]" multiple><br>

        <button type="submit">Simpan Kosan</button>
    </form>
@endsection

