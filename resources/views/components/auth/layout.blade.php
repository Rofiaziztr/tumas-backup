<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
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
            transform: scale(0.98);
            animation: fadeInScale 0.4s ease-out forwards;
        }

        @keyframes fadeInScale {
            to {
                opacity: 1;
                transform: scale(1);
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

        /* Tetap pertahankan animasi error */
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
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
