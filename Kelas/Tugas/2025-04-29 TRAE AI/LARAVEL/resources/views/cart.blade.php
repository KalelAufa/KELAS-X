@extends('front')

@section('content')
@if (session('cart'))
    <div class="card shadow border-0 rounded-lg mb-4">
        <div class="card-header bg-white py-3">
            <h4 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Shopping Cart</h4>
        </div>
        <div class="card-body p-0">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @php
                $no=1;
                $total = 0;
            @endphp
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( session('cart') as $idmenu => $menu )
                        <tr>
                            <td class="ps-4">{{ $no++ }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $menu['menu'] }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>Rp.{{ number_format($menu['harga'], 0, ',', '.') }}</td>
                            <td>
                                <div class="quantity-control d-flex align-items-center">
                                    <a class="btn btn-sm btn-outline-secondary rounded-circle" href="{{ url('kurang/'.$menu['idmenu']) }}">
                                        <i class="fas fa-minus fa-xs"></i>
                                    </a>
                                    <span class="mx-2 fw-bold">{{ $menu['quantity'] }}</span>
                                    <a class="btn btn-sm btn-outline-secondary rounded-circle" href="{{ url('tambah/'.$menu['idmenu']) }}">
                                        <i class="fas fa-plus fa-xs"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="fw-bold text-primary">Rp.{{ number_format($menu['quantity'] * $menu['harga'], 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-outline-danger" href="{{ url('hapus/'.$menu['idmenu']) }}">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        @php
                            $total = $total + ($menu['quantity'] * $menu['harga']);
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light py-3">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <a class="btn btn-outline-danger" href="{{ url('batal') }}">
                        <i class="fas fa-times me-1"></i> Batal Pesanan
                    </a>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-end">
                        <div class="me-md-4 mb-2 mb-md-0">
                            <span class="text-muted">Total Pembayaran:</span>
                            <span class="fs-4 fw-bold text-primary ms-2">Rp.{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <a class="btn btn-success" href="{{ url('checkout') }}">
                            <i class="fas fa-shopping-bag me-1"></i> Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="text-center py-5">
        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
        <h4>Keranjang belanja Anda kosong</h4>
        <p class="text-muted">Silakan tambahkan beberapa menu ke keranjang Anda</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">
            <i class="fas fa-utensils me-1"></i> Lihat Menu
        </a>
    </div>
    <script>
        window.location.href='/';
    </script>
@endif

<style>
    .quantity-control .btn {
        width: 28px;
        height: 28px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .menu-img img {
        object-fit: cover;
        height: 50px;
    }
</style>
@endsection
