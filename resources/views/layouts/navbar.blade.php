<!-- resources/views/layouts/navbar.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kos-Kosan</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />

</head>
<body>
    <!-- Tempat Navbar akan ditaruh -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('mainpage') }}">Kos-Kosan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Menu Favorit dan Transaksi untuk pengguna yang login -->
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('favorite.index') }}">Favorit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('transaction.index') }}">Transaksi</a>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" onclick="return confirm('Silakan login untuk mengakses fitur ini.')">Favorit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" onclick="return confirm('Silakan login untuk mengakses fitur ini.')">Transaksi</a>
                        </li>
                    @endguest
                </ul>
                <ul class="navbar-nav ms-auto">
                    <!-- Dropdown Profile Menu -->
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profil
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Atur Profile</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn btn-link">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!-- Dashboard Menu -->
                        @if(Auth::user()->role === 'owner' || Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route(Auth::user()->role . '.dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                        <!-- Manajemen Kosan -->
                        @if(Auth::user()->role === 'owner' || Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('kosan.manage') }}">Manajemen Kosan</a>
                            </li>
                        @endif
                        <!-- Manajemen Pengguna untuk Admin -->
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.manage') }}">Manajemen Pengguna</a>
                            </li>
                        @endif
                    @else
                        <!-- Menu Login dan Register untuk Guest -->
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

    {{-- <script src="{{"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"}}"></script> --}}
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
</body>
</html>
