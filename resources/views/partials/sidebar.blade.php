<div id="sidebar-wrapper">
    <div class="sidebar-heading">
        <i class="bi bi-card-checklist me-2"></i>TUMAS
    </div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            href="{{ route('dashboard') }}">
            <i class="bi bi-grid-1x2-fill"></i>Dashboard
        </a>
        <a class="list-group-item list-group-item-action {{ request()->routeIs('tasks.create') ? 'active' : '' }}"
            href="{{ route('tasks.create') }}">
            <i class="bi bi-plus-circle-fill"></i>Tambah Tugas
        </a>
        <a class="list-group-item list-group-item-action {{ request()->routeIs('reminders') ? 'active' : '' }}"
            href="{{ route('reminders') }}">
            <i class="bi bi-bell-fill"></i>Pengingat
            @if (isset($globalReminderCount) && $globalReminderCount > 0)
                <span class="badge bg-danger ms-auto">{{ $globalReminderCount }}</span>
            @endif
        </a>
        <a class="list-group-item list-group-item-action {{ request()->routeIs('profile') ? 'active' : '' }}"
            href="{{ route('profile') }}">
            <i class="bi bi-person-circle"></i>Profil
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action">
                <i class="bi bi-box-arrow-left"></i>Logout
            </button>
        </form>
    </div>
</div>
