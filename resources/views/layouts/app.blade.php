<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUMAS - Manajemen Tugas Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .priority-high {
            background-color: #ffcccc;
        }

        .priority-medium {
            background-color: #ffffcc;
        }

        .priority-low {
            background-color: #ccffcc;
        }

        :root {
            --footer-height: 300px;
            /* Sesuaikan tinggi footer */
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex: 1;
        }

        footer {
            flex-shrink: 0;
        }
    </style>
    @stack('styles')
</head>

<body>
    @include('partials.navbar')
    <div class="container py-4">
        @yield('content')
    </div>
    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk konfirmasi penghapusan
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
