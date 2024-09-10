@extends('layouts.app')

@section('title', 'Register')

@section('auth-title', 'Register')

@section('content')
<form action="{{ route('register') }}" method="POST">
    @csrf
    <div class="mb-4">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" id="nameInput" name="nama" placeholder="Nama Lengkap" required>
        </div>
    </div>
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
    <div class="mb-4">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required >
        </div>
    </div>
    <button type="submit" class="btn btn-primary w-100 mb-4">Register</button>
</form>
<div class="text-center">
    <p class="mb-0">Sudah memiliki akun? <a href="{{ route('login') }}" class="auth-link">Login</a></p>
</div>
@endsection
