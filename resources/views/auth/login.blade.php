<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Peminjaman Alat Safety</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background: url('https://www.svgrepo.com/show/331913/safety-vector.svg') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-card .form-control {
            height: calc(2.5rem + 2px);
        }

        .login-card .btn-primary {
            width: 100%;
        }

        .login-card .login-logo {
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .login-card a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-logo">
        <span>Peminjaman <b>Alat Safety</b></span>
    </div>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
            </div>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <!-- Login Button -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Log In</button>
        </div>

        <!-- Forgot Password -->
        @if(Route::has('password.request'))
            <div class="text-center">
                <a href="{{ route('password.request') }}">Forgot Your Password?</a>
            </div>
        @endif
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
