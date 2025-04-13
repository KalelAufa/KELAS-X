@extends('front')

@section('content')
<div class="row">
    <div class="col-6">
        <form action="{{ url('/postregister') }}" method="post">
            @csrf
            <div class="mt-2">
                <label class="form-label" for="">Pelanggan</label>
                <input class="form-control" value="{{ old('pelanggan') }}" type="text" name="pelanggan" id="">
                <span class="text-danger">
                    @error('pelanggan')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Alamat</label>
                <input class="form-control" value="{{ old('alamat') }}" type="text" name="alamat" id="">
                <span class="text-danger">
                    @error('alamat')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Telp</label>
                <input class="form-control" value="{{ old('telp') }}" type="text" name="telp" id="">
                <span class="text-danger">
                    @error('telp')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Jenis Kelamin</label>
                <select class="form-select" name="jeniskelamin" id="">
                    <option value="L" selected>Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Email</label>
                <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="">
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Password</label>
                <input class="form-control"  type="passsword" name="password" id="">
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection
