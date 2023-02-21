@extends('components.layout.auth.app')
@section('title', 'Play Shop || Daftar')
@section('content')
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="card shadow-lg border px-4 py-4 bg-white align-items-center" style="width: 500px;">
            <div class="d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/logo.png') }}" class="card-img-top w-50 h-50" alt="...">
            </div>
            <h5 class="text-body my-4 text-align-center">Daftar</h5>
            @if (session('error'))
                <div class="alert alert-danger w-100 py-1 px-3 text-center" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form class="w-100" method="POST" action="/register">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" class="form-control rounded" placeholder="Username">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control rounded" placeholder="Email">
                    @error('email')
                        <small class="text-danger">
                            {{ $errors->first('email') }}
                        </small>
                    @enderror
                </div>
                <div class="row">
                    <div class="mb-3 col-6 pr-1">
                        <input type="password" name="password" class="form-control rounded" placeholder="Kata Sandi"
                            id="password">
                        @error('password')
                            <small class="text-danger">
                                {{ $errors->first('password') }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3 col-6 pl-1 position-relative">
                        <i id="tooglePassword"
                            class="fas fa-eye-slash fa-sm position-absolute mt-2 pt-1 mr-4 cursor-pointer text-secondary right-0"></i>
                        <input type="password" name="password_confirmation" class="form-control rounded"
                            placeholder="Konfirmasi Kata Sandi" id="password1">
                        @error('password_confirmation')
                            <small class="text-danger">
                                {{ $errors->first('password_confirmation') }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div>
                    <a href="dashboard">
                        <button type="submit" class="btn bg-sea text-white w-100">Daftar</button>
                    </a>
                </div>
                <small class="d-flex justify-content-center mt-2">
                    mempunyai akun?&nbsp;
                    <a href="/">login</a>
                </small>
            </form>
        </div>
    </div>
@endsection
