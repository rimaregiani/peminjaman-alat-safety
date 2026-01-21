@extends('layouts.admin')

@section('title','Master Alat Safety')

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title">Master Alat Safety</h3>
        <a href="{{ route('admin.alat_safety.create') }}" class="btn btn-primary btn-sm ml-auto">+ Tambah Alat</a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="alatTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Alat</th>
                    <th>Nama Alat</th>
                    <th>Category</th>
                    <th>Stok</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Foto</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alat as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->kode_alat }}</td>
                    <td>{{ $a->nama_alat }}</td>
                    <td>{{ $a->category->category_name }}</td>
                    <td>{{ $a->stok }}</td>
                    <td>{{ $a->lokasi ?? '-' }}</td>
                    <td>{{ $a->keterangan ?? '-' }}</td>
                    <td>
                        @if($a->foto)
                            <img src="{{ asset('uploads/alat_safety/'.$a->foto) }}" width="50">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $a->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('admin.alat_safety.edit', $a) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.alat_safety.destroy', $a) }}" method="POST" style="display:inline" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>

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
    $('#alatTable').DataTable({
        responsive:true,
        autoWidth:false,
        searching:true,
        paging:true,
        info:true,
        ordering:true
    });

    $('.delete-form').on('submit', function(e){
        e.preventDefault();
        var form = this;
        Swal.fire({
            title:'Hapus data?',
            icon:'warning',
            showCancelButton:true,
            confirmButtonText:'Ya, hapus!',
            cancelButtonText:'Batal'
        }).then(result=>{ if(result.isConfirmed) form.submit(); });
    });
});
</script>
@endsection
