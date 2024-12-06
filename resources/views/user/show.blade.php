@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Pengguna</h1>
        
        <!-- Menampilkan detail pengguna -->
        <div class="card">
            <div class="card-header">
                <h3>{{ $user->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>

                <!-- Jika ada field lain yang ingin ditampilkan, bisa ditambahkan di sini -->
                <p><strong>Terdaftar pada:</strong> {{ $user->created_at->format('d-m-Y') }}</p>
                <p><strong>Terakhir diperbarui:</strong> {{ $user->updated_at->format('d-m-Y') }}</p>

                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit Pengguna</a>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Pengguna</button>
                </form>
            </div>
        </div>
    </div>
@endsection
