@extends('layouts.admin')

@section('title', 'Tambah Category')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf

            

            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="category_name" class="form-control" required>
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
