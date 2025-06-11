<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin LARAVEL Restoran</title>
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
        }
        .sidebar {
            background-color: var(--secondary-color);
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: calc(100vh - 180px);
            position: sticky;
            top: 100px;
        }
        .sidebar .list-group-item {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        .sidebar .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        .sidebar .list-group-item a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 8px 0;
        }
        .sidebar .list-group-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .admin-navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 15px;
        }
        .admin-navbar h2 {
            color: var(--secondary-color);
            margin: 0;
            font-weight: 600;
        }
        .admin-navbar .navbar-nav .nav-item a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .admin-navbar .navbar-nav .nav-item a:hover {
            color: var(--primary-color);
        }
        .content-area {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            min-height: calc(100vh - 180px);
        }
        .footer {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 14px;
        }
        .user-info {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .user-info i {
            font-size: 24px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="mb-4">
            <nav class="navbar navbar-expand-lg admin-navbar">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <h2><i class="fas fa-utensils me-2"></i>Admin Restoran</h2>
                    <ul class="navbar-nav gap-3 d-flex flex-row">
                        @if(Auth::check())
                            <li class="nav-item"><a href="#"><i class="fas fa-user me-1"></i>{{ Auth::user()->name }}</a></li>
                            <li class="nav-item"><a href="#"><i class="fas fa-tag me-1"></i>Level: {{ Auth::user()->level }}</a></li>
                            <li class="nav-item"><a href="{{ url('admin/logout') }}" class="text-danger"><i class="fas fa-sign-out-alt me-1"></i>Logout</a></li>
                        @else
                            <li class="nav-item"><a href="{{ url('login') }}"><i class="fas fa-sign-in-alt me-1"></i>Login</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
        <div class="row">
            @if(Auth::check())
            <div class="col-md-3 mb-4">
                <div class="sidebar p-3">
                    @if(Auth::check())
                    <div class="user-info">
                        <i class="fas fa-user-circle"></i>
                        <div>
                            <div>{{ Auth::user()->name }}</div>
                            <small>{{ Auth::user()->level }}</small>
                        </div>
                    </div>
                    @endif
                    <ul class="list-group">
                        @if (Auth::check() && Auth::user()->level == 'admin')
                            <li class="list-group-item"><a href="{{ url('admin/user') }}"><i class="fas fa-users"></i> User Management</a></li>
                            <li class="list-group-item"><a href="{{ url('admin/dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        @endif
                        @if (Auth::check() && Auth::user()->level == 'kasir')
                            <li class="list-group-item"><a href="{{ url('admin/order') }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                            <li class="list-group-item"><a href="{{ url('admin/orderdetail') }}"><i class="fas fa-receipt"></i> Order Details</a></li>
                        @endif
                        @if (Auth::check() && Auth::user()->level == 'manager')
                            <li class="list-group-item"><a href="{{ url('admin/dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="list-group-item"><a href="{{ url('admin/pelanggan') }}"><i class="fas fa-user-friends"></i> Customers</a></li>
                            <li class="list-group-item"><a href="{{ url('admin/kategori') }}"><i class="fas fa-tags"></i> Categories</a></li>
                            <li class="list-group-item"><a href="{{ url('admin/menu') }}"><i class="fas fa-utensils"></i> Menu Items</a></li>
                            <li class="list-group-item"><a href="{{ url('admin/order') }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                            <li class="list-group-item"><a href="{{ url('admin/orderdetail') }}"><i class="fas fa-receipt"></i> Order Details</a></li>
                            <li class="list-group-item"><a href="{{ url('admin/reports') }}"><i class="fas fa-chart-bar"></i> Reports</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="content-area">
                    @yield('admincontent')
                </div>
            </div>
            @else
            <div class="col-12">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i> Please log in to access the admin panel.
                    <a href="{{ url('login') }}" class="btn btn-sm btn-primary ms-3">Login Now</a>
                </div>
            </div>
            @endif
        </div>
        <div class="footer">
            <div class="row">
                <div class="col-md-6 text-md-start">
                    &copy; {{ date('Y') }} Restaurant Management System
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
