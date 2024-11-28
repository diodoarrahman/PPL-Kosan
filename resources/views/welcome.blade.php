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
            overflow-x: hidden;
        }

        /* HERO SECTION */
        .hero {
            position: relative;
            height: 100vh;
            color: white;
            text-align: center;
            overflow: hidden;
        }

        .hero .carousel-inner {
            height: 100vh;
        }

        .hero .carousel-item {
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .hero .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .hero-content {
            position: absolute;
            z-index: 2;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
            animation: fadeInDown 1.5s ease-in-out;
        }

        .hero p {
            font-size: 1.5rem;
            margin-top: 10px;
            animation: fadeInUp 2s ease-in-out;
        }

        .hero .btn {
            margin-top: 30px;
            animation: fadeIn 2.5s ease-in-out;
        }

        /* Animasi */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section with Carousel -->
    <div class="hero">
        <!-- Carousel -->
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <!-- Gambar 1 -->
                <div class="carousel-item active" style="background-image: url('assets/carousel1.jpg');"></div>
                <!-- Gambar 2 -->
                <div class="carousel-item" style="background-image: url('assets/carousel2.jpg');"></div>
                <!-- Gambar 3 -->
                <div class="carousel-item" style="background-image: url('assets/carousel3.jpg');"></div>
                <div class="carousel-item" style="background-image: url('assets/carousel4.jpg');"></div>
                <div class="carousel-item" style="background-image: url('assets/carousel5.jpg');"></div>
                <div class="carousel-item" style="background-image: url('assets/carousel6.jpg');"></div>
            </div>
            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Overlay -->
        <div class="overlay"></div>

        <!-- Hero Content -->
        <div class="hero-content">
            <h1 class="animate__animated animate__fadeInDown">Selamat Datang</h1>
            <h1 class="animate__animated animate__fadeInDown">di Kostpedia</h1>
            <p class="animate__animated animate__fadeInUp">Temukan kosan terbaik untuk kebutuhan Anda.</p>
            <a href="/mainpage" class="btn btn-primary btn-lg" style="background-color: #2C6E49; border: none;">Jelajahi
                Sekarang</a>
        </div>
    </div>


    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</body>

</html>
