<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nama" required>
        @error('name')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <input type="email" name="email" placeholder="Email" required>
        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <input type="password" name="password" placeholder="Password" required>
        @error('password')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

        <!-- Pilihan Role -->
        <label for="role">Pilih Peran:</label>
        <select name="role" required>
            <option value="" disabled selected>Pilih Peran</option>
            <option value="user">User</option>
            <option value="owner">Owner</option>
        </select>
        @error('role')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">Register</button>
    </form>    
</body>
</html>
