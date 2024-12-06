<!-- resources/views/user/manage.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Manajemen Pengguna</h1>
        <p>Halaman ini hanya bisa diakses oleh admin untuk manajemen pengguna.</p>

        <!-- Tabel Pengguna dengan Role "User" -->
        <div class="mt-4">
            <h2>Pengguna dengan Role "User"</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @if ($user->role == 'user')
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('user.create') }}" class="btn btn-primary mt-2">Tambah Pengguna</a>
        </div>

        <!-- Tabel Pengguna dengan Role "Owner" -->
        <div class="mt-5">
            <h2>Pengguna dengan Role "Owner"</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @if ($user->role == 'owner')
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('user.create') }}" class="btn btn-primary mt-2">Tambah Owner</a>
        </div>
    </div>
@endsection
