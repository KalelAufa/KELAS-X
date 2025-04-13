@extends('Backend.back')
@section('admincontent')
    <div>
        <h1>Kategori</h1>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Hapus</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody class="table-group-divider">
                @foreach ($kategoris as $kategori)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $kategori->kategori }}</td>
                        <td><a href="{{ url('admin/kategori/'.$kategori->idkategori.'/edit') }}" class="btn btn-warning">Edit</a></td>
                        <td><a href="{{ url('admin/kategori/'.$kategori->idkategori) }}" class="btn btn-danger">Hapus</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="float-end">
            <a href="{{ url('admin/kategori/create') }}" class="btn btn-primary">Tambah</a>
            <a href="{{ url('admin/kategori') }}" class="btn btn-danger">Hapus Semua</a>
        </div>
    </div>
@endsection
