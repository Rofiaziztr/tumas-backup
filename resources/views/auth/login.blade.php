<x-auth.layout :title="$title">
    <div class="auth-header">
        <h2>Login to Your Account</h2>
    </div>
    <div class="auth-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
                {{-- <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot
                                    Password?</a> --}}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-auth">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            </div>
        </form>

        <div class="divider">
            <span class="divider-text">OR</span>
        </div>

        <div class="social-auth">
            <a href="#" class="social-btn facebook">
                <i class="fab fa-facebook-f me-2"></i> Login with Facebook
            </a>
            <a href="#" class="social-btn google">
                <i class="fab fa-google me-2"></i> Login with Google
            </a>
            <a href="#" class="social-btn twitter">
                <i class="fab fa-twitter me-2"></i> Login with Twitter
            </a>
        </div>

        <div class="auth-footer">
            Don't have an account? <a href="{{ route('register') }}" class="auth-link">Sign up</a>
        </div>
    </div>
</x-auth.layout>
