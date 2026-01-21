@extends('layouts.admin')
@section('title','Ajukan Peminjaman Alat')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Pengajuan Peminjaman</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('user.peminjaman.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Pilih Alat</label>
                <select name="alat_id" class="form-control" required>
                    <option value="">-- Pilih Alat --</option>
                    @foreach($alat as $a)
                        <?php
                        $dipinjam = \App\Models\PeminjamanAlat::where('alat_id',$a->id)
                                        ->whereIn('status',['pending','approved'])->sum('jumlah');
                        $stok_tersedia = $a->stok - $dipinjam;
                        ?>
                        <option value="{{ $a->id }}" {{ old('alat_id')==$a->id ? 'selected' : '' }}>
                            {{ $a->nama_alat }} (Stok tersedia: {{ $stok_tersedia }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Jumlah yang Dipinjam</label>
                <input type="number" name="jumlah" class="form-control" min="1" value="{{ old('jumlah') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajukan</button>
            <a href="{{ route('user.peminjaman.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('stock_error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: '{{ session('stock_error') }}',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'OK'
});
</script>
@endif

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    confirmButtonColor: '#3085d6',
});
</script>
@endif
@endsection
