<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ayam Goreng JOSS') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Ayam Goreng JOSS - Custom Navbar Styling */
        html::-webkit-scrollbar{
            display: none;
        }
        /* Main styling - Spicy Theme */
        :root {
            --primary-color: #FF3D00;
            --secondary-color: #B71C1C;
            --accent-color: #FFD54F;
            --light-color: #FFFDE7;
            --dark-color: #1A1A1A;
            --spicy-gradient: linear-gradient(135deg, #FF3D00, #FF6D00);
            --fire-glow: 0 0 15px rgba(255, 61, 0, 0.7);
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navbar container */
        .navbar {
            background: var(--spicy-gradient);
            padding: 0;
            box-shadow: 0 4px 15px rgba(183, 28, 28, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 2px solid var(--secondary-color);
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Brand logo - Spicy Theme */
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            padding: 15px 0;
            position: relative;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s, text-shadow 0.3s;
            display: flex;
            align-items: center;
        }

        .navbar-brand:before {
            content: '🔥';
            margin-right: 8px;
            font-size: 1.2em;
            animation: flicker 2s infinite alternate;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            text-shadow: var(--fire-glow);
        }

        @keyframes flicker {
            0%, 100% { opacity: 1; }
            25% { opacity: 0.8; }
            50% { opacity: 1; }
            75% { opacity: 0.9; }
        }

        /* Hamburger menu */
        .navbar-toggler {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 10px;
            display: none;
        }

        .navbar-toggler-icon {
            display: block;
            width: 25px;
            height: 3px;
            background-color: white;
            position: relative;
            transition: background-color 0.3s;
        }

        .navbar-toggler-icon:before,
        .navbar-toggler-icon:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: white;
            transition: transform 0.3s;
        }

        .navbar-toggler-icon:before {
            transform: translateY(-8px);
        }

        .navbar-toggler-icon:after {
            transform: translateY(8px);
        }

        /* Nav links container */
        .navbar-collapse {
            display: flex;
            flex-grow: 1;
            justify-content: space-between;
        }

        /* Nav links */
        .navbar-nav {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            padding: 25px 18px;
            display: inline-block;
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            bottom: 15px;
            left: 50%;
            width: 0;
            height: 3px;
            background-color: var(--accent-color);
            transform: translateX(-50%);
            transition: width 0.3s, box-shadow 0.3s;
            border-radius: 3px;
        }

        .nav-link:hover {
            color: var(--accent-color);
        }

        .nav-link:hover:after {
            width: 70%;
            box-shadow: 0 0 10px var(--accent-color), 0 0 20px rgba(255, 213, 79, 0.4);
        }

        /* Dropdown styling */
        .dropdown-toggle {
            position: relative;
            padding-right: 25px;
        }

        .dropdown-toggle:after {
            content: '▼';
            font-size: 0.7em;
            margin-left: 5px;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: rgb(40, 40, 40);
            border-radius: 8px;
            border: 1px solid var(--primary-color);
            min-width: 180px;
            box-shadow: 0 5px 15px rgba(255, 61, 0, 0.25);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s;
            padding: 10px 0;
            z-index: 100;
            background-image: radial-gradient(circle at top right, rgba(255, 61, 0, 0.2), transparent 70%);
        }

        .dropdown-item {
            display: block;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 61, 0, 0.8);
            color: white;
            border-left: 3px solid var(--accent-color);
            transform: translateX(5px);
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Active state */
        .nav-item.active .nav-link {
            color: var(--accent-color);
        }

        .nav-item.active .nav-link:after {
            width: 70%;
        }

        /* Cart item with badge - Spicy Theme */
        .nav-item:nth-child(3) .nav-link {
            position: relative;
        }

        .nav-item:nth-child(3) .nav-link:before {
            content: '🔥';
            margin-right: 5px;
            display: inline-block;
            transform-origin: center;
            animation: shake 2s infinite;
        }

        @keyframes shake {
            0%, 100% { transform: rotate(0deg); }
            10% { transform: rotate(-10deg); }
            20% { transform: rotate(10deg); }
            30% { transform: rotate(0deg); }
        }

        /* Special animation for promo link */
        .nav-item:nth-child(4) .nav-link {
            animation: pulse 2s infinite;
            color: var(--accent-color);
            font-weight: 600;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* User menu styling - Spicy Theme */
        .user-menu {
            display: flex;
            align-items: center;
        }

        .user-menu .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 20px 18px;
            text-shadow: 0 0 5px rgba(255, 61, 0, 0.5);
            transition: text-shadow 0.3s;
        }

        /* Remove the underline effect for user dropdown specifically */
        .user-menu .nav-link:after {
            display: none;
        }

        .user-menu .nav-link:before {
            content: '🌶️';
            font-size: 1.1em;
        }

        .user-menu .nav-link:hover {
            text-shadow: 0 0 10px rgba(255, 61, 0, 0.8);
        }

        /* Make sure dropdown toggle doesn't have text decoration */
        .user-menu .dropdown-toggle {
            text-decoration: none;
            border-bottom: none;
        }

        .user-menu .dropdown-menu {
            min-width: 200px;
        }

        /* Dropdown divider styling */
        .dropdown-divider {
            height: 1px;
            margin: 8px 0;
            overflow: hidden;
            background-color: #e9ecef;
        }

        /* Responsive design */
        @media (max-width: 991px) {
            .navbar-toggler {
                display: block;
                order: 1;
            }

            .navbar-collapse {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--primary-color);
                flex-direction: column;
                padding: 0;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.5s;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            }

            .navbar-collapse.show {
                max-height: 1000px;
            }

            .navbar-nav {
                flex-direction: column;
                width: 100%;
            }

            .navbar-nav.ms-auto {
                border-top: 1px solid rgba(255, 255, 255, 0.2);
            }

            .nav-link {
                padding: 15px 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .nav-link:after {
                display: none;
            }

            .dropdown-menu {
                position: static;
                background-color: rgba(0, 0, 0, 0.1);
                box-shadow: none;
                opacity: 1;
                visibility: visible;
                transform: none;
                padding: 0;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s;
            }

            .dropdown.show .dropdown-menu {
                max-height: 200px;
            }

            .dropdown-item {
                color: white;
                padding: 12px 30px;
            }

            .dropdown-item:hover {
                background-color: rgba(0, 0, 0, 0.2);
                color: var(--accent-color);
            }
        }

        /* Required JavaScript for mobile menu */
        @media (max-width: 991px) {
            .menu-toggle.active .navbar-toggler-icon {
                background-color: transparent;
            }

            .menu-toggle.active .navbar-toggler-icon:before {
                transform: rotate(45deg);
            }

            .menu-toggle.active .navbar-toggler-icon:after {
                transform: rotate(-45deg);
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Ayam Pedass
                </a>
                <button class="navbar-toggler menu-toggle" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto nav-links">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('menu') }}">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('cart') }}">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Promo</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('contact') }}">Kontak</a></li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @if(!session()->has('user_id'))
                            <li class="nav-item"><a class="nav-link" href="{{ url('login') }}">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('register') }}">Daftar</a></li>
                        @else
                            <li class="nav-item dropdown user-menu">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown">
                                    {{ session('user_name', Auth::user()->name) }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('profile') }}">
                                        Profil Saya
                                    </a>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">Pesanan Saya</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('logout') }}">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <main class="">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript untuk navbar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle menu for mobile
            const menuToggle = document.querySelector('.menu-toggle');
            const navbarCollapse = document.getElementById('navbarSupportedContent');

            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    this.classList.toggle('active');
                    navbarCollapse.classList.toggle('show');
                });
            }

            // For dropdown menus on mobile
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(dropdown => {
                const dropdownToggle = dropdown.querySelector('.dropdown-toggle');

                if (window.innerWidth < 992) {
                    dropdownToggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        dropdown.classList.toggle('show');
                    });
                }
            });
        });
    </script>
</body>

</html>
