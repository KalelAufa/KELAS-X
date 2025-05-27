<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin LARAVEL Restoran</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --dark-bg: #343a40;
        }
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }
        .card-header i {
            font-size: 48px;
            margin-bottom: 10px;
            display: block;
        }
        .form-floating label {
            padding-left: 1.25rem;
        }
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            padding-left: 0.75rem;
        }
        .btn-login {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 8px;
        }
        .card-footer {
            background-color: transparent;
            border-top: 1px solid rgba(0,0,0,0.05);
            text-align: center;
            padding: 15px;
        }
        .restaurant-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .restaurant-logo h1 {
            color: var(--secondary-color);
            font-weight: 700;
            font-size: 28px;
            margin: 0;
        }
        .restaurant-logo p {
            color: var(--primary-color);
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="restaurant-logo">
            <h1><i class="fas fa-utensils"></i> LARAVEL Restoran</h1>
            <p>Management System</p>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-user-shield"></i>
                <h2 class="text-center mb-0">Login Admin</h2>
                <p class="text-center mb-0">Masuk ke panel admin</p>
            </div>
            <div class="card-body p-4">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ url('admin/postlogin') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control" type="email" name="email" id="email" placeholder="name@example.com">
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-login" type="submit">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="{{ url('/') }}" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>Kembali ke Halaman Utama
                </a>
            </div>
        </div>

        <div class="text-center mt-3 text-muted">
            <small>&copy; {{ date('Y') }} LARAVEL Restoran. All rights reserved.</small>
        </div>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
