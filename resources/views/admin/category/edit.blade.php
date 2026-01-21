@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.category.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Category Code</label>
                <input type="text" name="category_code"
                       value="{{ $category->category_code }}"
                       class="form-control" readonly>
            </div>

            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="category_name"
                       value="{{ $category->category_name }}"
                       class="form-control" required>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
