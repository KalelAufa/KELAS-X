@extends('Backend.back')
@section('admincontent')
    <div>
        <h1>menu</h1>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Hapus</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody class="table-group-divider">
                @foreach ($menus as $menu)
                    <tr class="justify-items-center">
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $menu->kategori }}</td>
                        <td>{{ $menu->menu }}</td>
                        <td>{{ $menu->deskripsi }}</td>
                        <td><img src="{{ asset('gambar/'.$menu->gambar) }}" alt="" width="100px" class="rounded"></td>
                        <td>{{ $menu->harga }}</td>
                        <td><a href="{{ url('admin/menu/'.$menu->idmenu.'/edit') }}" class="btn btn-warning">Edit</a></td>
                        <td><a href="{{ url('admin/menu/'.$menu->idmenu) }}" class="btn btn-danger">Hapus</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="float-end">
            <a href="{{ url('admin/menu/create') }}" class="btn btn-primary">Tambah</a>
            <a href="{{ url('admin/menu') }}" class="btn btn-danger">Hapus Semua</a>
        </div>
        <div class="d-flex justify-content-center">
            {{ $menus->links() }}
        </div>
    </div>
@endsection
