<!-- resources/views/mainpage.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kosan</title>
</head>
<body>
    @include('layouts.navbar')
    <h1>Etalase Kosan</h1>
    <div class="kosan-list">
        @foreach ($kosans as $kosan)
            <div class="kosan-item">
                <h2>{{ $kosan->nama_kosan }}</h2>
                <p>Harga: Rp{{ number_format($kosan->harga_kosan) }}</p>
                <p>Alamat: {{ $kosan->alamat_kosan }}</p>
                <a href="{{ route('kosan.show', $kosan->id) }}">Lihat Detail</a>
            </div>
        @endforeach
    </div>
</body>
</html>
