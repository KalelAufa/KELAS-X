@extends('Backend.back')
@section('admincontent')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Detail Pesanan</h5>
                <small class="text-muted">Laporan detail pesanan pelanggan</small>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/orderdetail/create') }}" method="get">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="tglmulai"><i class="far fa-calendar-alt me-1"></i>Tanggal Mulai</label>
                            <input class="form-control" type="date" name="tglmulai" id="tglmulai" value="{{ request('tglmulai') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="tglakhir"><i class="far fa-calendar-alt me-1"></i>Tanggal Akhir</label>
                            <input class="form-control" type="date" name="tglakhir" id="tglakhir" value="{{ request('tglakhir') }}">
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button class="btn btn-primary w-100" type="submit">
                                <i class="fas fa-search me-1"></i>Cari Data
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-filter"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Filter data...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    @php
                        $no = 1;
                        $grandTotal = 0;
                    @endphp
                    <tbody class="table-group-divider">
                        @foreach ($details as $detail)
                            @php
                                $grandTotal += $detail->total;
                            @endphp
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td><i class="far fa-calendar-alt me-1"></i>{{ date('d M Y', strtotime($detail->tglorder)) }}</td>
                                <td><i class="fas fa-user me-1"></i>{{ $detail->pelanggan }}</td>
                                <td>{{ $detail->menu }}</td>
                                <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $detail->jumlah }}</td>
                                <td class="fw-bold">Rp {{ number_format($detail->total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="6" class="text-end fw-bold">Grand Total:</td>
                            <td class="fw-bold text-primary">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $details->links() }}
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small>Total: {{ $details->total() }} transaksi</small>
            @if(request('tglmulai') && request('tglakhir'))
                <span class="badge bg-info">
                    <i class="fas fa-filter me-1"></i>Filter: {{ date('d M Y', strtotime(request('tglmulai'))) }} - {{ date('d M Y', strtotime(request('tglakhir'))) }}
                </span>
            @endif
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const tanggal = row.cells[1].textContent.toLowerCase();
                const pelanggan = row.cells[2].textContent.toLowerCase();
                const menu = row.cells[3].textContent.toLowerCase();

                if (tanggal.includes(searchTerm) || pelanggan.includes(searchTerm) || menu.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    </script>
@endsection
