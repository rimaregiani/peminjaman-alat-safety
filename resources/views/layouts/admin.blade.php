<!DOCTYPE html>
<html>
<head>
    <title>Peminjaman Alat Safety</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">

    @vite(['resources/js/app.js']) <!-- optional kalau masih pakai Vite -->
</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

<!-- NAVBAR -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">☰</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </ul>
</nav>

<!-- SIDEBAR -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a class="brand-link text-center">
        <span class="brand-text">Peminjaman Alat</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">
        @if(auth()->user()->role == 'admin')
            <li class="nav-item">
                <a href="/admin/dashboard" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.category.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Category</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.alat_safety.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-hard-hat"></i>
                    <p>Master Alat Safety</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.peminjaman.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>Pengajuan Peminjaman</p>
                </a>
            </li>
        @endif

        @if(auth()->user()->role == 'user')
            <li class="nav-item">
                <a href="/user/dashboard" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.peminjaman.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-hand-holding"></i>
                    <p>Peminjaman Alat</p>
                </a>
            </li>
        @endif

            <li class="nav-item">
                <a href="/profile" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>Profile</p>
                </a>
            </li>
        </ul>
        </nav>
    </div>
</aside>

<!-- CONTENT -->
<div class="content-wrapper p-4">
    @yield('content')
</div>

</div>

<!-- JS Dependencies (penting!) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

@yield('scripts') <!-- ini buat JS di blade index -->

</body>
</html>
