@extends('layouts.auth')

@section('content')
<div class="col-12 col-md-9 col-xl-7 col-xxxl-5 px-8 px-sm-0 pt-24 pb-48">
    <a href="" class="auth-back">
        <i class="iconly-Light-ArrowLeft"></i>
    </a>
    <h1 class="mb-0 mb-sm-24">Forgot Password</h1>
    <p class="mt-sm-8 mt-sm-0 text-black-60">We’ll e-mail you instructions on how to reset your password.</p>

    <form class="mt-16 mt-sm-32 mb-8" action="{{ route('password.email') }}">
        @method("POST")
        @csrf
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="mb-24">
            <label for="recoverEmail" class="form-label">E-mail :</label>
            <input type="email" name="email" class="form-control" id="recoverEmail" value="{{ old('email') }}" placeholder="you@example.com">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">
            <a class="d-block w-100" style="color: inherit;">Reset Password</a>
        </button>
    </form>
</div>
@endsection
