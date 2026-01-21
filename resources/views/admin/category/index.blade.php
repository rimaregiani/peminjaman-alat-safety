@extends('layouts.admin')

@section('title', 'Category')

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center">
    <h3 class="card-title">Category List</h3>
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm ml-auto">+ Tambah Category</a>
</div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="categoryTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->category_code }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('admin.category.destroy', $category) }}" method="POST" style="display:inline" class="delete-form">
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
    // DataTables init
    $('#categoryTable').DataTable({
        responsive: true,
        autoWidth: false,
        searching: true,
        paging: true,
        info: true,
        ordering: true
    });

    // SweetAlert konfirmasi delete
    $('.delete-form').on('submit', function(e){
        e.preventDefault();
        var form = this;
        Swal.fire({
            title: 'Hapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed){
                form.submit();
            }
        });
    });
});
</script>
@endsection
