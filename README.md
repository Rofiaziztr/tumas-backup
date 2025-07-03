# Tumas - Manajemen Tugas Mahasiswa

**Tumas** (Tugas Mahasiswa) adalah aplikasi web yang dirancang khusus untuk membantu mahasiswa mengelola tugas kuliah secara efisien. Dibangun dengan framework Laravel, Tumas menyediakan solusi sederhana untuk melacak tenggat waktu, mengatur prioritas, dan memastikan tidak ada tugas yang terlewat.

---

## 🚀 Fitur Utama

-   🗓️ **Manajemen Tugas**: Operasi CRUD (Create, Read, Update, Delete) yang lengkap untuk semua tugas kuliah Anda.
-   ⏰ **Pengingat Tenggat Waktu**: Dapatkan notifikasi untuk tugas yang mendekati tenggat waktu (dalam 3 hari).
-   📊 **Penyaringan Cerdas**: Filter dan urutkan tugas berdasarkan status (dikerjakan, selesai), mata kuliah, atau kategori.
-   📁 **Kategori & Prioritas**: Kelompokkan tugas (Tugas, Kuis, UTS, UAS) dan tandai dengan level prioritas (Rendah, Sedang, Tinggi) untuk fokus yang lebih baik.
-   🔐 **Otentikasi Aman**: Sistem registrasi dan login untuk memastikan data tugas setiap pengguna terjaga privasinya.
-   🎨 **Antarmuka Responsif**: Tampilan yang bersih dan mudah digunakan di berbagai perangkat berkat Bootstrap 5.

---

## 🛠️ Tumpukan Teknologi (Tech Stack)

-   **Framework**: [Laravel 10](https://laravel.com/)
-   **Database**: [MySQL](https://www.mysql.com/) (dapat dikonfigurasi untuk database lain)
-   **Frontend**: [Bootstrap 5](https://getbootstrap.com/), [Vite](https://vitejs.dev/)
-   **Otentikasi**: [Laravel UI](https://github.com/laravel/ui)
-   **Development Tools**: Composer, Artisan CLI, Node.js (NPM)

---

## ⚙️ Panduan Instalasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal Anda.

### Prasyarat

Pastikan Anda sudah menginstal:

-   PHP (versi 8.2 atau lebih tinggi)
-   Composer
-   Node.js & NPM

### Langkah-langkah Instalasi

1.  **Clone Repositori**

    ```bash
    git clone https://github.com/username/tumas.git
    cd tumas
    ```

2.  **Salin File Environment**
    Buat file `.env` dari contoh yang ada, lalu generate kunci aplikasi.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3.  **Konfigurasi Database**
    Buka file `.env` dan sesuaikan konfigurasi database Anda.

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=tumas
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Instal Dependensi**
    Instal dependensi PHP (via Composer) dan dependensi otentikasi (Laravel UI).

    ```bash
    composer install
    composer require laravel/ui
    ```

5.  **Setup Scaffolding Frontend**
    Generate scaffolding Bootstrap dengan otentikasi, lalu instal dependensi Node.js dan kompilasi aset.

    ```bash
    php artisan ui bootstrap --auth
    npm install
    npm run build
    ```

6.  **Jalankan Migrasi & Seeder**
    Buat struktur tabel database dan isi dengan data awal (jika ada).

    ```bash
    php artisan migrate --seed
    ```

7.  **Jalankan Aplikasi**
    Server pengembangan akan berjalan secara default di `http://127.0.0.1:8000`.

    ```bash
    php artisan serve
    ```

🎉 **Selesai\!** Anda sekarang dapat mengakses aplikasi di [http://127.0.0.1:8000](https://www.google.com/url?sa=E&source=gmail&q=http://127.0.0.1:8000).

---

## 📂 Struktur Proyek Penting

```
tumas/
├── app/
│   ├── Http/Controllers/   # Logika untuk menangani request
│   ├── Models/             # Representasi tabel database (Eloquent)
│   └── Http/Middleware/    # Middleware (seperti ShareReminderCount)
├── database/
│   ├── migrations/         # Skema struktur database
│   └── seeders/            # Class untuk mengisi data awal
├── resources/
│   ├── css/                # File CSS
│   ├── js/                 # File JavaScript
│   └── views/              # Template Blade untuk antarmuka pengguna
├── routes/
│   └── web.php             # Definisi rute untuk aplikasi web
└── .env                    # File konfigurasi environment
```

---

## 🤝 Kontribusi

Kontribusi untuk pengembangan Tumas sangat kami harapkan\! Jika Anda ingin berkontribusi, silakan ikuti langkah-langkah berikut:

1.  **Fork** repositori ini.
2.  Buat **branch fitur** baru (`git checkout -b fitur/nama-fitur`).
3.  **Commit** perubahan Anda (`git commit -m 'Menambahkan fitur X'`).
4.  **Push** ke branch Anda (`git push origin fitur/nama-fitur`).
5.  Buat **Pull Request** baru.

---

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

**Tumas** © 2025 - Aplikasi Manajemen Tugas untuk Mahasiswa  
Dibangun dengan ❤️ menggunakan Laravel
