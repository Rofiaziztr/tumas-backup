<x-auth.layout>
    <div class="auth-header">
        <h2>Create Your Account</h2>
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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" required autocomplete="new-password">
                <div class="password-strength mt-2">
                    <div class="strength-bar" id="strengthBar"></div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required
                    autocomplete="new-password">
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                <label class="form-check-label" for="terms">I agree to the <a href="#" class="auth-link">Terms
                        and Conditions</a></label>
                @error('terms')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-auth">
                    <i class="fas fa-user-plus me-2"></i> Sign Up
                </button>
            </div>
        </form>

        <div class="divider">
            <span class="divider-text">OR</span>
        </div>

        <div class="social-auth">
            <a href="#" class="social-btn facebook">
                <i class="fab fa-facebook-f me-2"></i> Sign up with Facebook
            </a>
            <a href="#" class="social-btn google">
                <i class="fab fa-google me-2"></i> Sign up with Google
            </a>
            <a href="#" class="social-btn twitter">
                <i class="fab fa-twitter me-2"></i> Sign up with Twitter
            </a>
        </div>

        <div class="auth-footer">
            Already have an account? <a href="{{ route('login') }}" class="auth-link">Sign in</a>
        </div>
    </div>
</x-auth.layout>
