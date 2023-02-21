@extends('components.layout.auth.app')
@section('title', 'Play Shop || Masuk')
@section('content')
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="card shadow-lg border px-4 py-4 bg-white align-items-center" style="width: 393px;">
            <div class="d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/logo.png') }}" class="card-img-top w-50 h-50 my-1" alt="...">
            </div>
            <h5 class="text-body my-4 text-align-center">Masuk</h5>
            @if (session('error'))
                <div class="alert alert-danger w-100 py-1 px-3 text-center" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success w-100 py-1 px-3 text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <form class="w-100" method="POST" action="/login">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control rounded" placeholder="Email" required>
                </div>
                <div class="mb-3 position-relative">
                    <i id="tooglePassword"
                        class="fas fa-eye-slash fa-sm position-absolute mt-2 pt-1 mr-2 cursor-pointer text-secondary right-0"></i>
                    <input type="password" name="password" class="form-control rounded" placeholder="Kata Sandi" required
                        id="password">
                </div>
                <div>
                    <a href="dashboard">
                        <button type="submit" class="btn bg-sea text-white w-100">Masuk</button>
                    </a>
                    <small class="d-flex justify-content-center mt-2">
                        belum mempunyai akun?&nbsp;
                        <a href="/register">daftar</a>
                    </small>
                </div>
            </form>
        </div>
    </div>
@endsection
