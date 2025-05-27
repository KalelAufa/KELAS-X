@extends('front')

@section('content')
<div class="row justify-content-center my-5">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow border-0 rounded-lg">
            <div class="card-header bg-primary text-white text-center py-4">
                <h3 class="mb-0"><i class="fas fa-user-plus me-2"></i>Register</h3>
            </div>
            <div class="card-body p-4">
                <form action="{{ url('/postregister') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating mb-2">
                                <input class="form-control" value="{{ old('pelanggan') }}" type="text" name="pelanggan" id="pelanggan" placeholder="Nama Lengkap">
                                <label for="pelanggan"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                                <span class="text-danger small">
                                    @error('pelanggan')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating mb-2">
                                <input class="form-control" value="{{ old('alamat') }}" type="text" name="alamat" id="alamat" placeholder="Alamat">
                                <label for="alamat"><i class="fas fa-map-marker-alt me-2"></i>Alamat</label>
                                <span class="text-danger small">
                                    @error('alamat')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-2">
                                <input class="form-control" value="{{ old('telp') }}" type="text" name="telp" id="telp" placeholder="Telepon">
                                <label for="telp"><i class="fas fa-phone me-2"></i>Telepon</label>
                                <span class="text-danger small">
                                    @error('telp')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-2">
                                <select class="form-select" name="jeniskelamin" id="jeniskelamin">
                                    <option value="L" selected>Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <label for="jeniskelamin"><i class="fas fa-venus-mars me-2"></i>Jenis Kelamin</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating mb-2">
                                <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="email" placeholder="Email">
                                <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                                <span class="text-danger small">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating mb-2">
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                                <span class="text-danger small">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-0">
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small">
                    <span>Already have an account?</span>
                    <a class="text-decoration-none" href="{{ url('login') }}">Sign in!</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-floating label {
        padding-left: 1.25rem;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label,
    .form-floating > .form-select ~ label {
        padding-left: 0.75rem;
    }
</style>
@endsection
