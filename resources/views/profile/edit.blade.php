<!-- resources/views/profile/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Profil</h1>
    <form action="{{ route('profile.edit') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama:</label>
            <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
@endsection