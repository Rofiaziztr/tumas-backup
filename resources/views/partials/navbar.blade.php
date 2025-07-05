<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">TUMAS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tasks.create') }}">
                            <i class="bi bi-plus-circle"></i> Tambah Tugas
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('reminders') }}" id="notificationDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell"></i> Pengingat
                            @if (isset($globalReminderCount) && $globalReminderCount > 0)
                                <span class="badge bg-danger rounded-pill">{{ $globalReminderCount }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                            @if (isset($globalNotifications) && $globalNotifications->count() > 0)
                                @foreach ($globalNotifications as $notification)
                                    <li>
                                        {{-- Arahkan ke detail tugas ketika notifikasi diklik --}}
                                        <a class="dropdown-item"
                                            href="{{ route('tasks.show', $notification->data['task_id']) }}?mark_as_read={{ $notification->id }}">
                                            <div class="fw-bold">{{ Str::limit($notification->data['title'], 25) }}</div>
                                            <div class="small text-muted">{{ $notification->data['message'] }}</div>
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-center" href="{{ route('reminders') }}">Lihat Semua</a>
                                </li>
                            @else
                                <li><span class="dropdown-item text-center text-muted">Tidak ada notifikasi baru</span></li>
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
