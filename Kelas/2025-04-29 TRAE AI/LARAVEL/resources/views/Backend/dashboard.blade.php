@extends('Backend.back')
@section('admincontent')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h5>
                <small class="text-muted">Ringkasan informasi sistem restoran</small>
            </div>
            <div>
                <span class="badge bg-primary">{{ date('d M Y') }}</span>
            </div>
        </div>
        <div class="card-body">
            <!-- Statistik Utama -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Pesanan</h6>
                                    <h2 class="mt-2 mb-0">{{ isset($totalOrders) ? $totalOrders : 0 }}</h2>
                                </div>
                                <div>
                                    <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a href="{{ url('admin/order') }}" class="text-white text-decoration-none">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Pendapatan</h6>
                                    <h2 class="mt-2 mb-0">Rp {{ isset($totalRevenue) ? number_format($totalRevenue, 0, ',', '.') : 0 }}</h2>
                                </div>
                                <div>
                                    <i class="fas fa-money-bill-wave fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a href="{{ url('admin/orderdetail') }}" class="text-white text-decoration-none">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Menu</h6>
                                    <h2 class="mt-2 mb-0">{{ isset($totalMenus) ? $totalMenus : 0 }}</h2>
                                </div>
                                <div>
                                    <i class="fas fa-utensils fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a href="{{ url('admin/menu') }}" class="text-white text-decoration-none">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Pelanggan</h6>
                                    <h2 class="mt-2 mb-0">{{ isset($totalCustomers) ? $totalCustomers : 0 }}</h2>
                                </div>
                                <div>
                                    <i class="fas fa-users fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a href="{{ url('admin/pelanggan') }}" class="text-white text-decoration-none">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik dan Tabel -->
            <div class="row">
                <!-- Grafik Pesanan Terbaru -->
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Pesanan 7 Hari Terakhir
                        </div>
                        <div class="card-body">
                            <canvas id="orderChart" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Tabel Menu Terlaris -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-star me-1"></i>
                            Menu Terlaris
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th class="text-end">Terjual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($topMenus))
                                            @foreach($topMenus as $menu)
                                            <tr>
                                                <td>{{ $menu->menu }}</td>
                                                <td class="text-end">{{ $menu->total_sold }}</td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="2" class="text-center">Tidak ada data</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pesanan Terbaru -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-shopping-cart me-1"></i>
                            Pesanan Terbaru
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Pelanggan</th>
                                            <th>Tanggal</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($recentOrders))
                                            @foreach($recentOrders as $order)
                                            <tr>
                                                <td>{{ $order->idorder }}</td>
                                                <td>{{ $order->pelanggan }}</td>
                                                <td>{{ date('d/m/Y', strtotime($order->tglorder)) }}</td>
                                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                                <td>
                                                    @if($order->status == 1)
                                                        <span class="badge bg-success">Lunas</span>
                                                    @else
                                                        <span class="badge bg-danger">Belum Bayar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/order/'.$order->idorder.'/edit') }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada pesanan terbaru</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data untuk grafik (dummy data, ganti dengan data sebenarnya dari controller)
            const labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Pesanan',
                    backgroundColor: 'rgba(52, 152, 219, 0.5)',
                    borderColor: 'rgba(52, 152, 219, 1)',
                    borderWidth: 1,
                    data: [5, 10, 8, 15, 12, 20, 18],
                }]
            };

            // Konfigurasi grafik
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            };

            // Render grafik
            const orderChart = new Chart(
                document.getElementById('orderChart'),
                config
            );
        });
    </script>
@endsection
