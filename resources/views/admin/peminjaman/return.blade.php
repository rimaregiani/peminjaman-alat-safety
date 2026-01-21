@extends('layouts.admin')
@section('title','Pengembalian Alat')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Pengembalian</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.peminjaman.return.store', $peminjaman) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Upload Foto Serah Terima</label>
                <input type="file" name="foto_serah_terima" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Pengembalian</button>
            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@endsection
