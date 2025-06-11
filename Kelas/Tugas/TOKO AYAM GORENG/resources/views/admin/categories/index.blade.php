@extends('layouts.admin')

@section('content')
<style>

    .admin-content{
        margin-left: 270px;
    }

    :root {
        --primary-color: #ff6b00;
        --primary-dark: #d84315;
        --primary-light: #ffab40;
        --accent-color: #e65100;
        --text-dark: #333333;
        --text-light: #f9f9f9;
        --background-light: #f8f9fa;
        --background-dark: #263238;
        --success-color: #4caf50;
        --warning-color: #ff9800;
        --danger-color: #f44336;
        --info-color: #2196f3;
        --border-color: #e0e0e0;
        --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        --hover-transition: all 0.3s ease;
    }

    /* Gaya Tabel */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
        background: white;
        border-radius: 8px;
        overflow: hidden;
    }

    .data-table thead {
        background-color: var(--primary-color);
        color: white;
    }

    .data-table th,
    .data-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }

    .data-table tbody tr:hover {
        background-color: rgba(255, 107, 0, 0.05);
    }

    /* Gaya Tombol */
    .btn-primary {
        background-color: var(--primary-color);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--hover-transition);
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
    }

    .btn-icon {
        padding: 0.5rem;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: var(--hover-transition);
        margin: 0 0.25rem;
    }

    .btn-edit {
        background-color: var(--warning-color);
        color: white;
    }

    .btn-delete {
        background-color: var(--danger-color);
        color: white;
    }

    /* Gaya Alert */
    .alert {
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
    }

    .alert-success {
        background-color: rgba(76, 175, 80, 0.1);
        color: var(--success-color);
        border: 1px solid var(--success-color);
    }

    .alert-danger {
        background-color: rgba(244, 67, 54, 0.1);
        color: var(--danger-color);
        border: 1px solid var(--danger-color);
    }

    /* Gaya Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .modal-content {
        background-color: white;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: var(--card-shadow);
    }

    .modal-header {
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        padding: 1rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .close {
        cursor: pointer;
        font-size: 1.5rem;
        color: var(--text-dark);
    }

    /* Responsif */
    @media screen and (max-width: 768px) {
        .data-table {
            display: block;
            overflow-x: auto;
        }

        .btn-primary {
            padding: 0.5rem 1rem;
        }

        .modal-content {
            width: 95%;
            margin: 0 10px;
        }
    }
</style>
    <div class="admin-content">
        <div class="content-header">
            <h1>Manajemen Kategori</h1>
            <div class="header-actions">
                <a href="{{ route('admin.categories.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="content-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th>Jumlah Menu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->menus->count() }}</td>
                                        <td class="actions">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-icon btn-edit" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn-icon btn-delete" title="Hapus"
                                                onclick="confirmDelete('{{ route('admin.categories.destroy', $category->id) }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data kategori</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-container">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Konfirmasi Hapus</h3>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-secondary" id="cancelDelete">Batal</button>
                    <button type="submit" class="btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Modal Konfirmasi Hapus
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        const closeBtn = document.querySelector('.close');
        const cancelBtn = document.getElementById('cancelDelete');

        function confirmDelete(url) {
            deleteModal.style.display = 'block';
            deleteForm.action = url;
        }

        closeBtn.onclick = function() {
            deleteModal.style.display = 'none';
        }

        cancelBtn.onclick = function() {
            deleteModal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == deleteModal) {
                deleteModal.style.display = 'none';
            }
        }
    </script>
@endsection
