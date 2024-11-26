@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4" style="color: #2C6E49; font-weight: bold;">Dashboard Owner</h1>
        <p class="text-center" style="font-size: 1.1rem;">
            Selamat datang {{ auth()->user()->name }}, di dashboard untuk pengelola kosan Anda.
        </p>
        

        <!-- Statistik -->
        <div class="row text-center mb-5">
            <div class="col-md-3">
                <div class="card shadow-sm" style="background-color: #FFF8DC; border-radius: 10px;">
                    <div class="card-body">
                        <h5 style="color: #2C6E49;">Total Kosan</h5>
                        <h2 style="color: #2C6E49; font-weight: bold;">{{ $totalKosan }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm" style="background-color: #FFF8DC; border-radius: 10px;">
                    <div class="card-body">
                        <h5 style="color: #2C6E49;">Total Kamar Tersedia</h5>
                        <h2 style="color: #2C6E49; font-weight: bold;">{{ $totalKamar }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm" style="background-color: #FFF8DC; border-radius: 10px;">
                    <div class="card-body">
                        <h5 style="color: #2C6E49;">Kamar Disewakan</h5>
                        <h2 style="color: #2C6E49; font-weight: bold;">{{ $kamarDisewakan }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm" style="background-color: #FFF8DC; border-radius: 10px;">
                    <div class="card-body">
                        <h5 style="color: #2C6E49;">Total Pendapatan</h5>
                        <h2 style="color: #2C6E49; font-weight: bold;">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Kosan -->
        <h3 class="mb-4" style="color: #2C6E49; font-weight: bold;">Detail Kosan Anda</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr style="color: #2C6E49; font-weight: bold;">
                        <th>Nama Kosan</th>
                        <th>Kamar Tersedia</th>
                        <th>Kamar Disewakan</th>
                        <th>Pendapatan (Rp)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kosans as $kosan)
                        <tr>
                            <td>{{ $kosan->nama_kosan }}</td>
                            <td>{{ $kosan->kamar_tersedia }}</td>
                            <td>{{ $kosan->kamar_disewakan ?? 0 }}</td>
                            <td>{{ number_format($kosan->pendapatan ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('kosan.edit', $kosan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('kosan.destroy', $kosan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data kosan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tambahkan Kosan -->
        <div class="text-center mt-4">
            <a href="{{ route('kosan.create') }}" class="btn btn-success" style="background-color: #2C6E49; color: #FFF8DC; border-radius: 10px;">
                Tambahkan Kosan Baru
            </a>
        </div>
    </div>
@endsection
