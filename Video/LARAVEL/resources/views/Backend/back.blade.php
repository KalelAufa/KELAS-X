<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin LARAVEL Restoran</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body>
    <div class="container">
        <div class="mt-4">
            <nav class="navbar navbar-expand-lg bg-body-tertiary rounded">
                <div class="container-fluid">
                    <h2>Admin Page</h2>
                    <ul class="navbar-nav gap-3">
                        <li class="nav-item"><a href="">{{ Auth::user()->name }}</a></li>
                        <li class="nav-item"><a href="">Level : {{ Auth::user()->level }}</a></li>
                        <li class="nav-item"><a href="{{ url('admin/logout') }}"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="row mt-4">
            <div class="col-2">
                <ul class="list-group">
                    @if (Auth::user()->level == 'admin')
                        <li class="list-group-item"><a href="{{ url('admin/user') }}">User</a></li>
                    @endif
                    @if (Auth::user()->level == 'kasir')
                        <li class="list-group-item"><a href="{{ url('admin/order') }}">Order</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/orderdetail') }}">OrderDetail</a></li>
                    @endif
                    @if (Auth::user()->level == 'manager')
                        <li class="list-group-item"><a href="{{ url('admin/pelanggan') }}">Pelanggan</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/kategori') }}">Kategori</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/menu') }}">Menu</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/order') }}">Order</a></li>
                        <li class="list-group-item"><a href="{{ url('admin/orderdetail') }}">OrderDetail</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-10">
                @yield('admincontent')
            </div>
        </div>
        <div class="">
            footer
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
