@extends('layouts.admin')

@section('title','Dashboard Admin')

@section('content')
<div class="container-fluid">

    <!-- Row Statistik -->
    <div class="row">
        <!-- Card 1: Total Peminjaman -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Peminjaman</h5><br>
                    <h2>{{ $totalPinjam ?? 0 }}</h2>
                    <p>Semua peminjaman di sistem.</p>
                </div>
            </div>
        </div>

        <!-- Card 2: Sudah Dikembalikan -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Sudah Dikembalikan</h5><br>
                    <h2>{{ $totalKembali ?? 0 }}</h2>
                    <p>Peminjaman yang sudah selesai.</p>
                </div>
            </div>
        </div>

        <!-- Card 3: Sedang Dipinjam -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    <h5 class="card-title">Sedang Dipinjam</h5><br>
                    <h2>{{ $totalSedang ?? 0 }}</h2>
                    <p>Peminjaman yang masih berlangsung.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Row Informasi Web & Tutorial -->
    <div class="row">
        <!-- Card Kegunaan Web -->
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Kegunaan Web
                </div>
                <div class="card-body">
                    <p>
                        Sistem ini mempermudah proses peminjaman alat safety. 
                        Admin dapat memantau peminjaman, mengelola alat, dan membuat bukti peminjaman PDF. 
                        User dapat melihat alat tersedia, mengajukan peminjaman, dan melakukan pengembalian.
                    </p>
                </div>
            </div>
        </div>

        <!-- Card Tutorial Singkat -->
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    Tutorial Singkat
                </div>
                <div class="card-body">
                    <ol>
                        <li>Login ke akun admin.</li>
                        <li>Lihat statistik peminjaman di dashboard.</li>
                        <li>Kelola data alat & kategori di menu masing-masing.</li>
                        <li>Setujui pengajuan peminjaman user.</li>
                        <li>Generate bukti peminjaman PDF setelah approve.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
