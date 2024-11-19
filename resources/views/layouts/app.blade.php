<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Kos-Kosan')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <style>
        body {
            background-color: #F3EAC2; /* Latar belakang krem */
            color: #2C6E49 !important; /* Teks utama hijau tua */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Konten Utama -->
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</body>

</html>
