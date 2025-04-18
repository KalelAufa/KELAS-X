@extends('Backend.back')
@section('admincontent')
    <div>
        <h1>Data User</h1>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
    @endif
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Level</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Hapus</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody class="table-group-divider">
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->level }}</td>
                        <td><a href="{{ url('admin/user/'.$user->id.'/edit') }}" class="btn btn-warning">Edit</a></td>
                        <td><a href="{{ url('admin/user/'.$user->id) }}" class="btn btn-danger">Hapus</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="float-end">
            <a href="{{ url('admin/user/create') }}" class="btn btn-primary">Tambah</a>
        </div>
    </div>
@endsection
