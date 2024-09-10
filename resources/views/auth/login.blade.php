@extends('layouts.app')

@section('title', 'Login')

@section('auth-title', 'Login')

@section('content')
<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-4">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" class="form-control" id="emailInput" name="email" placeholder="Email" required>
        </div>
    </div>
    <div class="mb-4">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Password" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary w-100 mb-4">Login</button>
</form>
<div class="text-center">
    <p class="mb-0">Belum mempunyai akun? <a href="{{ route('register') }}" class="auth-link">Register</a></p>
</div>
@endsection
