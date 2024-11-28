<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Kos-Kosan')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #F3EAC2;
            color: #2C6E49 !important;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 80px; /* Sesuaikan dengan tinggi navbar */
            margin-bottom: 60px; /* Sesuaikan dengan tinggi footer */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</body>

</html>
