@extends('Backend.back')
@section('admincontent')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Daftar Pesanan</h5>
                <small class="text-muted">Manajemen pesanan pelanggan</small>
            </div>
            <div class="btn-group">
                <a href="{{ url('admin/order') }}" class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="fas fa-list me-1"></i>Semua
                </a>
                <a href="{{ url('admin/order?status=0') }}" class="btn btn-sm {{ request('status') === '0' ? 'btn-danger' : 'btn-outline-danger' }}">
                    <i class="fas fa-clock me-1"></i>Belum Bayar
                </a>
                <a href="{{ url('admin/order?status=1') }}" class="btn btn-sm {{ request('status') === '1' ? 'btn-success' : 'btn-outline-success' }}">
                    <i class="fas fa-check-circle me-1"></i>Lunas
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari pesanan...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Total</th>
                            <th scope="col">Bayar</th>
                            <th scope="col">Kembali</th>
                            <th scope="col" width="15%" class="text-center">Status</th>
                        </tr>
                    </thead>
                    @php
                        $no = 1;
                    @endphp
                    <tbody class="table-group-divider">
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>
                                    <a href="{{ url('admin/order/'.$order->idorder.'/edit') }}" class="text-decoration-none">
                                        <i class="fas fa-user me-1"></i>{{ $order->pelanggan }}
                                    </a>
                                </td>
                                <td><i class="far fa-calendar-alt me-1"></i>{{ date('d M Y', strtotime($order->tglorder)) }}</td>
                                <td><span class="fw-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</span></td>
                                <td>Rp {{ number_format($order->bayar, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($order->kembali, 0, ',', '.') }}</td>
                                @php
                                    $statusBtn = '<a class="btn btn-sm btn-success" href=""><i class="fas fa-check-circle me-1"></i>Lunas</a>';
                                    if ($order->status == 0) {
                                        $statusBtn = '<a class="btn btn-sm btn-danger" href=" '. url('admin/order/'.$order->idorder) .' "><i class="fas fa-money-bill-wave me-1"></i>Bayar</a>';
                                    }
                                @endphp
                                <td class="text-center">{!! $statusBtn !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small>Total: {{ $orders->total() }} pesanan</small>
            <div>
                <span class="badge bg-danger me-2">Belum Bayar: {{ $orders->where('status', 0)->count() }}</span>
                <span class="badge bg-success">Lunas: {{ $orders->where('status', 1)->count() }}</span>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const pelanggan = row.cells[1].textContent.toLowerCase();
                const tanggal = row.cells[2].textContent.toLowerCase();

                if (pelanggan.includes(searchTerm) || tanggal.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    </script>
@endsection
