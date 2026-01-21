@extends('layouts.admin')
@section('title','Pengajuan Peminjaman Alat')
@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title">Daftar Pengajuan Saya</h3>
        <a href="{{ route('user.peminjaman.create') }}" class="btn btn-primary btn-sm ml-auto">+ Ajukan Peminjaman</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table id="pinjamTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Alat</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pinjam as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->alat->nama_alat }}</td>
                    <td>{{ $p->jumlah }}</td>
                    <td>{{ ucfirst($p->status) }}</td>
                    <td>{{ $p->tgl_pinjam ?? '-' }}</td>
                    <td>{{ $p->tgl_kembali ?? '-' }}</td>
                    <td>
                        {{ ucfirst($p->status) }}

                        @if($p->status == 'approved')
                            <a href="{{ route('user.peminjaman.pdf', $p) }}" target="_blank" class="btn btn-info btn-sm">PDF</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#pinjamTable').DataTable({
        responsive:true,
        autoWidth:false
    });
});
</script>
@endsection
