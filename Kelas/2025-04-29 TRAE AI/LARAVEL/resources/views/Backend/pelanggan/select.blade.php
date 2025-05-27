@extends('Backend.back')
@section('admincontent')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0"><i class="fas fa-user-friends me-2"></i>Data Pelanggan</h5>
                <small class="text-muted">Manajemen data pelanggan restoran</small>
            </div>
            <div class="btn-group">
                <a href="{{ url('admin/pelanggan?status=1') }}" class="btn btn-sm {{ request('status') === '1' ? 'btn-success' : 'btn-outline-success' }}">
                    <i class="fas fa-check-circle me-1"></i>Aktif
                </a>
                <a href="{{ url('admin/pelanggan?status=0') }}" class="btn btn-sm {{ request('status') === '0' ? 'btn-danger' : 'btn-outline-danger' }}">
                    <i class="fas fa-ban me-1"></i>Banned
                </a>
                <a href="{{ url('admin/pelanggan') }}" class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="fas fa-list me-1"></i>Semua
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari pelanggan...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telp</th>
                            <th scope="col" width="10%" class="text-center">Status</th>
                        </tr>
                    </thead>
                    @php
                        $no = 1;
                    @endphp
                    <tbody class="table-group-divider">
                        @foreach ($pelanggans as $pelanggan)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td><i class="fas fa-user me-1"></i>{{ $pelanggan->pelanggan }}</td>
                                <td><i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($pelanggan->alamat, 50) }}</td>
                                <td><i class="fas fa-envelope me-1"></i>{{ $pelanggan->email }}</td>
                                <td><i class="fas fa-phone me-1"></i>{{ $pelanggan->telp }}</td>
                                @php
                                    if ($pelanggan->aktif == 1) {
                                        $aktif = '<a class="btn btn-sm btn-success" href="'.url('admin/pelanggan/'.$pelanggan->idpelanggan).'" onclick="return confirm(\'Yakin ingin menonaktifkan pelanggan ini?\')">
                                                    <i class="fas fa-check-circle me-1"></i>Aktif
                                                  </a>';
                                    } else {
                                        $aktif = '<a class="btn btn-sm btn-danger" href="'.url('admin/pelanggan/'.$pelanggan->idpelanggan).'" onclick="return confirm(\'Yakin ingin mengaktifkan pelanggan ini?\')">
                                                    <i class="fas fa-ban me-1"></i>Banned
                                                  </a>';
                                    }
                                @endphp
                                <td class="text-center">{!! $aktif !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $pelanggans->links() }}
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small>Total: {{ $pelanggans->total() }} pelanggan</small>
            <div>
                <span class="badge bg-success me-2">Aktif: {{ $pelanggans->where('aktif', 1)->count() }}</span>
                <span class="badge bg-danger">Banned: {{ $pelanggans->where('aktif', 0)->count() }}</span>
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
                const alamat = row.cells[2].textContent.toLowerCase();
                const email = row.cells[3].textContent.toLowerCase();
                const telp = row.cells[4].textContent.toLowerCase();

                if (pelanggan.includes(searchTerm) || alamat.includes(searchTerm) ||
                    email.includes(searchTerm) || telp.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    </script>
@endsection
