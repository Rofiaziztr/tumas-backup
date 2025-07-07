<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TUMAS - @yield('title')</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="guest-layout">
    <div class="guest-container">
        <a href="/" class="guest-brand text-decoration-none">
            <i class="bi bi-card-checklist"></i> TUMAS
        </a>
        <div class="card">
            @yield('content')
        </div>
    </div>
</body>

</html>
