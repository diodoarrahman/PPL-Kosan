<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f4f4f9, #e0e0e0);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-5px);
        }

        .btn-custom {
            background-color: #6cbd64;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #5a9e59;
            transform: scale(1.05);
        }

        .form-control {
            border-radius: 8px;
            box-shadow: none;
            border: 1px solid #ddd;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #6cbd64;
            box-shadow: 0 0 0 0.2rem rgba(108, 189, 100, 0.25);
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        a {
            color: #6cbd64;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #5a9e59;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/KOSTPEDIA.png') }}" alt="Logo" style="max-width: 150px;">
        </div>
        <h3 class="text-center mb-4">Login</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Login</button>
            <p class="text-center mt-3">Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
