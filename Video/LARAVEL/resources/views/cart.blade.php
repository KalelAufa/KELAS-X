@extends('front')

@section('content')
@if (session('cart'))
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @php
            $no=1;
            $total = 0;
        @endphp
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ( session('cart') as $idmenu => $menu )
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $menu['menu'] }}</td>
                    <td>{{ $menu['harga'] }}</td>
                    <td>
                        <span><a class="btn btn-warning btn-sm rounded-circle" href="{{ url('kurang/'.$menu['idmenu']) }}"><i class="fa-solid fa-minus fa-sm"></i></a></span>
                        {{ $menu['quantity'] }}
                        <span><a class="btn btn-warning btn-sm rounded-circle" href="{{ url('tambah/'.$menu['idmenu']) }}"><i class="fa-solid fa-plus fa-sm"></i></a></span>
                    </td>
                    <td>Rp.{{ $menu['quantity'] * $menu['harga'] }}</td>
                    <td><a class="btn btn-primary" href="{{ url('hapus/'.$menu['idmenu']) }}">Hapus</a></td>
                </tr>
                @php
                    $total = $total + ($menu['quantity'] * $menu['harga']);
                @endphp
                @endforeach
                <tr>
                    <td colspan="4" class="text-right">Total pembayaran:</td>
                    <td>Rp.{{ $total }}</td>
                    <td><a class="btn btn-danger" href="{{ url('batal') }}">Batal</a></td>
                </tr>
            </tbody>
        </table>
        <div>
            <a class="btn btn-success" href="{{ url('checkout') }}">Checkout</a>
        </div>
    </div>
@else
    <script>
        window.location.href='/';
    </script>
@endif
@endsection
