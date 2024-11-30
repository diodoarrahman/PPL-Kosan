@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Dashboard Admin</h1>

        <!-- Row for overview cards -->
        <div class="row mb-4">
            <!-- Total Kosan -->
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Kosan</h5>
                        <p class="card-text">{{ $totalKosans }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Transaksi -->
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Transaksi</h5>
                        <p class="card-text">{{ $totalTransactions }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Pemilik Kosan -->
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Pemilik Kosan</h5>
                        <p class="card-text">{{ $totalOwners }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Pengguna -->
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Pengguna</h5>
                        <p class="card-text">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="row">
            <div class="col-md-6">
                <canvas id="kosanChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="transactionChart"></canvas>
            </div>
        </div>

        <!-- Data Tables -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Kosan yang Terdaftar</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kosan</th>
                            <th>Alamat</th>
                            <th>Harga</th>
                            <th>Jumlah Kamar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kosans as $kosan)
                            <tr>
                                <td>{{ $kosan->id }}</td>
                                <td>{{ $kosan->nama_kosan }}</td>
                                <td>{{ $kosan->alamat_kosan }}</td>
                                <td>{{ number_format($kosan->harga_kosan) }}</td>
                                <td>{{ $kosan->kamar_tersedia }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-12 mt-4">
                <h3>Transaksi yang Terjadi</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pengguna</th>
                            <th>Kosan</th>
                            <th>Tanggal Transaksi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->kosan->nama_kosan }}</td>
                                <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                <td>{{ $transaction->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-12 mt-4">
                <h3>Pemilik Kosan</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pemilik</th>
                            <th>Kosan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($owners as $owner)
                            <tr>
                                <td>{{ $owner->id }}</td>
                                <td>{{ $owner->name }}</td>
                                <td>
                                    @foreach ($owner->kosans as $kosan)
                                        <span>{{ $kosan->nama_kosan }}</span><br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-12 mt-4">
                <h3>Pengguna Terdaftar</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctxKosan = document.getElementById('kosanChart').getContext('2d');
        var ctxTransaction = document.getElementById('transactionChart').getContext('2d');

        var kosanChart = new Chart(ctxKosan, {
            type: 'bar',
            data: {
                labels: ['Total Kosan', 'Kosans Available', 'Kosans Rented'],  // Example categories
                datasets: [{
                    label: 'Kosan Data',
                    data: [{{ $totalKosans }}, {{ $availableKosans }}, {{ $rentedKosans }}], // Example data
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            }
        });

        var transactionChart = new Chart(ctxTransaction, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April'], // Example months
                datasets: [{
                    label: 'Transactions per Month',
                    data: [12, 19, 3, 5], // Example data
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }
        });
    </script>
@endsection
