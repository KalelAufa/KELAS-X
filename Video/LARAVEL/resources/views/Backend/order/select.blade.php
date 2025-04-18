@extends('Backend.back')
@section('admincontent')
    <div>
        <h1>order</h1>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pelanggan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total</th>
                    <th scope="col">Bayar</th>
                    <th scope="col">Kembali</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody class="table-group-divider">
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td><a href="{{ url('admin/order/'.$order->idorder.'/edit') }}">{{ $order->pelanggan }}</a></td>
                        <td>{{ $order->tglorder }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->bayar }}</td>
                        <td>{{ $order->kembali }}</td>
                        @php
                            $status = '<a class="btn btn-success" href="">Lunas</a>';
                            if ($order->status == 0) {
                                $status = '<a class="btn btn-danger" href=" '. url('admin/order/'.$order->idorder) .' ">Bayar</a>';
                            }
                        @endphp
                        <td>{!! $status !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
