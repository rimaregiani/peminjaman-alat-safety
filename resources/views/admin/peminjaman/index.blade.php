@extends('layouts.admin')
@section('title','Pengajuan Peminjaman Alat')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Pengajuan Peminjaman</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="adminPinjamTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Nama Alat</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Pinjam</th>
                    <th>Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pinjam as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->alat->nama_alat }}</td>
                    <td>{{ $p->jumlah }}</td>
                    <td>{{ ucfirst($p->status) }}</td>
                    <td>{{ $p->tgl_pinjam ?? '-' }}</td>
                    <td>{{ $p->tgl_kembali ?? '-' }}</td>
                    <td>
                        @if($p->status=='pending')
                            <a href="{{ route('admin.peminjaman.approve', $p) }}" class="btn btn-success btn-sm">Approve</a>
                            <a href="{{ route('admin.peminjaman.reject', $p) }}" class="btn btn-danger btn-sm">Reject</a>
                        @endif

                        @if($p->status=='approved')
                            <a href="{{ route('admin.peminjaman.pdf', $p) }}" class="btn btn-info btn-sm" target="_blank">PDF</a>

                            <a href="{{ route('admin.peminjaman.return', $p) }}" class="btn btn-warning btn-sm">Return</a>
                        @endif

                        @if($p->status=='dikembalikan')
                            <span class="badge badge-success">Sudah Dikembalikan</span>
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
    $('#adminPinjamTable').DataTable({
        responsive:true,
        autoWidth:false
    });
});
</script>
@endsection
