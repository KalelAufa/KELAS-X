@extends('Backend.back')
@section('admincontent')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0"><i class="fas fa-utensils me-2"></i>Menu Restoran</h5>
                <small class="text-muted">Manajemen menu makanan dan minuman</small>
            </div>
            <div>
                <a href="{{ url('admin/menu/create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle me-1"></i>Tambah Menu
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <form action="{{ url('admin/select') }}" method="get">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-filter"></i></span>
                            <select class="form-select" name="idkategori" onchange="this.form.submit()">
                                <option value="">-- Semua Kategori --</option>
                                @foreach ( $kategoris as $kategori )
                                    <option value="{{ $kategori->idkategori }}" {{ request()->idkategori == $kategori->idkategori ? 'selected' : '' }}>
                                        {{ $kategori->kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <a href="{{ url('admin/menu') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari menu...">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Harga</th>
                            <th scope="col" width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    @php
                        $no = 1;
                    @endphp
                    <tbody class="table-group-divider">
                        @foreach ($menus as $menu)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td><span class="badge bg-info">{{ $menu->kategori }}</span></td>
                                <td>{{ $menu->menu }}</td>
                                <td>{{ Str::limit($menu->deskripsi, 50) }}</td>
                                <td>
                                    <img src="{{ asset('gambar/'.$menu->gambar) }}" alt="{{ $menu->menu }}"
                                         class="img-thumbnail" width="80px" height="80px">
                                </td>
                                <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ url('admin/menu/'.$menu->idmenu.'/edit') }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ url('admin/menu/'.$menu->idmenu) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $menus->links() }}
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small>Total: {{ $menus->total() }} menu</small>
            <a href="{{ url('admin/menu') }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus semua menu?')">
                <i class="fas fa-trash-alt me-1"></i>Hapus Semua
            </a>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const kategori = row.cells[1].textContent.toLowerCase();
                const menu = row.cells[2].textContent.toLowerCase();
                const deskripsi = row.cells[3].textContent.toLowerCase();

                if (kategori.includes(searchTerm) || menu.includes(searchTerm) || deskripsi.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    </script>
@endsection
