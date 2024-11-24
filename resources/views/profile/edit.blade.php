<!-- resources/views/profile/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="profile-header">
        <h1>Edit Profil</h1>
    </div>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if (auth()->user()->profile_photo)
            <div class="mb-3">
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Foto Profil" class="img-thumbnail"
                    style="width: 150px; height: 150px;">
            </div>
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nama:</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="gender">Gender:</label>
            <select name="gender" class="form-select mb-0" id="gender" aria-label="Gender select example" required>
                <option value="" disabled>Choose...</option>
                <option value="Female" {{ old('gender', auth()->user()->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Male" {{ old('gender', auth()->user()->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Other" {{ old('gender', auth()->user()->gender) == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-sm-9 mb-3">
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input name="address" class="form-control" id="address" type="text"
                        placeholder="Enter your home address" value="{{ old('address', auth()->user()->address) }}">
                </div>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="profile_photo" class="form-label">Ganti Profile:</label>
            <input type="file" class="form-control" name="profile_photo" accept="image/*">
            @error('profile_photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
@endsection
