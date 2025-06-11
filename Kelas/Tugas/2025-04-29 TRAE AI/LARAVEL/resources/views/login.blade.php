@extends('front')

@section('content')
<div class="row justify-content-center my-5">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow border-0 rounded-lg">
            <div class="card-header bg-primary text-white text-center py-4">
                <h3 class="mb-0"><i class="fas fa-user-circle me-2"></i>Login</h3>
            </div>
            <div class="card-body p-4 p-md-5">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ url('/postlogin') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="email" placeholder="name@example.com">
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
                        <span class="text-danger small">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                        <span class="text-danger small">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small text-decoration-none" href="#">Forgot Password?</a>
                        <button class="btn btn-primary px-4" type="submit">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small">
                    <span>Don't have an account?</span>
                    <a class="text-decoration-none" href="{{ url('register') }}">Sign up now!</a>
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
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        padding-left: 0.75rem;
    }
</style>
@endsection
