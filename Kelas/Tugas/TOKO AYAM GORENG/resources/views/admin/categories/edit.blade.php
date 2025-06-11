@extends('layouts.admin')

@section('content')
<style>
    /* Variabel CSS */
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

    /* Gaya Form */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
        font-weight: 500;
    }

    .required-field::after {
        content: '*';
        color: var(--danger-color);
        margin-left: 4px;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 1rem;
        transition: var(--hover-transition);
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.1);
    }

    .error-message {
        color: var(--danger-color);
        font-size: 0.875rem;
        margin-top: 0.5rem;
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

    .btn-secondary {
        background-color: var(--background-dark);
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

    .btn-secondary:hover {
        background-color: var(--text-dark);
        transform: translateY(-2px);
    }

    .form-actions {
        margin-top: 2rem;
        display: flex;
        gap: 1rem;
    }

    /* Responsif */
    @media screen and (max-width: 768px) {
        .form-actions {
            flex-direction: column;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
            justify-content: center;
        }
    }
</style>
    <div class="admin-content">
        <div class="content-header">
            <h1>Edit Kategori</h1>
            <div class="header-actions">
                <a href="{{ route('admin.categories.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="content-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="form-label required-field">Nama Kategori</label>
                            <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
