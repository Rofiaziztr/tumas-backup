<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="assets/img/logo.png" alt="">
            <h1 class="sitename">Tumas</h1>
        </a>

        <x-navbar />

        <div class="header-actions d-flex align-items-center">
            <a href="{{ route('register') }}">
                <button class="btn btn-secondary me-md-2" type="button">Sign Up</button>
            </a>
            <a href="{{ route('login') }}">
                <button class="btn btn-secondary" type="button">Sign In</button>
            </a>
        </div>

    </div>
</header>
