@extends('Backend.back')
@section('admincontent')
    <div>
        <h1>Pelanggan</h1>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pelanggan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telp</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody class="table-group-divider">
                @foreach ($pelanggans as $pelanggan)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $pelanggan->pelanggan }}</td>
                        <td>{{ $pelanggan->alamat }}</td>
                        <td>{{ $pelanggan->email }}</td>
                        <td>{{ $pelanggan->telp }}</td>
                        @php
                            if ($pelanggan->aktif == 1) {
                                $aktif = '<a class="btn btn-success" href="'.url('admin/pelanggan/'.$pelanggan->idpelanggan).'">Aktif</a>';
                            }else {
                                $aktif = '<a class="btn btn-danger" href="'.url('admin/pelanggan/'.$pelanggan->idpelanggan).'">Banned</a>';
                            }
                        @endphp
                        <td>{!! $aktif !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $pelanggans->links() }}
        </div>
    </div>
@endsection
