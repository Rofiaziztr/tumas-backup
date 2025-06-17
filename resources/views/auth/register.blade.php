<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-bg: #f8f9fa;
            --secondary-bg: #343a40;
            --accent-color: #6c757d;
            --text-dark: #212529;
            --text-light: #f8f9fa;
        }

        body {
            background-color: var(--primary-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .auth-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            opacity: 0;
            transform: translateY(10px);
            animation: fadeInSlide 0.4s ease-out forwards;
        }

        @keyframes fadeInSlide {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-header {
            background-color: var(--secondary-bg);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .auth-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(108, 117, 125, 0.25);
        }

        .btn-auth {
            background-color: var(--secondary-bg);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-weight: 600;
            width: 100%;
        }

        .btn-auth:hover {
            background-color: var(--accent-color);
            color: white;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            transition: all 0.3s;
        }

        .social-btn:hover {
            color: white;
        }

        .facebook {
            background-color: #3b5998;
        }

        .google {
            background-color: #db4437;
        }

        .twitter {
            background-color: #1da1f2;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider-text {
            padding: 0 10px;
            color: var(--accent-color);
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            color: var(--accent-color);
        }

        .auth-link {
            color: var(--secondary-bg);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .auth-link:hover {
            color: #23272b;
            text-decoration: underline;
        }


        /* Animasi strength bar */
        .strength-bar {
            transition: width 0.5s ease, background-color 0.5s ease;
        }

        /* Animasi error */
        .invalid-feedback {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="auth-container">
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
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required
                                    autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required
                                    autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required autocomplete="new-password">
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
                                <input type="password" class="form-control" id="password-confirm"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">I agree to the <a href="#"
                                        class="auth-link">Terms and Conditions</a></label>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('strengthBar');
            let strength = 0;

            // Check for length
            if (password.length > 7) strength += 1;

            // Check for uppercase letters
            if (password.match(/[A-Z]/)) strength += 1;

            // Check for numbers
            if (password.match(/[0-9]/)) strength += 1;

            // Check for special characters
            if (password.match(/[^A-Za-z0-9]/)) strength += 1;

            // Update the strength bar
            switch (strength) {
                case 0:
                    strengthBar.style.width = '0%';
                    strengthBar.style.backgroundColor = '#dc3545';
                    break;
                case 1:
                    strengthBar.style.width = '25%';
                    strengthBar.style.backgroundColor = '#dc3545';
                    break;
                case 2:
                    strengthBar.style.width = '50%';
                    strengthBar.style.backgroundColor = '#fd7e14';
                    break;
                case 3:
                    strengthBar.style.width = '75%';
                    strengthBar.style.backgroundColor = '#ffc107';
                    break;
                case 4:
                    strengthBar.style.width = '100%';
                    strengthBar.style.backgroundColor = '#28a745';
                    break;
            }
        });
    </script>
</body>

</html>
