@extends('front')

@section('content')
<div class="row">
    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
    @endif
    @foreach ($menus as $menu)
        <div class="card mx-2 mb-3" style="width: 18rem;">
        <img src="{{asset('gambar/'.$menu->gambar)}}" class="card-img-top mt-3 rounded" alt="{{ $menu->menu }}">
            <div class="card-body">
                <h5 class="card-title">{{ $menu->menu }}</h5>
                <p class="card-text">{{ $menu->deskripsi }}</p>
                <h5 class="card-title">Rp.{{ $menu->harga }}</h5>
                <a href="{{ url('beli/'.$menu->idmenu) }}" class="btn btn-primary">Beli</a>
            </div>
        </div>
    @endforeach
</div>
<div class="d-flex justify-content-center">
    {{ $menus->links() }}
</div>
@endsection
