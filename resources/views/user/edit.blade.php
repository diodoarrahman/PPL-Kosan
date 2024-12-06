@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container">
        <h1 class="mb-4">Edit Pengguna</h1>

        <!-- Form untuk mengedit pengguna -->
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Pengguna</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                    required>
            </div>

            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    <option value="owner" {{ old('role', $user->role) == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="password">Password (Kosongkan jika tidak ingin diubah)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group mt-3">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary mt-4 ml-2">Kembali</a>
        </form>
    </div>
@endsection
