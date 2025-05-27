@extends('Backend.back')
@section('admincontent')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0"><i class="fas fa-users me-2"></i>Data User</h5>
                <small class="text-muted">Manajemen pengguna sistem</small>
            </div>
            <div>
                <a href="{{ url('admin/user/create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle me-1"></i>Tambah User
                </a>
            </div>
        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari user...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Level</th>
                            <th scope="col" width="15%" class="text-center">Aksi</th>
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
                                <td>
                                    <span class="badge {{ $user->level == 'admin' ? 'bg-danger' : ($user->level == 'manager' ? 'bg-success' : 'bg-info') }}">
                                        {{ $user->level }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ url('admin/user/'.$user->id.'/edit') }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ url('admin/user/'.$user->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')">
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
        <div class="card-footer text-muted">
            <small>Total: {{ count($users) }} pengguna</small>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const email = row.cells[2].textContent.toLowerCase();
                const level = row.cells[3].textContent.toLowerCase();

                if (name.includes(searchTerm) || email.includes(searchTerm) || level.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    </script>
@endsection
