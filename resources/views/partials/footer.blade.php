<footer class="bg-primary text-white mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h5 class="mb-3">TUMAS</h5>
                <p class="mb-0">
                    Aplikasi manajemen tugas mahasiswa yang membantu mengorganisir
                    dan melacak tugas kuliah dengan lebih efisien.
                </p>
            </div>

            <div class="col-md-4 mb-4 mb-md-0">
                <h5 class="mb-3">Navigasi</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('dashboard') }}" class="text-white">Dashboard</a></li>
                    <li><a href="{{ route('tasks.create') }}" class="text-white">Tambah Tugas</a></li>
                    <li><a href="{{ route('reminders') }}" class="text-white">Pengingat</a></li>
                    <li><a href="{{ route('profile') }}" class="text-white">Profil</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h5 class="mb-3">Kontak</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-envelope me-2"></i> support@tumas.app
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-github me-2"></i> github.com/tumas-app
                    </li>
                    <li>
                        <i class="bi bi-building me-2"></i> LPKIA Bandung
                    </li>
                </ul>
            </div>
        </div>

        <hr class="bg-light">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                &copy; {{ date('Y') }} TUMAS - Manajemen Tugas Mahasiswa
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="d-flex justify-content-md-end justify-content-center">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="https://github.com/Rofiaziztr/Tumas" class="text-white"><i
                            class="bi bi-github fs-5"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
