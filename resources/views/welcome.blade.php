<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Kos-Kosan</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F3EAC2;
        }

        .hero {
            background: url('{{ asset('images/hero-bg.jpg') }}') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .explore {
            padding: 60px 20px;
            background: linear-gradient(120deg, #F3EAC2, #FFF8DC);
        }

        .footer {
            background-color: #2C6E49;
            color: white;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1 class="display-4">Selamat Datang di Kos-Kosan</h1>
            <p class="lead">Temukan kosan terbaik untuk kebutuhan Anda.</p>
            <a href="#explore" class="btn btn-primary btn-lg" style="background-color: #2C6E49; border: none;">Jelajahi Sekarang</a>
        </div>
    </div>

    <!-- Explore Section -->
    <div class="explore text-center" id="explore">
        <h2 class="mb-4" style="color: #2C6E49;">Jelajahi Kosan</h2>
        <div class="container">
            <div class="row">
                @foreach ($kosans as $kosan)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset($kosan->foto_kosan) }}" class="card-img-top" alt="{{ $kosan->nama_kosan }}"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $kosan->nama_kosan }}</h5>
                                <p class="card-text">{{ $kosan->alamat_kosan }}</p>
                                <p class="card-text">Rp{{ number_format($kosan->harga_kosan) }}/bulan</p>
                                <a href="#" class="btn btn-primary" style="background-color: #2C6E49; border: none;">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} Kos-Kosan. All rights reserved.</p>
    </div>
</body>

</html>
