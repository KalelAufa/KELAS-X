<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LARAVEL Restoran</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        .navbar-brand img {
            transition: transform 0.3s ease;
        }
        .navbar-brand img:hover {
            transform: scale(1.05);
        }
        .nav-link {
            color: #495057;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #0d6efd;
        }
        .category-list {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .list-group-item {
            border-left: none;
            border-right: none;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }
        .list-group-item:hover {
            background-color: #f0f7ff;
            transform: translateX(5px);
        }
        .list-group-item a {
            text-decoration: none;
            color: #495057;
            display: block;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 30px 0;
            margin-top: 50px;
            border-radius: 10px 10px 0 0;
        }
        .main-content {
            min-height: 70vh;
            padding: 20px 0;
        }
        .cart-icon {
            position: relative;
        }
        .cart-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <nav class="navbar navbar-expand-lg bg-white rounded">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}"><img style="width: 150px" src="{{ asset('gambar/logo.png') }}" alt="Restaurant Logo"></a>
                    <ul class="navbar-nav gap-3 align-items-center">
                        @if (session()->has('cart'))
                            <li class="nav-item cart-icon">
                                <a href="{{ url('cart') }}" class="nav-link">
                                    <i class="fas fa-shopping-cart fa-lg"></i>
                                    <span class="cart-badge">
                                        @php
                                            $total = count(session('cart'));
                                            echo $total;
                                        @endphp
                                    </span>
                                </a>
                            </li>
                        @else
                            <li class="nav-item"><a href="{{ url('cart') }}" class="nav-link"><i class="fas fa-shopping-cart fa-lg"></i></a></li>
                        @endif
                        @if (session()->missing('pelanggan'))
                            <li class="nav-item"><a href="{{ url('register') }}" class="nav-link btn btn-outline-primary btn-sm px-3">Register</a></li>
                            <li class="nav-item"><a href="{{ url('login') }}" class="nav-link btn btn-primary btn-sm px-3">Login</a></li>
                        @else
                            <li class="nav-item"><a href="{{ url('profile') }}" class="nav-link"><i class="fas fa-user-circle me-1"></i> {{ session('pelanggan')['pelanggan'] }}</a></li>
                            <li class="nav-item"><a href="{{ url('logout') }}" class="nav-link text-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
        <div class="row mt-4 main-content">
            <div class="col-md-3 col-lg-2">
                <div class="category-list">
                    <div class="list-group-item bg-primary text-white">
                        <i class="fas fa-list me-2"></i> Categories
                    </div>
                    @if (isset($kategoris) && $kategoris->count())
                        @foreach ($kategoris as $kategori)
                            <div class="list-group-item">
                                <a href="{{ url('show/'.$kategori->idkategori) }}">
                                    <i class="fas fa-utensils me-2"></i> {{ $kategori->kategori }}
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="list-group-item">No categories available</div>
                    @endif
                </div>
            </div>
            <div class="col-md-9 col-lg-10">
                @yield('content')
            </div>
        </div>
        <div class="footer text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>We serve delicious food with the best ingredients and recipes.</p>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p><i class="fas fa-phone me-2"></i> +123 456 7890</p>
                    <p><i class="fas fa-envelope me-2"></i> info@restaurant.com</p>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <p>&copy; 2023 LARAVEL Restoran. All rights reserved.</p>
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
