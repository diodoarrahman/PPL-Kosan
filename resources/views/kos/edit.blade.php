<!-- resources/views/kosan/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kosan</title>
</head>
<body>
    @include('layouts.navbar')
    <h1>Edit Kosan: {{ $kosan->nama_kosan }}</h1>

    <form action="{{ route('kosan.update', $kosan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="nama_kosan">Nama Kosan:</label>
        <input type="text" name="nama_kosan" value="{{ $kosan->nama_kosan }}" required><br>

        <label for="alamat_kosan">Alamat:</label>
        <input type="text" name="alamat_kosan" value="{{ $kosan->alamat_kosan }}" required><br>

        <label for="harga_kosan">Harga:</label>
        <input type="number" name="harga_kosan" value="{{ $kosan->harga_kosan }}" required><br>

        <label for="kamar_tersedia">Kamar Tersedia:</label>
        <input type="number" name="kamar_tersedia" value="{{ $kosan->kamar_tersedia }}" required><br>

        <label for="jenis_kosan">Jenis Kosan:</label>
        <select name="jenis_kosan" required>
            <option value="Putra" {{ $kosan->jenis_kosan == 'Putra' ? 'selected' : '' }}>Putra</option>
            <option value="Putri" {{ $kosan->jenis_kosan == 'Putri' ? 'selected' : '' }}>Putri</option>
            <option value="Campur" {{ $kosan->jenis_kosan == 'Campur' ? 'selected' : '' }}>Campur</option>
        </select><br>

        <label for="deskripsi_kosan">Deskripsi:</label>
        <textarea name="deskripsi_kosan" required>{{ $kosan->deskripsi_kosan }}</textarea><br>

        <label for="photos">Tambahkan Foto Baru:</label>
        <input type="file" name="photos[]" multiple><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
