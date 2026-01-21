@extends('layouts.admin')
@section('title','Edit Profile')

@section('content')
<div class="row">
    <div class="col-12">

        <!-- Update Profile Info -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Update Profile Information</h3>
            </div>
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="card card-primary mt-3">
            <div class="card-header">
                <h3 class="card-title">Update Password</h3>
            </div>
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account -->
        <div class="card card-danger mt-3">
            <div class="card-header">
                <h3 class="card-title">Delete Account</h3>
            </div>
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('status') == 'profile-updated')
<script>
Swal.fire({
    icon: 'success',
    title: 'Profile Updated!',
    text: 'Informasi profile berhasil diperbarui.',
    confirmButtonColor: '#3085d6',
});
</script>
@endif

@if(session('status') == 'password-updated')
<script>
Swal.fire({
    icon: 'success',
    title: 'Password Updated!',
    text: 'Password berhasil diperbarui.',
    confirmButtonColor: '#3085d6',
});
</script>
@endif

@if(session('status') == 'account-deleted')
<script>
Swal.fire({
    icon: 'success',
    title: 'Account Deleted!',
    text: 'Akun berhasil dihapus.',
    confirmButtonColor: '#3085d6',
});
</script>
@endif
@endsection
