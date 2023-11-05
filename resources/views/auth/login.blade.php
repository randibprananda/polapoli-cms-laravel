@extends('layouts.auth')

@section('title', 'Login | Pola Poli')

@section('content')
<div class="col-12 col-md-9 col-xl-7 col-xxxl-5 px-8 px-sm-0 pt-64 pb-48">
    <div class="d-flex align-items-center mb-sm-24">
        <a href="" class="auth-back">
            <i class="iconly-Light-ArrowLeft"></i>
        </a>
        <h1 class="mb-0">Login</h1>
    </div>
    <p class="mt-sm-8 mt-sm-0 text-black-60">Welcome back, please login to your account.</p>

    <form class="mt-16 mt-sm-32 mb-8" method="POST" action="{{ route('login') }}">
        @csrf
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="mb-16">
            <label for="loginEmail" class="form-label">Email :</label>
            <input type="email" class="form-control" id="loginEmail" name="email" value="{{ old('email') }}">
        </div>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="mb-16">
            <label for="loginPassword" class="form-label">Password :</label>
            <input type="password" class="form-control" id="loginPassword" name="password">
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="row align-items-center justify-content-between mb-16">
            <div class="col hp-flex-none w-auto">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label ps-4" for="exampleCheck1">Remember me</label>
                </div>
            </div>

            <div class="col hp-flex-none w-auto">
                <a class="hp-button text-black-80 hp-text-color-dark-40" href="{{route('password.request')}}">Forgot
                    Password?</a>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <a class="d-block w-100" style="color: inherit;">Sign in</a>
        </button>
    </form>
</div>
@endsection
