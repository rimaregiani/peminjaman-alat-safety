@extends('layouts.admin')
@section('title','Edit Alat Safety')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Alat Safety</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.alat_safety.update', $alat_safety) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Alat</label>
                <input type="text" name="nama_alat" class="form-control" value="{{ $alat_safety->nama_alat }}" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih Category --</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" @if($alat_safety->category_id == $c->id) selected @endif>
                            {{ $c->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $alat_safety->stok }}" min="0" required>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control" value="{{ $alat_safety->lokasi }}">
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ $alat_safety->keterangan }}</textarea>
            </div>
            <div class="form-group">
                <label>Foto Alat</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                @if($alat_safety->foto)
                    <img src="{{ asset('uploads/alat_safety/'.$alat_safety->foto) }}" width="100" class="mt-2">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.alat_safety.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
