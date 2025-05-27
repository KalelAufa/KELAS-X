@extends('Backend.back')
@section('admincontent')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0"><i class="fas fa-tags me-2"></i>Kategori Menu</h5>
                <small class="text-muted">Manajemen kategori menu restoran</small>
            </div>
            <div>
                <a href="{{ url('admin/kategori/create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle me-1"></i>Tambah Kategori
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari kategori...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col">Kategori</th>
                            <th scope="col" width="15%" class="text-center">Aksi</th>
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
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ url('admin/kategori/'.$kategori->idkategori.'/edit') }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ url('admin/kategori/'.$kategori->idkategori) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small>Total: {{ count($kategoris) }} kategori</small>
            <a href="{{ url('admin/kategori') }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus semua kategori?')">
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

                if (kategori.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    </script>
@endsection
