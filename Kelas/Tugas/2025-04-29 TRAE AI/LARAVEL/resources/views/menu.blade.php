@extends('front')

@section('content')
<div class="row">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($menus as $menu)
            <div class="col">
                <div class="card h-100 menu-card shadow-sm">
                    <div class="position-relative overflow-hidden menu-img-container">
                        <img src="{{asset('gambar/'.$menu->gambar)}}" class="card-img-top" alt="{{ $menu->menu }}">
                        <div class="menu-overlay">
                            <a href="{{ url('beli/'.$menu->idmenu) }}" class="btn btn-light btn-sm quick-add">
                                <i class="fas fa-cart-plus me-1"></i> Quick Add
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $menu->menu }}</h5>
                        <p class="card-text text-muted">{{ $menu->deskripsi }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h5 class="text-primary mb-0">Rp.{{ number_format($menu->harga, 0, ',', '.') }}</h5>
                            <a href="{{ url('beli/'.$menu->idmenu) }}" class="btn btn-primary">
                                <i class="fas fa-shopping-cart me-1"></i> Beli
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="d-flex justify-content-center mt-5">
    {{ $menus->links() }}
</div>

<style>
    .menu-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
        border: none;
    }

    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .menu-img-container {
        height: 200px;
    }

    .menu-img-container img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .menu-card:hover .menu-img-container img {
        transform: scale(1.1);
    }

    .menu-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .menu-card:hover .menu-overlay {
        opacity: 1;
    }

    .quick-add {
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }

    .menu-card:hover .quick-add {
        transform: translateY(0);
    }
</style>
@endsection
