<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LARAVEL Restoran</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body>
    <div class="container">
        <div>
            <nav class="navbar navbar-expand-lg bg-body-tertiary rounded">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}"><img style="width: 150px" src="{{ asset('gambar/logo.png') }}" alt=""></a>
                    <ul class="navbar-nav gap-3">
                        @if (session()->has('cart'))
                            <li class="nav-item "> <a href="{{ url('cart') }}"> Cart(
                                    @php
                                        $total = count(session('cart'));
                                        echo $total;
                                    @endphp
                                )</a>
                            </li>
                        @else
                            <li class="nav-item">Cart</li>
                        @endif
                        @if (session()->missing('pelanggan'))
                            <li class="nav-item"><a href="{{ url('register') }}">Register</a></li>
                            <li class="nav-item"><a href="{{ url('login') }}">Login</a></li>
                        @else
                            <li class="nav-item"><a href="{{ url('profile') }}">{{ session('pelanggan')['pelanggan'] }}</a></li>
                            <li class="nav-item"><a href="{{ url('logout') }}"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
        <div class="row mt-4">
            <div class="col-2">
                <ul class="list-group">
                    @if (isset($kategoris) && $kategoris->count())
                        @foreach ($kategoris as $kategori)
                            <li class="list-group-item"><a href="{{ url('show/'.$kategori->idkategori) }}">{{ $kategori->kategori }}</a></li>
                        @endforeach
                    @else
                        <li class="list-group-item">No categories available</li>
                    @endif
                </ul>
            </div>
            <div class="col-10">
                @yield('content')
            </div>
        </div>
        <div>
            footer
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
