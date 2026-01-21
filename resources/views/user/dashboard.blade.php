@extends('layouts.admin')

@section('title','Dashboard User')

@section('content')
<div class="container-fluid">

    <!-- Row statistik -->
    <div class="row">
        <!-- Card 1: Total Peminjaman -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Peminjaman</h5><br>
                    <h2>{{ $totalPinjam ?? 0 }}</h2>
                    <p>Berapa kali kamu pernah meminjam alat safety.</p>
                </div>
            </div>
        </div>

        <!-- Card 2: Sudah Dikembalikan -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Sudah Dikembalikan</h5><br>
                    <h2>{{ $totalKembali ?? 0 }}</h2>
                    <p>Jumlah peminjaman yang sudah selesai dan dikembalikan.</p>
                </div>
            </div>
        </div>

        <!-- Card 3: Sedang Dipinjam -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    <h5 class="card-title">Sedang Dipinjam</h5><br>
                    <h2>{{ $totalSedang ?? 0 }}</h2>
                    <p>Jumlah alat yang masih sedang kamu pinjam.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Row Informasi Web -->
    <div class="row">
        <!-- Card 4: Kegunaan Web -->
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Kegunaan Web
                </div>
                <div class="card-body">
                    <p>
                        Web ini digunakan untuk mempermudah proses peminjaman alat safety di perusahaan.
                        User dapat melihat alat tersedia, mengajukan peminjaman, dan melakukan pengembalian.
                        Admin dapat memantau peminjaman, mengelola alat, dan menghasilkan bukti peminjaman.
                    </p>
                </div>
            </div>
        </div>

        <!-- Card 5: Tutorial Singkat -->
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    Tutorial Singkat
                </div>
                <div class="card-body">
                    <ol>
                        <li>Login ke akun kamu.</li>
                        <li>Pilih menu <b>Alat Safety</b> untuk melihat daftar alat tersedia.</li>
                        <li>Ajukan peminjaman dengan klik <b>Pinjam</b> dan pilih jumlah alat.</li>
                        <li>Setelah disetujui admin, cetak bukti peminjaman PDF.</li>
                        <li>Kembalikan alat tepat waktu dan upload foto serah terima.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
