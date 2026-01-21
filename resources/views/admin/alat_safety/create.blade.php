@extends('layouts.admin')
@section('title','Tambah Alat Safety')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Alat Safety</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.alat_safety.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama Alat</label>
                <input type="text" name="nama_alat" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih Category --</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" min="0" required>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control">
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Foto Alat</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.alat_safety.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
