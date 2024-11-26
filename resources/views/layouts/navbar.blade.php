<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kos-Kosan</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <style>
        .navbar-custom {
            background-color: #2C6E49;
        }

        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: #F3EAC2 !important;
        }

        .navbar-custom .dropdown-menu {
            background-color: #F3EAC2;
        }

        .navbar-custom .dropdown-item {
            color: #2C6E49 !important;
        }

        .navbar-custom .dropdown-item:hover {
            background-color: #A7C957 !important;
        }

        .profile-icon {
            width: 40px;
            /* Ukuran gambar */
            height: 40px;
            /* Ukuran gambar */
            margin-right: 5px;
            /* Jarak antara gambar dan teks */
            vertical-align: middle;
            /* Menjaga gambar sejajar dengan teks */
            border-radius: 50%;
            /* Membuat gambar menjadi bulat */
            border: 2px solid #F3EAC2;
            /* Border untuk gambar */
            transition: transform 0.2s;
            /* Efek transisi saat hover */
        }

        .profile-icon:hover {
            transform: scale(1.1);
            /* Membesarkan gambar saat hover */
        }

        .navbar-custom .nav-item {
            margin-left: 15px;
            /* Jarak antar item navbar */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('mainpage') }}">Kos-Kosan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        @if (Auth::user()->role === 'owner' || Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route(Auth::user()->role . '.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Manajemen
                                </a>
                        @endif
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->role === 'owner' || Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('kosan.manage') }}">Manajemen Kosan</a></li>
                            @endif
                            @if (Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('user.manage') }}">Manajemen Pengguna</a></li>
                            @endif
                        </ul>

                        </li>
                    @endauth

                    @auth
                        @if (Auth::user()->role === 'user')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('favorite.index') }}">Favorit</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('transaction.index') }}">Transaksi</a>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"
                                onclick="return confirm('Silakan login untuk mengakses fitur ini.')">Favorit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"
                                onclick="return confirm('Silakan login untuk mengakses fitur ini.')">Transaksi</a>
                        </li>
                    @endguest
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropstart">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/use.png') }}"
                                    alt="Profile Icon" class="profile-icon">
                                Profil
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Atur Profil</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn btn-link">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <script src="{{ asset('js/bootstrap.min.bundle.js') }}"></script>
</body>

</html>
