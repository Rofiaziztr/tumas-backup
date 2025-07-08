@extends('layouts.guest')
@section('title', 'Login')

@section('content')
    <div class="card-header">{{ __('Login') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email Address --}}
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            {{-- Remember Me & Lupa Password --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ __('Ingat Saya') }}</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="btn btn-link p-0" href="{{ route('password.request') }}">{{ __('Lupa password?') }}</a>
                @endif
            </div>

            {{-- Tombol Login --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
            </div>
        </form>

        <div class="text-center mt-4">
            <p class="text-muted mb-0">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
        </div>
    </div>
@endsection
